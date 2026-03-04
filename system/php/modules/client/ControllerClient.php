<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/modules/client/ServiceClient.php';

if(isset($_POST['newCliente'])){
    $response = ServiceClient::newClientes($_POST['nombre'], $_POST['identificacion'], $_POST['correo'], $_POST['telefono'], $_POST['departamento'], $_POST['ciudad']);
}

if(isset($_POST['setCliente'])){
    $response = ServiceClient::setClientes($_POST['id_cliente'], $_POST['nombre'], $_POST['identificacion'], $_POST['correo'], $_POST['telefono'], $_POST['departamento'], $_POST['ciudad'], $_POST['estado']);
}

if(isset($_POST['getCliente'])){
    $testimonio = ServiceClient::getInfoClientes($_POST['id_cliente']);
    echo $testimonio;
}

if(isset($_POST['deleteCliente'])){
    $menu = ServiceClient::deleteClientes($_POST['id_cliente']);
}

if(basename($_SERVER['PHP_SELF']) == 'clients.php'){
    $tablaClientes        = ServiceClient::getTableClientes();
    $tablaClientesUsuario = ServiceClient::getTableClientesUsuario();
}
?>