<?php
/**
 * SessionHelper
 *
 * Clase helper para cargar datos dinámicos en la sesión basados en roles y permisos
 */
class SessionHelper
{
    /**
     * Cargar dashboard cards basado en el rol del usuario
     *
     * @param int $id_rol ID del rol del usuario
     * @return array Array de cards para el dashboard
     */
    public static function loadDashboardCards($id_rol)
    {
        try {
            $cards = [];

            // Obtener módulos que deben mostrarse en el dashboard y que el rol tiene permiso para ver
            $modules = Module::getDashboardModulesByRole($id_rol);

            foreach ($modules as $module) {
                // Definir icono por defecto si no está configurado
                $icon = !empty($module['icono']) ? $module['icono'] : 'bi-app';

                // Definir color por defecto si no está configurado
                $color = !empty($module['color']) ? $module['color'] : 'l-bg-blue-dark';

                $cards[] = [
                    'name' => $module['nombre'],
                    'title' => $module['titulo'],
                    'icon' => $icon,
                    'color' => $color,
                    'ruta' => $module['ruta']
                ];
            }

            return $cards;
        } catch (\Exception $e) {
            error_log("Error loading dashboard cards: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Cargar menú del sidebar basado en el rol del usuario
     *
     * @param int $id_rol ID del rol del usuario
     * @return array Array de items del menú
     */
    public static function loadSidebarMenu($id_rol)
    {
        try {
            // Obtener módulos que el rol tiene permiso para ver
            $modules = Module::getSidebarModulesByRole($id_rol);

            // Separar módulos padre e hijos
            $parentModules = [];
            $childModules = [];

            foreach ($modules as $module) {
                $icono = !empty($module['icono']) ? $module['icono'] : 'bi-circle';

                $menuItem = [
                    'id_modulo' => $module['id_modulo'],
                    'nombre' => $module['nombre'],
                    'titulo' => $module['titulo'],
                    'ruta' => $module['ruta'],
                    'icono' => $icono,
                    'color' => $module['color'] ?? '',
                    'orden' => $module['orden'],
                    'tipo' => $module['tipo'] ?? 'modulo_hijo',
                    'id_modulo_padre' => $module['id_modulo_padre'],
                    'children' => []
                ];

                if ($menuItem['tipo'] === 'modulo_padre') {
                    $parentModules[$module['id_modulo']] = $menuItem;
                } else {
                    $childModules[] = $menuItem;
                }
            }

            // Asignar hijos a sus padres
            foreach ($childModules as $child) {
                if ($child['id_modulo_padre'] && isset($parentModules[$child['id_modulo_padre']])) {
                    // Es hijo de un módulo padre
                    $parentModules[$child['id_modulo_padre']]['children'][] = $child;
                } else {
                    // No tiene padre o el padre no tiene permisos, agregar como item independiente
                    $parentModules['orphan_' . $child['id_modulo']] = $child;
                }
            }

            // Convertir a array y ordenar
            $menu = array_values($parentModules);
            usort($menu, function($a, $b) {
                return $a['orden'] - $b['orden'];
            });

            // Ordenar hijos dentro de cada padre
            foreach ($menu as &$item) {
                if (!empty($item['children'])) {
                    usort($item['children'], function($a, $b) {
                        return $a['orden'] - $b['orden'];
                    });
                }
            }

            return $menu;
        } catch (\Exception $e) {
            error_log("Error loading sidebar menu: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Verificar si el usuario tiene acceso a un módulo específico
     *
     * @param string $moduleName Nombre del módulo (ej: 'administrators', 'users')
     * @param int $id_rol ID del rol del usuario
     * @return bool True si tiene acceso, False si no
     */
    public static function hasModuleAccess($moduleName, $id_rol)
    {
        try {
            // Obtener el módulo por nombre
            $module = Module::getModuleByName($moduleName);

            if (!$module) {
                // Si el módulo no existe en BD, permitir acceso (páginas públicas o no registradas)
                return true;
            }

            // Verificar si el rol tiene permiso 'access' en alguna vista del módulo
            $views = View::listViewsByModule($module->getId_modulo());

            foreach ($views as $view) {
                if (Permission::hasRoleViewPermission($id_rol, $view->getId_vista(), 'access')) {
                    return true; // Tiene acceso al módulo
                }
            }

            return false; // No tiene acceso a ninguna vista del módulo
        } catch (\Exception $e) {
            error_log("Error checking module access: " . $e->getMessage());
            // En caso de error, denegar acceso por seguridad
            return false;
        }
    }

    /**
     * Inicializar sesión completa del usuario después del login
     *
     * @param object $user Objeto del usuario (Administrador o Usuario)
     * @param string $userType Tipo de usuario ("Administrador" o "Usuario")
     * @param int $tipo Tipo legacy (0, 1, 5)
     */
    public static function initializeUserSession($user, $userType, $tipo)
    {
        try {
            // Datos básicos del usuario
            // Detectar si es administrador o usuario por los métodos disponibles
            if (method_exists($user, 'getId_administrador')) {
                $_SESSION['id'] = $user->getId_administrador();
            } else {
                $_SESSION['id'] = $user->getId_usuario();
            }

            $_SESSION['nombre'] = $user->getNombre();
            $_SESSION['correo'] = $user->getCorreo();
            $_SESSION['cedula'] = $user->getCedula();
            $_SESSION['telefono'] = $user->getTelefono();
            $_SESSION['tipo'] = $tipo;
            $_SESSION['fecha_registro'] = $user->getFecha_registro();
            $_SESSION['usuario'] = $userType;

            // Cargar id_rol basado en tipo_legacy
            $_SESSION['id_rol'] = Role::getRoleIdByLegacyType($tipo);

            // Cargar dashboard cards dinámico
            $_SESSION['dashboard_cards'] = self::loadDashboardCards($_SESSION['id_rol']);

            // Cargar menú del sidebar dinámico
            $_SESSION['sidebar_menu'] = self::loadSidebarMenu($_SESSION['id_rol']);

        } catch (\Exception $e) {
            error_log("Error initializing user session: " . $e->getMessage());
            // En caso de error, inicializar arrays vacíos
            $_SESSION['dashboard_cards'] = [];
            $_SESSION['sidebar_menu'] = [];
        }
    }
}
