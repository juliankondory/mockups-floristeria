<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/modules/role/ServiceRole.php';

// EndPoint Expuestos

// DataTable endpoint
if (isset($_POST['getRoles'])) {
    ServiceRole::getRoles();
}

// JSON endpoints con patrón estandarizado
if (isset($_POST['newRole'])) {
    $data = json_decode($_POST['data'], true);
    ServiceRole::newRole($data['nombre'], $data['descripcion'], $data['tipo_legacy']);
}

if (isset($_POST['setRole'])) {
    $data = json_decode($_POST['data'], true);
    ServiceRole::setRole($data['id_rol'], $data['nombre'], $data['descripcion'], $data['tipo_legacy'], $data['activo']);
}

if (isset($_POST['deleteRole'])) {
    $data = json_decode($_POST['data'], true);
    ServiceRole::deleteRole($data['id_rol']);
}

// Soportar tanto ?role= como ?roles= para compatibilidad
if (isset($_GET['role']) || isset($_GET['roles'])) {
    $id_rol = isset($_GET['role']) ? $_GET['role'] : $_GET['roles'];
    $role = ServiceRole::getRoleById($id_rol);
}

if (basename($_SERVER['PHP_SELF']) == 'roles.php') {
    $tablaRoles = ServiceRole::getTablaRoles();
}
