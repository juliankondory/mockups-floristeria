<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/System.php';

class ServicePermission extends System
{
    /**
     * Get permissions matrix for admin view
     */
    public static function getPermissionsMatrix()
    {
        try {
            return RoleViewPermission::getPermissionsMatrix();
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Assign bulk permissions to a role
     */
    public static function assignPermissionsToRole($id_rol, $permissions)
    {
        try {
            $asignado_por = $_SESSION['id'];

            if (RoleViewPermission::assignBulkPermissions($id_rol, $permissions, $asignado_por)) {
                return '<script>swal("Permisos actualizados exitosamente", "", "success");</script>';
            } else {
                return '<script>swal("Error al actualizar permisos", "", "error");</script>';
            }
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Get permissions by role
     */
    public static function getPermissionsByRole($id_rol)
    {
        try {
            return RoleViewPermission::getPermissionsByRole($id_rol);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Get all roles for dropdown
     */
    public static function getAllRoles()
    {
        try {
            return Role::listActiveRoles();
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Get all modules grouped (excluding Dev-exclusive modules)
     */
    public static function getModulesGrouped()
    {
        try {
            $modules = Module::listActiveModules();
            $result = [];

            foreach ($modules as $module) {
                // Filtrar módulos exclusivos de Dev (no mostrar en matriz de permisos)
                if (method_exists($module, 'getExclusivo_dev') && $module->getExclusivo_dev() == 1) {
                    continue; // Saltar módulos exclusivos
                }

                $views = View::listViewsByModule($module->getId_modulo());
                $result[] = [
                    'module' => $module,
                    'views' => $views
                ];
            }

            return $result;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Get all permissions
     */
    public static function getAllPermissions()
    {
        try {
            return Permission::listPermissions();
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
