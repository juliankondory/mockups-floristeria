<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/model/ViewDTO.php';

class View extends System
{
    public static function newView($id_modulo, $nombre, $ruta, $descripcion, $activo, $orden = 0)
    {
        $validar = self::validateViewByName($id_modulo, $nombre, null);

        if (!$validar) {
            $dbh = parent::Conexion();
            $stmt = $dbh->prepare("INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, orden, fecha_registro)
                                   VALUES (:id_modulo, :nombre, :ruta, :descripcion, :activo, :orden, NOW())");
            $stmt->bindParam(':id_modulo', $id_modulo);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':ruta', $ruta);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':activo', $activo);
            $stmt->bindParam(':orden', $orden);
            return $stmt->execute();
        }
        return false;
    }

    public static function setView($id_vista, $id_modulo, $nombre, $ruta, $descripcion, $activo, $orden = 0)
    {
        $validar = self::validateViewByName($id_modulo, $nombre, $id_vista);

        if (!$validar) {
            $dbh = parent::Conexion();
            $stmt = $dbh->prepare("UPDATE Vista
                                   SET id_modulo = :id_modulo, nombre = :nombre, ruta = :ruta,
                                       descripcion = :descripcion, activo = :activo, orden = :orden
                                   WHERE id_vista = :id_vista");
            $stmt->bindParam(':id_vista', $id_vista);
            $stmt->bindParam(':id_modulo', $id_modulo);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':ruta', $ruta);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':activo', $activo);
            $stmt->bindParam(':orden', $orden);
            return $stmt->execute();
        }
        return false;
    }

    public static function getViewById($id_vista)
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Vista WHERE id_vista = :id_vista");
        $stmt->bindParam(':id_vista', $id_vista);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'ViewDTO');
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function listViews()
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT v.*, m.nombre as nombre_modulo, m.titulo as titulo_modulo
                               FROM Vista v
                               INNER JOIN Modulo m ON v.id_modulo = m.id_modulo
                               ORDER BY m.orden ASC, v.nombre ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listActiveViews()
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT v.*, m.nombre as nombre_modulo, m.titulo as titulo_modulo
                               FROM Vista v
                               INNER JOIN Modulo m ON v.id_modulo = m.id_modulo
                               WHERE v.activo = 1 AND m.activo = 1
                               ORDER BY m.orden ASC, v.nombre ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listViewsByModule($id_modulo)
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Vista WHERE id_modulo = :id_modulo ORDER BY nombre ASC");
        $stmt->bindParam(':id_modulo', $id_modulo);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'ViewDTO');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function deleteView($id_vista)
    {
        $dbh = parent::Conexion();

        // Primero eliminar las relaciones en RolVistaPermiso
        $stmtPermissions = $dbh->prepare("DELETE FROM RolVistaPermiso WHERE id_vista = :id_vista");
        $stmtPermissions->bindParam(':id_vista', $id_vista);
        $stmtPermissions->execute();

        // Luego eliminar la vista
        $stmt = $dbh->prepare("DELETE FROM Vista WHERE id_vista = :id_vista");
        $stmt->bindParam(':id_vista', $id_vista);
        return $stmt->execute();
    }

    public static function validateViewByName($id_modulo, $nombre, $id_vista)
    {
        $dbh = parent::Conexion();

        if ($id_vista) {
            $stmt = $dbh->prepare("SELECT * FROM Vista WHERE id_modulo = :id_modulo AND nombre = :nombre AND id_vista != :id_vista");
            $stmt->bindParam(':id_modulo', $id_modulo);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':id_vista', $id_vista);
        } else {
            $stmt = $dbh->prepare("SELECT * FROM Vista WHERE id_modulo = :id_modulo AND nombre = :nombre");
            $stmt->bindParam(':id_modulo', $id_modulo);
            $stmt->bindParam(':nombre', $nombre);
        }

        $stmt->execute();
        return $stmt->fetch() ? true : false;
    }

    public static function countViews()
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT COUNT(*) as total FROM Vista WHERE activo = 1");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }

    /**
     * Get paginated views for DataTables
     */
    public static function getPaginated($page, $length, $searchValue)
    {
        $dbh = parent::Conexion();
        $offset = ($page - 1) * $length;

        // Count total records
        $stmtTotal = $dbh->prepare("SELECT COUNT(*) as total FROM Vista v INNER JOIN Modulo m ON v.id_modulo = m.id_modulo");
        $stmtTotal->execute();
        $totalRecords = $stmtTotal->fetch()['total'];

        // Build search query
        $searchQuery = "";
        $params = [];
        if (!empty($searchValue)) {
            $searchQuery = " WHERE (v.nombre LIKE :search OR v.ruta LIKE :search OR v.descripcion LIKE :search OR m.titulo LIKE :search)";
            $params[':search'] = "%$searchValue%";
        }

        // Count filtered records
        $stmtFiltered = $dbh->prepare("SELECT COUNT(*) as total FROM Vista v INNER JOIN Modulo m ON v.id_modulo = m.id_modulo" . $searchQuery);
        foreach ($params as $key => $value) {
            $stmtFiltered->bindValue($key, $value);
        }
        $stmtFiltered->execute();
        $filteredRecords = $stmtFiltered->fetch()['total'];

        // Get paginated data
        $sql = "SELECT v.*, m.nombre as nombre_modulo, m.titulo as titulo_modulo
                FROM Vista v
                INNER JOIN Modulo m ON v.id_modulo = m.id_modulo"
                . $searchQuery .
                " ORDER BY m.orden ASC, v.orden ASC, v.nombre ASC LIMIT :limit OFFSET :offset";

        $stmt = $dbh->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':limit', $length, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return [
            'data' => $stmt->fetchAll(PDO::FETCH_ASSOC),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords
        ];
    }

}
