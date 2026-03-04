<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/model/PermissionDTO.php';

class Permission extends System
{
    public static function newPermission($nombre, $descripcion)
    {
        $validar = self::validatePermissionByName($nombre, null);

        if (!$validar) {
            $dbh = parent::Conexion();
            $stmt = $dbh->prepare("INSERT INTO Permiso (nombre, descripcion, fecha_registro)
                                   VALUES (:nombre, :descripcion, NOW())");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            return $stmt->execute();
        }
        return false;
    }

    public static function setPermission($id_permiso, $nombre, $descripcion)
    {
        $validar = self::validatePermissionByName($nombre, $id_permiso);

        if (!$validar) {
            $dbh = parent::Conexion();
            $stmt = $dbh->prepare("UPDATE Permiso
                                   SET nombre = :nombre, descripcion = :descripcion
                                   WHERE id_permiso = :id_permiso");
            $stmt->bindParam(':id_permiso', $id_permiso);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            return $stmt->execute();
        }
        return false;
    }

    public static function getPermissionById($id_permiso)
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Permiso WHERE id_permiso = :id_permiso");
        $stmt->bindParam(':id_permiso', $id_permiso);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'PermissionDTO');
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function getPermissionByName($nombre)
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Permiso WHERE nombre = :nombre");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'PermissionDTO');
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function listPermissions()
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Permiso ORDER BY nombre ASC");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'PermissionDTO');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function deletePermission($id_permiso)
    {
        $dbh = parent::Conexion();

        // Primero eliminar las relaciones en RolVistaPermiso
        $stmtRelations = $dbh->prepare("DELETE FROM RolVistaPermiso WHERE id_permiso = :id_permiso");
        $stmtRelations->bindParam(':id_permiso', $id_permiso);
        $stmtRelations->execute();

        // Luego eliminar el permiso
        $stmt = $dbh->prepare("DELETE FROM Permiso WHERE id_permiso = :id_permiso");
        $stmt->bindParam(':id_permiso', $id_permiso);
        return $stmt->execute();
    }

    public static function validatePermissionByName($nombre, $id_permiso)
    {
        $dbh = parent::Conexion();

        if ($id_permiso) {
            $stmt = $dbh->prepare("SELECT * FROM Permiso WHERE nombre = :nombre AND id_permiso != :id_permiso");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':id_permiso', $id_permiso);
        } else {
            $stmt = $dbh->prepare("SELECT * FROM Permiso WHERE nombre = :nombre");
            $stmt->bindParam(':nombre', $nombre);
        }

        $stmt->execute();
        return $stmt->fetch() ? true : false;
    }

    public static function countPermissions()
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT COUNT(*) as total FROM Permiso");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }

    /**
     * Verificar si un rol tiene un permiso específico en una vista
     *
     * @param int $id_rol ID del rol
     * @param int $id_vista ID de la vista
     * @param string $nombre_permiso Nombre del permiso (view, create, edit, delete)
     * @return bool True si tiene el permiso, False si no
     */
    public static function hasRoleViewPermission($id_rol, $id_vista, $nombre_permiso)
    {
        try {
            $dbh = parent::Conexion();
            $stmt = $dbh->prepare("SELECT COUNT(*) as tiene_permiso
                                   FROM RolVistaPermiso rvp
                                   INNER JOIN Permiso p ON rvp.id_permiso = p.id_permiso
                                   WHERE rvp.id_rol = :id_rol
                                   AND rvp.id_vista = :id_vista
                                   AND p.nombre = :nombre_permiso");
            $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
            $stmt->bindParam(':id_vista', $id_vista, PDO::PARAM_INT);
            $stmt->bindParam(':nombre_permiso', $nombre_permiso, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['tiene_permiso'] > 0;
        } catch (\Exception $e) {
            error_log("Error checking permission: " . $e->getMessage());
            return false;
        }
    }
}
