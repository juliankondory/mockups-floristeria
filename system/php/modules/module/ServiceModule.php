<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/Module.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/Elements.php';

class ServiceModule
{
    public static function newModule($nombre, $titulo, $descripcion, $ruta, $icono, $color, $mostrar_en_dashboard, $orden, $activo, $tipo = 'modulo_hijo', $id_modulo_padre = null)
    {
        try {
            $result = Module::newModule($nombre, $titulo, $descripcion, $ruta, $icono, $color, $mostrar_en_dashboard, $orden, $activo, 0, $tipo, $id_modulo_padre);
            if ($result) {
                return '<script>swal("' . Constants::$REGISTER_NEW . '", "", "success");</script>';
            } else {
                return '<script>swal("Ya existe un módulo con ese nombre", "", "error");</script>';
            }
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function setModule($id_modulo, $nombre, $titulo, $descripcion, $ruta, $icono, $color, $mostrar_en_dashboard, $orden, $activo, $tipo = 'modulo_hijo', $id_modulo_padre = null)
    {
        try {
            $result = Module::setModule($id_modulo, $nombre, $titulo, $descripcion, $ruta, $icono, $color, $mostrar_en_dashboard, $orden, $activo, 0, $tipo, $id_modulo_padre);
            if ($result) {
                return '<script>swal("' . Constants::$REGISTER_UPDATE . '", "", "success");</script>';
            } else {
                return '<script>swal("Ya existe un módulo con ese nombre", "", "error");</script>';
            }
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getModuleById($id_modulo)
    {
        try {
            return Module::getModuleById($id_modulo);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function deleteModule($id_modulo)
    {
        try {
            $result = Module::deleteModule($id_modulo);
            if ($result) {
                return '<script>swal("' . Constants::$REGISTER_DELETE . '", "", "success");</script>';
            } else {
                return '<script>swal("Error al eliminar el módulo", "", "error");</script>';
            }
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getTablaModules()
    {
        try {
            $tableHtml = "";
            $modelResponse = Module::listModules();

            foreach ($modelResponse as $module) {
                $tableHtml .= '<tr>';
                $tableHtml .= '<td>' . $module->getNombre() . '</td>';
                $tableHtml .= '<td>' . $module->getTitulo() . '</td>';
                $tableHtml .= '<td>' . $module->getRuta() . '</td>';
                $tableHtml .= '<td class="text-center"><i class="bi ' . $module->getIcono() . '" style="color: ' . $module->getColor() . '; font-size: 1.5rem;"></i></td>';
                $tableHtml .= '<td class="text-center">' . $module->getOrden() . '</td>';

                // Dashboard badge
                if ($module->getMostrar_en_dashboard() == 1) {
                    $tableHtml .= '<td class="text-center"><span class="badge bg-success">Sí</span></td>';
                } else {
                    $tableHtml .= '<td class="text-center"><span class="badge bg-secondary">No</span></td>';
                }

                // Estado
                $estado = $module->getActivo();
                if ($estado[0] == 1) $tableHtml .= '<td><span class="badge bg-success">' . $estado[1] . '</span></td>';
                else $tableHtml .= '<td><span class="badge bg-danger">' . $estado[1] . '</span></td>';

                // Botones
                $tableHtml .= '<td>';
                $tableHtml .= "<a href='modules-edit?modules=" . $module->getId_modulo() . "' class='btn btn-info rounded-circle btn-sm'><i class='bi bi-info-circle'></i></a>";
                $tableHtml .= '</td>';

                $tableHtml .= '</tr>';
            }
            return $tableHtml;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getModules()
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
            $result = Module::getPaginated($page, $length, $searchValue);

            // Format data for DataTables
            $data = [];
            foreach ($result['data'] as $module) {
                $data[] = [
                    'id_modulo' => $module->getId_modulo(),
                    'nombre' => $module->getNombre(),
                    'titulo' => $module->getTitulo(),
                    'tipo' => $module->getTipo(),
                    'ruta' => $module->getRuta(),
                    'icono' => $module->getIcono(),
                    'color' => $module->getColor(),
                    'orden' => $module->getOrden(),
                    'mostrar_en_dashboard' => $module->getMostrar_en_dashboard(),
                    'activo' => $module->getActivo()[0],
                    'btnEdit' => "<a href='modules-edit?modules=" . $module->getId_modulo() . "' class='btn btn-info rounded-circle btn-sm'><i class='bi bi-info-circle'></i></a>"
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

    public static function getParentModules()
    {
        try {
            return Module::getParentModules();
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
