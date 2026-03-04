<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/modules/view/ServiceView.php';

// EndPoint Expuestos

// DataTable endpoint
if (isset($_POST['getViews'])) {
    ServiceView::getViews();
}

if (isset($_POST['newView'])) {
    $id_modulo = $_POST['id_modulo'];
    $nombre = $_POST['nombre'];
    $ruta = $_POST['ruta'];
    $descripcion = $_POST['descripcion'];
    $activo = $_POST['activo'];
    $orden = $_POST['orden'] ?? 0;

    $response = ServiceView::newView($id_modulo, $nombre, $ruta, $descripcion, $activo, $orden);
}

if (isset($_POST['setView'])) {
    $id_vista = $_POST['id_vista'];
    $id_modulo = $_POST['id_modulo'];
    $nombre = $_POST['nombre'];
    $ruta = $_POST['ruta'];
    $descripcion = $_POST['descripcion'];
    $activo = $_POST['activo'];
    $orden = $_POST['orden'] ?? 0;

    $response = ServiceView::setView($id_vista, $id_modulo, $nombre, $ruta, $descripcion, $activo, $orden);
}

if (isset($_POST['deleteView'])) {
    $id_vista = $_POST['id_vista'];
    $response = ServiceView::deleteView($id_vista);
}

if (basename($_SERVER['PHP_SELF']) == 'views.php') {
    $modules = ServiceView::getAllModules();
    $tablaViews = ServiceView::getTablaViews();
}

if (basename($_SERVER['PHP_SELF']) == 'views-edit.php') {
    $modules = ServiceView::getAllModules();

    if (isset($_GET['views'])) {
        $id_vista = $_GET['views'];
        $view = ServiceView::getViewById($id_vista);
    }
}
