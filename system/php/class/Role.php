<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/model/RoleDTO.php';

class Role extends System
{
    /**
     * Create a new role
     */
    public static function newRole($nombre, $descripcion, $tipo_legacy, $activo)
    {
        $validar = self::validateRoleByName($nombre, null);

        if (!$validar) {
            $dbh = parent::Conexion();
            $stmt = $dbh->prepare("INSERT INTO Rol (nombre, descripcion, tipo_legacy, activo, fecha_registro)
                                   VALUES (:nombre, :descripcion, :tipo_legacy, :activo, NOW())");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':tipo_legacy', $tipo_legacy);
            $stmt->bindParam(':activo', $activo);
            return $stmt->execute();
        }
        return false;
    }

    /**
     * Update an existing role
     */
    public static function setRole($id_rol, $nombre, $descripcion, $tipo_legacy, $activo)
    {
        $validar = self::validateRoleByName($nombre, $id_rol);

        if (!$validar) {
            $dbh = parent::Conexion();
            $stmt = $dbh->prepare("UPDATE Rol
                                   SET nombre = :nombre, descripcion = :descripcion, tipo_legacy = :tipo_legacy, activo = :activo
                                   WHERE id_rol = :id_rol");
            $stmt->bindParam(':id_rol', $id_rol);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':tipo_legacy', $tipo_legacy);
            $stmt->bindParam(':activo', $activo);
            return $stmt->execute();
        }
        return false;
    }

    /**
     * Get role by ID
     */
    public static function getRoleById($id_rol)
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Rol WHERE id_rol = :id_rol");
        $stmt->bindParam(':id_rol', $id_rol);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'RoleDTO');
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Get role by tipo_legacy (0, 1, 2, 3, 5)
     */
    public static function getRoleByLegacyType($tipo_legacy)
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Rol WHERE tipo_legacy = :tipo_legacy AND activo = 1");
        $stmt->bindParam(':tipo_legacy', $tipo_legacy);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'RoleDTO');
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * List all roles
     */
    public static function listRoles()
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Rol ORDER BY tipo_legacy ASC");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'RoleDTO');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * List active roles
     */
    public static function listActiveRoles()
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Rol WHERE activo = 1 ORDER BY tipo_legacy ASC");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'RoleDTO');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Delete a role (hard delete - permanently remove from database)
     */
    public static function deleteRole($id_rol)
    {
        $dbh = parent::Conexion();

        // Primero eliminar las relaciones en RolVistaPermiso
        $stmtPermissions = $dbh->prepare("DELETE FROM RolVistaPermiso WHERE id_rol = :id_rol");
        $stmtPermissions->bindParam(':id_rol', $id_rol);
        $stmtPermissions->execute();

        // Luego eliminar el rol
        $stmt = $dbh->prepare("DELETE FROM Rol WHERE id_rol = :id_rol");
        $stmt->bindParam(':id_rol', $id_rol);
        return $stmt->execute();
    }

    /**
     * Validate if a role with the same name exists
     */
    public static function validateRoleByName($nombre, $id_rol)
    {
        $dbh = parent::Conexion();

        if ($id_rol) {
            $stmt = $dbh->prepare("SELECT * FROM Rol WHERE nombre = :nombre AND id_rol != :id_rol");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':id_rol', $id_rol);
        } else {
            $stmt = $dbh->prepare("SELECT * FROM Rol WHERE nombre = :nombre");
            $stmt->bindParam(':nombre', $nombre);
        }

        $stmt->execute();
        return $stmt->fetch() ? true : false;
    }

    /**
     * Count total roles
     */
    public static function countRoles()
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT COUNT(*) as total FROM Rol WHERE activo = 1");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }

    /**
     * Get role ID by tipo_legacy
     */
    public static function getRoleIdByLegacyType($tipo_legacy)
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT id_rol FROM Rol WHERE tipo_legacy = :tipo_legacy AND activo = 1");
        $stmt->bindParam(':tipo_legacy', $tipo_legacy, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result ? $result['id_rol'] : null;
    }

    /**
     * Get user-assignable roles (exclude Dev=0 and Admin=5)
     * Returns only factory roles (tipo_legacy NOT IN (0, 5))
     */
    public static function getUserAssignableRoles()
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Rol WHERE tipo_legacy NOT IN (0, 5) AND activo = 1 ORDER BY tipo_legacy ASC");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'RoleDTO');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get paginated roles for DataTables
     */
    public static function getPaginated($page, $length, $searchValue)
    {
        $dbh = parent::Conexion();
        $offset = ($page - 1) * $length;

        // Count total records
        $stmtTotal = $dbh->prepare("SELECT COUNT(*) as total FROM Rol");
        $stmtTotal->execute();
        $totalRecords = $stmtTotal->fetch()['total'];

        // Build search query
        $searchQuery = "";
        $params = [];
        if (!empty($searchValue)) {
            $searchQuery = " WHERE (nombre LIKE :search OR descripcion LIKE :search)";
            $params[':search'] = "%$searchValue%";
        }

        // Count filtered records
        $stmtFiltered = $dbh->prepare("SELECT COUNT(*) as total FROM Rol" . $searchQuery);
        foreach ($params as $key => $value) {
            $stmtFiltered->bindValue($key, $value);
        }
        $stmtFiltered->execute();
        $filteredRecords = $stmtFiltered->fetch()['total'];

        // Get paginated data
        $stmt = $dbh->prepare("SELECT * FROM Rol" . $searchQuery . " ORDER BY id_rol DESC LIMIT :limit OFFSET :offset");
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':limit', $length, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'RoleDTO');
        $stmt->execute();

        return [
            'data' => $stmt->fetchAll(),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords
        ];
    }
}
