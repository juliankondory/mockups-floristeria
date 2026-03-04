<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/System.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/Mensaje.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/Clientes.php';

class ServiceDashboard extends System
{
    // ==========================================
    // MÉTODOS LEGACY (mantenidos por compatibilidad)
    // ==========================================

    public static function getCountsCardsAdmin()
    {
        try {
            $listCounts = array();
            $listCounts[0] = (Administrador::countAdministrators());
            $listCounts[1] = (Usuario::countUsuarios());
            $listCounts[2] = (Mensaje::getCountMensajes());
            $listCounts[3] = (Clientes::getCountClientes());
            return $listCounts;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function getCountsCardsUser()
    {
        try {
            $id_usuario = $_SESSION['id'];

            $listCounts = array();
            $listCounts[0] = (Mensaje::getCountMensajes());
            $listCounts[2] = (Clientes::getCountClientesUsuario($id_usuario));
            return $listCounts;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // ==========================================
    // MÉTODOS DINÁMICOS - Sistema de Roles y Permisos
    // ==========================================

    /**
     * Obtener cards del dashboard según permisos del usuario
     * @return array Array de cards con su información y count
     */
    public static function getDashboardCards()
    {
        try {
            // Obtener id_rol desde la sesión
            $id_rol = $_SESSION['id_rol'] ?? null;

            if (!$id_rol) {
                return [];
            }

            // Obtener módulos que deben mostrarse en el dashboard
            $modules = Module::getDashboardModulesByRole($id_rol);

            $cards = [];
            foreach ($modules as $module) {
                $cards[] = [
                    'name' => $module['nombre'],
                    'title' => $module['titulo'],
                    'icon' => $module['icono'] ?? 'bi-app',
                    'color' => $module['color'] ?? '#6c757d',
                    'ruta' => $module['ruta'],
                    'count' => self::getModuleCount($module['nombre'])
                ];
            }

            return $cards;
        } catch (\Throwable $th) {
            error_log("Error getting dashboard cards: " . $th->getMessage());
            return [];
        }
    }

    /**
     * Obtener el count de registros según el nombre del módulo
     * @param string $moduleName Nombre del módulo
     * @return int Count de registros
     */
    private static function getModuleCount($moduleName)
    {
        try {
            switch ($moduleName) {
                case 'dashboard':
                    // El dashboard no tiene conteo de registros
                    return 0;
                case 'administrators':
                    return Administrador::countAdministrators();
                case 'users':
                    return Usuario::countUsuarios();
                case 'messages':
                    return Mensaje::getCountMensajes();
                case 'clients':
                    return Clientes::getCountClientes();
                case 'modules':
                    return Module::countModules();
                case 'views':
                    return View::countViews();
                case 'roles':
                    return Role::countRoles();
                default:
                    return 0;
            }
        } catch (\Throwable $th) {
            error_log("Error getting count for module {$moduleName}: " . $th->getMessage());
            return 0;
        }
    }
}
