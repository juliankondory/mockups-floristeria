<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/System.php';

class ServiceRole extends System
{
    public static function newRole($nombre, $descripcion, $tipo_legacy)
    {
        try {
            $nombre = parent::limpiarString($nombre);
            $descripcion = parent::limpiarString($descripcion);
            $activo = 1;

            if (Role::newRole($nombre, $descripcion, $tipo_legacy, $activo)) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Rol registrado exitosamente']);
                exit;
            } else {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'El rol ya existe']);
                exit;
            }
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            exit;
        }
    }

    public static function setRole($id_rol, $nombre, $descripcion, $tipo_legacy, $activo)
    {
        try {
            $nombre = parent::limpiarString($nombre);
            $descripcion = parent::limpiarString($descripcion);

            if (Role::setRole($id_rol, $nombre, $descripcion, $tipo_legacy, $activo)) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Rol actualizado exitosamente']);
                exit;
            } else {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'El rol ya existe']);
                exit;
            }
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            exit;
        }
    }

    public static function deleteRole($id_rol)
    {
        try {
            if (Role::deleteRole($id_rol)) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Rol eliminado exitosamente']);
                exit;
            } else {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Error al eliminar el rol']);
                exit;
            }
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            exit;
        }
    }

    public static function getRoleById($id_rol)
    {
        try {
            return Role::getRoleById($id_rol);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function listRoles()
    {
        try {
            return Role::listRoles();
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function listActiveRoles()
    {
        try {
            return Role::listActiveRoles();
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getTablaRoles()
    {
        try {
            $tableHtml = "";
            $modelResponse = Role::listRoles();

            foreach ($modelResponse as $role) {
                // Ocultar rol Dev (tipo_legacy = 0)
                if ($role->getTipo_legacy() == 0) {
                    continue;
                }

                $tableHtml .= '<tr>';
                $tableHtml .= '<td>' . $role->getNombre() . '</td>';
                $tableHtml .= '<td>' . $role->getDescripcion() . '</td>';

                // Tipo Legacy
                $tipo = $role->getTipo_legacy();
                if ($tipo == 5) $tableHtml .= '<td><span class="badge bg-danger">Super Admin (5)</span></td>';
                else if ($tipo == 0) $tableHtml .= '<td><span class="badge bg-primary">Admin (0)</span></td>';
                else if ($tipo == 1) $tableHtml .= '<td><span class="badge bg-info">Usuario (1)</span></td>';
                else if ($tipo == null) $tableHtml .= '<td><span class="badge bg-secondary">Personalizado</span></td>';
                else $tableHtml .= '<td><span class="badge bg-secondary">' . $tipo . '</span></td>';

                // Estado
                $estado = $role->getActivo();
                if ($estado[0] == 1) $tableHtml .= '<td><span class="badge bg-success">' . $estado[1] . '</span></td>';
                else $tableHtml .= '<td><span class="badge bg-danger">' . $estado[1] . '</span></td>';

                // Botones
                $tableHtml .= '<td>';
                $tableHtml .= "<a href='roles-edit?roles=" . $role->getId_rol() . "' class='btn btn-info rounded-circle btn-sm'><i class='bi bi-info-circle'></i></a>";
                $tableHtml .= '</td>';

                $tableHtml .= '</tr>';
            }
            return $tableHtml;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getRoles()
    {
        try {
            // DataTables parameters
            $draw = isset($_POST['draw']) ? intval($_POST['draw']) : 1;
            $start = isset($_POST['start']) ? intval($_POST['start']) : 0;
            $length = isset($_POST['length']) ? intval($_POST['length']) : 10;
            $searchValue = isset($_POST['search']['value']) ? parent::limpiarString($_POST['search']['value']) : '';

            // Calculate page
            $page = ($length > 0) ? intval($start / $length) + 1 : 1;

            // Get paginated data
            $result = Role::getPaginated($page, $length, $searchValue);

            // Format data for DataTables
            $data = [];
            foreach ($result['data'] as $role) {
                // Ocultar rol Dev (tipo_legacy = 0)
                if ($role->getTipo_legacy() == 0) {
                    continue;
                }

                // Tipo Legacy badge
                $tipo = $role->getTipo_legacy();
                if ($tipo == 5) $tipoBadge = '<span class="badge bg-danger">Super Admin (5)</span>';
                else if ($tipo == 0) $tipoBadge = '<span class="badge bg-primary">Admin (0)</span>';
                else if ($tipo == 1) $tipoBadge = '<span class="badge bg-info">Usuario (1)</span>';
                else if ($tipo == null) $tipoBadge = '<span class="badge bg-secondary">Personalizado</span>';
                else $tipoBadge = '<span class="badge bg-secondary">' . $tipo . '</span>';

                $data[] = [
                    'id_rol' => $role->getId_rol(),
                    'nombre' => $role->getNombre(),
                    'descripcion' => $role->getDescripcion(),
                    'tipo_legacy' => $tipoBadge,
                    'activo' => $role->getActivo()[0],
                    'btnEdit' => "<a href='roles-edit?roles=" . $role->getId_rol() . "' class='btn btn-info rounded-circle btn-sm'><i class='bi bi-info-circle'></i></a>"
                ];
            }

            header('Content-Type: application/json');
            echo json_encode([
                'draw' => $draw,
                'recordsTotal' => $result['recordsTotal'],
                'recordsFiltered' => $result['recordsFiltered'],
                'data' => $data,
                'success' => true
            ]);
            exit;

        } catch (\Exception $e) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
            exit;
        }
    }
}
