<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/model/RoleViewPermissionDTO.php';

class RoleViewPermission extends System
{
    public static function assignPermission($id_rol, $id_vista, $id_permiso, $asignado_por = null)
    {
        if (self::hasPermission($id_rol, $id_vista, $id_permiso)) {
            return false;
        }

        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("INSERT INTO RolVistaPermiso (id_rol, id_vista, id_permiso, asignado_por, fecha_asignacion)
                               VALUES (:id_rol, :id_vista, :id_permiso, :asignado_por, NOW())");
        $stmt->bindParam(':id_rol', $id_rol);
        $stmt->bindParam(':id_vista', $id_vista);
        $stmt->bindParam(':id_permiso', $id_permiso);
        $stmt->bindParam(':asignado_por', $asignado_por);
        return $stmt->execute();
    }

    public static function revokePermission($id_rol, $id_vista, $id_permiso)
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("DELETE FROM RolVistaPermiso
                               WHERE id_rol = :id_rol AND id_vista = :id_vista AND id_permiso = :id_permiso");
        $stmt->bindParam(':id_rol', $id_rol);
        $stmt->bindParam(':id_vista', $id_vista);
        $stmt->bindParam(':id_permiso', $id_permiso);
        return $stmt->execute();
    }

    public static function hasPermission($id_rol, $id_vista, $id_permiso)
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT COUNT(*) as existe
                               FROM RolVistaPermiso
                               WHERE id_rol = :id_rol AND id_vista = :id_vista AND id_permiso = :id_permiso");
        $stmt->bindParam(':id_rol', $id_rol);
        $stmt->bindParam(':id_vista', $id_vista);
        $stmt->bindParam(':id_permiso', $id_permiso);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['existe'] > 0;
    }

    public static function getPermissionsByRole($id_rol)
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT rvp.*, v.nombre as nombre_vista, v.ruta as ruta_vista,
                                      m.nombre as nombre_modulo, m.titulo as titulo_modulo,
                                      p.nombre as nombre_permiso, p.descripcion as descripcion_permiso
                               FROM RolVistaPermiso rvp
                               INNER JOIN Vista v ON rvp.id_vista = v.id_vista
                               INNER JOIN Modulo m ON v.id_modulo = m.id_modulo
                               INNER JOIN Permiso p ON rvp.id_permiso = p.id_permiso
                               WHERE rvp.id_rol = :id_rol
                               ORDER BY m.orden ASC, v.nombre ASC, p.nombre ASC");
        $stmt->bindParam(':id_rol', $id_rol);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getPermissionsByView($id_vista)
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT rvp.*, r.nombre as nombre_rol, p.nombre as nombre_permiso
                               FROM RolVistaPermiso rvp
                               INNER JOIN Rol r ON rvp.id_rol = r.id_rol
                               INNER JOIN Permiso p ON rvp.id_permiso = p.id_permiso
                               WHERE rvp.id_vista = :id_vista
                               ORDER BY r.nombre ASC, p.nombre ASC");
        $stmt->bindParam(':id_vista', $id_vista);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getPermissionsMatrix()
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT r.id_rol, r.nombre as rol_nombre,
                                      v.id_vista, v.nombre as vista_nombre,
                                      m.nombre as modulo_nombre, m.titulo as modulo_titulo,
                                      p.id_permiso, p.nombre as permiso_nombre,
                                      CASE WHEN rvp.id_rol_vista_permiso IS NOT NULL THEN 1 ELSE 0 END as tiene_permiso
                               FROM Rol r
                               CROSS JOIN Vista v
                               CROSS JOIN Permiso p
                               INNER JOIN Modulo m ON v.id_modulo = m.id_modulo
                               LEFT JOIN RolVistaPermiso rvp ON r.id_rol = rvp.id_rol
                                                              AND v.id_vista = rvp.id_vista
                                                              AND p.id_permiso = rvp.id_permiso
                               WHERE r.activo = 1 AND v.activo = 1 AND m.activo = 1
                               ORDER BY r.tipo_legacy ASC, m.orden ASC, v.nombre ASC, p.nombre ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deleteAllPermissionsByRole($id_rol)
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("DELETE FROM RolVistaPermiso WHERE id_rol = :id_rol");
        $stmt->bindParam(':id_rol', $id_rol);
        return $stmt->execute();
    }

    public static function deleteAllPermissionsByView($id_vista)
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("DELETE FROM RolVistaPermiso WHERE id_vista = :id_vista");
        $stmt->bindParam(':id_vista', $id_vista);
        return $stmt->execute();
    }

    public static function assignBulkPermissions($id_rol, $permissions, $asignado_por = null)
    {
        $dbh = parent::Conexion();
        $success = true;

        self::deleteAllPermissionsByRole($id_rol);

        foreach ($permissions as $permission) {
            $stmt = $dbh->prepare("INSERT INTO RolVistaPermiso (id_rol, id_vista, id_permiso, asignado_por, fecha_asignacion)
                                   VALUES (:id_rol, :id_vista, :id_permiso, :asignado_por, NOW())");
            $stmt->bindParam(':id_rol', $id_rol);
            $stmt->bindParam(':id_vista', $permission['id_vista']);
            $stmt->bindParam(':id_permiso', $permission['id_permiso']);
            $stmt->bindParam(':asignado_por', $asignado_por);

            if (!$stmt->execute()) {
                $success = false;
            }
        }

        return $success;
    }

    public static function countTotalPermissions()
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT COUNT(*) as total FROM RolVistaPermiso");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }

    public static function checkModulePermission($id_rol, $moduleName, $permissionName = 'view')
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT COUNT(*) as has_permission
                               FROM RolVistaPermiso rvp
                               INNER JOIN Vista v ON rvp.id_vista = v.id_vista
                               INNER JOIN Modulo m ON v.id_modulo = m.id_modulo
                               INNER JOIN Permiso p ON rvp.id_permiso = p.id_permiso
                               WHERE rvp.id_rol = :id_rol
                               AND m.nombre = :module
                               AND p.nombre = :permission
                               AND m.activo = 1
                               AND v.activo = 1");
        $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
        $stmt->bindParam(':module', $moduleName, PDO::PARAM_STR);
        $stmt->bindParam(':permission', $permissionName, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['has_permission'] > 0;
    }

    public static function checkViewPermission($id_rol, $moduleName, $viewName, $permissionName = 'view')
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT COUNT(*) as has_permission
                               FROM RolVistaPermiso rvp
                               INNER JOIN Vista v ON rvp.id_vista = v.id_vista
                               INNER JOIN Modulo m ON v.id_modulo = m.id_modulo
                               INNER JOIN Permiso p ON rvp.id_permiso = p.id_permiso
                               WHERE rvp.id_rol = :id_rol
                               AND m.nombre = :module
                               AND v.nombre = :view
                               AND p.nombre = :permission
                               AND m.activo = 1
                               AND v.activo = 1");
        $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
        $stmt->bindParam(':module', $moduleName, PDO::PARAM_STR);
        $stmt->bindParam(':view', $viewName, PDO::PARAM_STR);
        $stmt->bindParam(':permission', $permissionName, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['has_permission'] > 0;
    }
}
