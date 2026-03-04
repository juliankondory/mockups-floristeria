<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/View.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/Module.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/Elements.php';

class ServiceView
{
    public static function newView($id_modulo, $nombre, $ruta, $descripcion, $activo, $orden = 0)
    {
        try {
            $result = View::newView($id_modulo, $nombre, $ruta, $descripcion, $activo, $orden);
            if ($result) {
                return '<script>swal("' . Constants::$REGISTER_NEW . '", "", "success");</script>';
            } else {
                return '<script>swal("Ya existe una vista con ese nombre en este módulo", "", "error");</script>';
            }
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function setView($id_vista, $id_modulo, $nombre, $ruta, $descripcion, $activo, $orden = 0)
    {
        try {
            $result = View::setView($id_vista, $id_modulo, $nombre, $ruta, $descripcion, $activo, $orden);
            if ($result) {
                return '<script>swal("' . Constants::$REGISTER_UPDATE . '", "", "success");</script>';
            } else {
                return '<script>swal("Ya existe una vista con ese nombre en este módulo", "", "error");</script>';
            }
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getViewById($id_vista)
    {
        try {
            return View::getViewById($id_vista);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function deleteView($id_vista)
    {
        try {
            $result = View::deleteView($id_vista);
            if ($result) {
                return '<script>swal("' . Constants::$REGISTER_DELETE . '", "", "success");</script>';
            } else {
                return '<script>swal("Error al eliminar la vista", "", "error");</script>';
            }
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getAllModules()
    {
        try {
            return Module::listModules();
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getTablaViews()
    {
        try {
            $tableHtml = "";
            $modelResponse = View::listViews();

            foreach ($modelResponse as $view) {
                $tableHtml .= '<tr>';
                $tableHtml .= '<td>' . $view['titulo_modulo'] . '</td>';
                $tableHtml .= '<td>' . $view['nombre'] . '</td>';
                $tableHtml .= '<td>' . $view['ruta'] . '</td>';
                $tableHtml .= '<td>' . ($view['descripcion'] ?: '<em class="text-muted">Sin descripción</em>') . '</td>';

                // Estado
                if ($view['activo'] == 1) {
                    $tableHtml .= '<td><span class="badge bg-success">Activo</span></td>';
                } else {
                    $tableHtml .= '<td><span class="badge bg-danger">Inactivo</span></td>';
                }

                // Botones
                $tableHtml .= '<td>';
                $tableHtml .= "<a href='views-edit?views=" . $view['id_vista'] . "' class='btn btn-info rounded-circle btn-sm'><i class='bi bi-info-circle'></i></a>";
                $tableHtml .= '</td>';

                $tableHtml .= '</tr>';
            }
            return $tableHtml;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getViews()
    {
        try {
            // DataTables parameters
            $draw = isset($_POST['draw']) ? intval($_POST['draw']) : 1;
            $start = isset($_POST['start']) ? intval($_POST['start']) : 0;
            $length = isset($_POST['length']) ? intval($_POST['length']) : 10;
            $searchValue = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';

            // Calculate page
            $page = ($length > 0) ? intval($start / $length) + 1 : 1;

            // Get paginated data
            $result = View::getPaginated($page, $length, $searchValue);

            // Format data for DataTables
            $data = [];
            foreach ($result['data'] as $view) {
                $data[] = [
                    'id_vista' => $view['id_vista'],
                    'titulo_modulo' => $view['titulo_modulo'],
                    'nombre' => $view['nombre'],
                    'ruta' => $view['ruta'],
                    'descripcion' => $view['descripcion'] ?: '<em class="text-muted">Sin descripción</em>',
                    'orden' => $view['orden'],
                    'activo' => $view['activo'],
                    'btnEdit' => "<a href='views-edit?views=" . $view['id_vista'] . "' class='btn btn-info rounded-circle btn-sm'><i class='bi bi-info-circle'></i></a>"
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
