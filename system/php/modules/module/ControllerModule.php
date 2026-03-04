<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/modules/module/ServiceModule.php';

// EndPoint Expuestos

// DataTable endpoint
if (isset($_POST['getModules'])) {
    ServiceModule::getModules();
}

// Get parent modules for hierarchical dropdown
if (isset($_POST['getParentModules'])) {
    try {
        $parentModules = ServiceModule::getParentModules();
        $data = [];

        foreach ($parentModules as $module) {
            $data[] = [
                'id_modulo' => $module->getId_modulo(),
                'nombre' => $module->getNombre(),
                'titulo' => $module->getTitulo()
            ];
        }

        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $data
        ]);
        exit;
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
        exit;
    }
}

if (isset($_POST['newModule'])) {
    $nombre = $_POST['nombre'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $ruta = $_POST['ruta'];
    $icono = $_POST['icono'];
    $color = $_POST['color'];
    $mostrar_en_dashboard = isset($_POST['mostrar_en_dashboard']) ? 1 : 0;
    $orden = $_POST['orden'];
    $activo = $_POST['activo'];
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : 'modulo_hijo';
    $id_modulo_padre = !empty($_POST['id_modulo_padre']) ? $_POST['id_modulo_padre'] : null;

    $response = ServiceModule::newModule($nombre, $titulo, $descripcion, $ruta, $icono, $color, $mostrar_en_dashboard, $orden, $activo, $tipo, $id_modulo_padre);
}

if (isset($_POST['setModule'])) {
    $id_modulo = $_POST['id_modulo'];
    $nombre = $_POST['nombre'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $ruta = $_POST['ruta'];
    $icono = $_POST['icono'];
    $color = $_POST['color'];
    $mostrar_en_dashboard = isset($_POST['mostrar_en_dashboard']) ? 1 : 0;
    $orden = $_POST['orden'];
    $activo = $_POST['activo'];
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : 'modulo_hijo';
    $id_modulo_padre = !empty($_POST['id_modulo_padre']) ? $_POST['id_modulo_padre'] : null;

    $response = ServiceModule::setModule($id_modulo, $nombre, $titulo, $descripcion, $ruta, $icono, $color, $mostrar_en_dashboard, $orden, $activo, $tipo, $id_modulo_padre);
}

if (isset($_POST['deleteModule'])) {
    $id_modulo = $_POST['id_modulo'];
    $response = ServiceModule::deleteModule($id_modulo);
}

if (basename($_SERVER['PHP_SELF']) == 'modules.php') {
    $tablaModules = ServiceModule::getTablaModules();
}

if (basename($_SERVER['PHP_SELF']) == 'modules-edit.php') {
    if (isset($_GET['modules'])) {
        $id_modulo = $_GET['modules'];
        $module = ServiceModule::getModuleById($id_modulo);
    }
}
