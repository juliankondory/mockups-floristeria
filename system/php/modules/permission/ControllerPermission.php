<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/modules/permission/ServicePermission.php';

// EndPoint Expuestos

if (isset($_POST['savePermissions'])) {
    // Recibir datos del formulario
    $id_rol = $_POST['id_rol'];
    $permissions = [];

    // Procesar checkboxes marcados (ahora solo contienen id_vista)
    if (isset($_POST['permissions']) && is_array($_POST['permissions'])) {
        foreach ($_POST['permissions'] as $id_vista) {
            $permissions[] = [
                'id_vista' => $id_vista,
                'id_permiso' => 1  // Siempre usamos permiso ID=1 (access)
            ];
        }
    }

    $response = ServicePermission::assignPermissionsToRole($id_rol, $permissions);
}

if (basename($_SERVER['PHP_SELF']) == 'permissions-matrix.php') {
    $roles = ServicePermission::getAllRoles();
    $modulesGrouped = ServicePermission::getModulesGrouped();
    $allPermissions = ServicePermission::getAllPermissions();

    // Si se seleccionó un rol, obtener sus permisos
    if (isset($_GET['role'])) {
        $selectedRole = $_GET['role'];
        $rolePermissions = ServicePermission::getPermissionsByRole($selectedRole);
    }
}
