<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/modules/message/ServiceMessage.php';

if(isset($_POST['newMessage'])){
    $response = ServiceMessage::newMessage($_POST['nombre'],$_POST['correo'],$_POST['celular'],$_POST['mensaje']);
}

if(isset($_GET['deleteMessage'])){
    $response = ServiceMessage::deleteMessage($_GET['deleteMessage']);
}

if(basename($_SERVER['PHP_SELF']) == 'messages.php'){
    $tablaMensajes        = ServiceMessage::getTableMessages();
    $actualizarMensajes   = ServiceMessage::updateEstadoMessages();
}

if(isset($_GET)){
    $contadorMensajes     = ServiceMessage::getCountMensajesNoVistos();
}
?>