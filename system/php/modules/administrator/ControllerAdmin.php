<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/modules/administrator/ServiceAdmin.php';

// EndPoint Expuestos

if(isset($_POST['setProfile'])){
    $response = ServiceAdmin::setProfile($_POST['nombre'], $_POST['correo'], $_POST['telefono'], $_POST['cedula']);
}

if(isset($_POST['setPassProfile'])){
    $response = ServiceAdmin::setPassProfile($_POST['pass'], $_POST['newPass'], $_POST['confirmPass']);
}

if(isset($_POST['newAdministrator'])){
    $response = ServiceAdmin::newAdministrator($_POST['nombre'], $_POST['correo'], $_POST['telefono'], $_POST['cedula'], $_POST['pass']);
}

if(isset($_POST['setAdministrator'])){
    $response = ServiceAdmin::setAdministrator($_GET['administrator'],$_POST['nombre'], $_POST['correo'], $_POST['telefono'], $_POST['cedula'], $_POST['estado']);
}

if(isset($_POST['setPassword'])){
    $response = ServiceAdmin::setPassAdministrator($_GET['administrator'],$_POST['newPass'], $_POST['confirmPass']);
}

if(isset($_GET['administrator'])){
    $administrator = ServiceAdmin::getAdministrator($_GET['administrator']);
}

if(isset($_POST['deleteAdministrator'])){
    $response = ServiceAdmin::deleteAdministrator($_GET['administrator']);
}

if(basename($_SERVER['PHP_SELF']) == 'administrators.php'){
    $tablaAdministradores = ServiceAdmin::getTablaAdministradores();
}