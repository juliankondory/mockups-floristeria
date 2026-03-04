<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/model/ModuleDTO.php';

class Module extends System
{
    public static function newModule($nombre, $titulo, $descripcion, $ruta, $icono, $color, $mostrar_en_dashboard, $orden, $activo, $exclusivo_dev = 0, $tipo = 'modulo_hijo', $id_modulo_padre = null)
    {
        $validar = self::validateModuleByName($nombre, null);

        if (!$validar) {
            $dbh = parent::Conexion();
            $stmt = $dbh->prepare("INSERT INTO Modulo (nombre, titulo, descripcion, ruta, icono, color, mostrar_en_dashboard, tipo, id_modulo_padre, orden, activo, exclusivo_dev, fecha_registro)
                                   VALUES (:nombre, :titulo, :descripcion, :ruta, :icono, :color, :mostrar_en_dashboard, :tipo, :id_modulo_padre, :orden, :activo, :exclusivo_dev, NOW())");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':ruta', $ruta);
            $stmt->bindParam(':icono', $icono);
            $stmt->bindParam(':color', $color);
            $stmt->bindParam(':mostrar_en_dashboard', $mostrar_en_dashboard);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':id_modulo_padre', $id_modulo_padre);
            $stmt->bindParam(':orden', $orden);
            $stmt->bindParam(':activo', $activo);
            $stmt->bindParam(':exclusivo_dev', $exclusivo_dev);
            return $stmt->execute();
        }
        return false;
    }

    public static function setModule($id_modulo, $nombre, $titulo, $descripcion, $ruta, $icono, $color, $mostrar_en_dashboard, $orden, $activo, $exclusivo_dev = 0, $tipo = 'modulo_hijo', $id_modulo_padre = null)
    {
        $validar = self::validateModuleByName($nombre, $id_modulo);

        if (!$validar) {
            $dbh = parent::Conexion();
            $stmt = $dbh->prepare("UPDATE Modulo
                                   SET nombre = :nombre, titulo = :titulo, descripcion = :descripcion, ruta = :ruta,
                                       icono = :icono, color = :color, mostrar_en_dashboard = :mostrar_en_dashboard,
                                       tipo = :tipo, id_modulo_padre = :id_modulo_padre, orden = :orden, activo = :activo, exclusivo_dev = :exclusivo_dev
                                   WHERE id_modulo = :id_modulo");
            $stmt->bindParam(':id_modulo', $id_modulo);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':ruta', $ruta);
            $stmt->bindParam(':icono', $icono);
            $stmt->bindParam(':color', $color);
            $stmt->bindParam(':mostrar_en_dashboard', $mostrar_en_dashboard);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':id_modulo_padre', $id_modulo_padre);
            $stmt->bindParam(':orden', $orden);
            $stmt->bindParam(':activo', $activo);
            $stmt->bindParam(':exclusivo_dev', $exclusivo_dev);
            return $stmt->execute();
        }
        return false;
    }

    public static function getModuleById($id_modulo)
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Modulo WHERE id_modulo = :id_modulo");
        $stmt->bindParam(':id_modulo', $id_modulo);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'ModuleDTO');
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function getModuleByName($nombre)
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Modulo WHERE nombre = :nombre AND activo = 1");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'ModuleDTO');
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function listModules()
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Modulo ORDER BY orden ASC");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'ModuleDTO');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function listActiveModules()
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Modulo WHERE activo = 1 ORDER BY orden ASC");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'ModuleDTO');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function listDashboardModules()
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Modulo WHERE mostrar_en_dashboard = 1 AND activo = 1 ORDER BY orden ASC");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'ModuleDTO');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function deleteModule($id_modulo)
    {
        $dbh = parent::Conexion();

        // Primero eliminar las relaciones en RolVistaPermiso de las vistas del módulo
        $stmtPermissions = $dbh->prepare("DELETE FROM RolVistaPermiso WHERE id_vista IN (SELECT id_vista FROM Vista WHERE id_modulo = :id_modulo)");
        $stmtPermissions->bindParam(':id_modulo', $id_modulo);
        $stmtPermissions->execute();

        // Luego eliminar las vistas del módulo
        $stmtViews = $dbh->prepare("DELETE FROM Vista WHERE id_modulo = :id_modulo");
        $stmtViews->bindParam(':id_modulo', $id_modulo);
        $stmtViews->execute();

        // Finalmente eliminar el módulo
        $stmt = $dbh->prepare("DELETE FROM Modulo WHERE id_modulo = :id_modulo");
        $stmt->bindParam(':id_modulo', $id_modulo);
        return $stmt->execute();
    }

    public static function validateModuleByName($nombre, $id_modulo)
    {
        $dbh = parent::Conexion();

        if ($id_modulo) {
            $stmt = $dbh->prepare("SELECT * FROM Modulo WHERE nombre = :nombre AND id_modulo != :id_modulo");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':id_modulo', $id_modulo);
        } else {
            $stmt = $dbh->prepare("SELECT * FROM Modulo WHERE nombre = :nombre");
            $stmt->bindParam(':nombre', $nombre);
        }

        $stmt->execute();
        return $stmt->fetch() ? true : false;
    }

    public static function countModules()
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT COUNT(*) as total FROM Modulo WHERE activo = 1");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }

    /**
     * Get dashboard modules for a role
     */
    public static function getDashboardModulesByRole($id_rol)
    {
        $dbh = parent::Conexion();

        // Obtener tipo_legacy del rol para saber si es Dev
        $stmtRole = $dbh->prepare("SELECT tipo_legacy FROM Rol WHERE id_rol = :id_rol");
        $stmtRole->execute([':id_rol' => $id_rol]);
        $role = $stmtRole->fetch(PDO::FETCH_ASSOC);
        $isDev = ($role && $role['tipo_legacy'] == 0);

        // Si NO es Dev, excluir módulos exclusivos
        $exclusiveFilter = $isDev ? "" : "AND (m.exclusivo_dev IS NULL OR m.exclusivo_dev = 0)";

        $sql = "SELECT DISTINCT m.*
                FROM Modulo m
                INNER JOIN Vista v ON m.id_modulo = v.id_modulo
                INNER JOIN RolVistaPermiso rvp ON v.id_vista = rvp.id_vista
                INNER JOIN Permiso p ON rvp.id_permiso = p.id_permiso
                WHERE rvp.id_rol = :id_rol
                AND m.mostrar_en_dashboard = 1
                AND m.activo = 1
                AND v.activo = 1
                AND p.nombre = 'access'
                $exclusiveFilter
                ORDER BY m.orden ASC";

        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get sidebar menu modules for a role
     */
    public static function getSidebarModulesByRole($id_rol)
    {
        $dbh = parent::Conexion();

        // Obtener tipo_legacy del rol para saber si es Dev
        $stmtRole = $dbh->prepare("SELECT tipo_legacy FROM Rol WHERE id_rol = :id_rol");
        $stmtRole->execute([':id_rol' => $id_rol]);
        $role = $stmtRole->fetch(PDO::FETCH_ASSOC);
        $isDev = ($role && $role['tipo_legacy'] == 0);

        // Si NO es Dev, excluir módulos exclusivos
        $exclusiveFilter = $isDev ? "" : "AND (m.exclusivo_dev IS NULL OR m.exclusivo_dev = 0)";

        // Consulta para obtener módulos con vistas que tienen permisos
        $sql = "SELECT DISTINCT m.id_modulo, m.nombre, m.titulo, m.ruta, m.icono, m.color, m.orden, m.tipo, m.id_modulo_padre
                FROM Modulo m
                INNER JOIN Vista v ON m.id_modulo = v.id_modulo
                INNER JOIN RolVistaPermiso rvp ON v.id_vista = rvp.id_vista
                INNER JOIN Permiso p ON rvp.id_permiso = p.id_permiso
                WHERE rvp.id_rol = :id_rol
                AND m.activo = 1
                AND v.activo = 1
                AND p.nombre = 'access'
                $exclusiveFilter";

        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
        $stmt->execute();
        $modules = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Obtener IDs de módulos padre necesarios (que tienen hijos con permisos)
        $parentIds = [];
        foreach ($modules as $module) {
            if (!empty($module['id_modulo_padre'])) {
                $parentIds[$module['id_modulo_padre']] = true;
            }
        }

        // Si hay módulos padre necesarios, agregarlos a la lista
        if (!empty($parentIds)) {
            $parentIdsString = implode(',', array_keys($parentIds));
            $sqlParents = "SELECT m.id_modulo, m.nombre, m.titulo, m.ruta, m.icono, m.color, m.orden, m.tipo, m.id_modulo_padre
                          FROM Modulo m
                          WHERE m.id_modulo IN ($parentIdsString)
                          AND m.activo = 1
                          $exclusiveFilter";

            $stmtParents = $dbh->prepare($sqlParents);
            $stmtParents->execute();
            $parents = $stmtParents->fetchAll(PDO::FETCH_ASSOC);

            // Combinar módulos hijos y padres
            $modules = array_merge($modules, $parents);
        }

        // Ordenar por orden
        usort($modules, function($a, $b) {
            return $a['orden'] - $b['orden'];
        });

        return $modules;
    }

    /**
     * Get paginated modules for DataTables
     */
    public static function getPaginated($page, $length, $searchValue)
    {
        $dbh = parent::Conexion();
        $offset = ($page - 1) * $length;

        // Count total records
        $stmtTotal = $dbh->prepare("SELECT COUNT(*) as total FROM Modulo");
        $stmtTotal->execute();
        $totalRecords = $stmtTotal->fetch()['total'];

        // Build search query
        $searchQuery = "";
        $params = [];
        if (!empty($searchValue)) {
            $searchQuery = " WHERE (nombre LIKE :search OR titulo LIKE :search OR descripcion LIKE :search)";
            $params[':search'] = "%$searchValue%";
        }

        // Count filtered records
        $stmtFiltered = $dbh->prepare("SELECT COUNT(*) as total FROM Modulo" . $searchQuery);
        foreach ($params as $key => $value) {
            $stmtFiltered->bindValue($key, $value);
        }
        $stmtFiltered->execute();
        $filteredRecords = $stmtFiltered->fetch()['total'];

        // Get paginated data
        $stmt = $dbh->prepare("SELECT * FROM Modulo" . $searchQuery . " ORDER BY orden ASC LIMIT :limit OFFSET :offset");
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':limit', $length, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'ModuleDTO');
        $stmt->execute();

        return [
            'data' => $stmt->fetchAll(),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords
        ];
    }

    /**
     * Get all parent modules (modulo_padre)
     */
    public static function getParentModules()
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Modulo
                               WHERE tipo = 'modulo_padre'
                               AND activo = 1
                               ORDER BY orden ASC, titulo ASC");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'ModuleDTO');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get all child modules by parent module
     */
    public static function getChildModulesByParent($id_modulo_padre)
    {
        $dbh = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Modulo
                               WHERE id_modulo_padre = :id_modulo_padre
                               AND tipo = 'modulo_hijo'
                               AND activo = 1
                               ORDER BY orden ASC, titulo ASC");
        $stmt->bindParam(':id_modulo_padre', $id_modulo_padre);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'ModuleDTO');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get hierarchical modules (with children grouped)
     */
    public static function getModulesHierarchical()
    {
        $dbh = parent::Conexion();

        // Get all parent modules
        $parentModules = self::getParentModules();

        // Get all child modules
        $stmtChild = $dbh->prepare("SELECT * FROM Modulo
                                    WHERE tipo = 'modulo_hijo'
                                    AND activo = 1
                                    ORDER BY orden ASC, titulo ASC");
        $stmtChild->setFetchMode(PDO::FETCH_CLASS, 'ModuleDTO');
        $stmtChild->execute();
        $childModules = $stmtChild->fetchAll();

        // Organize hierarchically
        $hierarchical = [];

        // Add parent modules with their children
        foreach ($parentModules as $parent) {
            $parentData = [
                'module' => $parent,
                'children' => []
            ];

            foreach ($childModules as $child) {
                if ($child->getId_modulo_padre() == $parent->getId_modulo()) {
                    $parentData['children'][] = $child;
                }
            }

            $hierarchical[] = $parentData;
        }

        // Add orphan child modules (those without parent or with invalid parent)
        foreach ($childModules as $child) {
            if (!$child->getId_modulo_padre()) {
                $hierarchical[] = [
                    'module' => $child,
                    'children' => []
                ];
            }
        }

        return $hierarchical;
    }
}
