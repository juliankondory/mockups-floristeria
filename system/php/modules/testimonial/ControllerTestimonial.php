<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/modules/testimonial/ServiceTestimonial.php';

if(isset($_POST['newTestimonio'])){
    $response = ServiceTestimonial::newTestimonio($_POST['estrellas'], $_POST['nombre'], $_POST['genero'], $_POST['opinion']);
}


if(isset($_POST['setTestimonio'])){
    $response = ServiceTestimonial::setTestimonio($_POST['id_testimonio'],$_POST['estrellas'], $_POST['nombre'], $_POST['genero'], $_POST['opinion']);
}


if(isset($_POST['getTestimonio'])){
    $testimonio = ServiceTestimonial::getInfoTestimonio($_POST['id_testimonio']);
    echo $testimonio;
}

if(isset($_POST['deleteTestimonio'])){
    $menu = ServiceTestimonial::deleteTestimonio($_POST['id_testimonio']);
}

if(isset($_GET)){
    $tablaTestimonios       = ServiceTestimonial::getTableTestimonios();
    $testimoniosPagina      = ServiceTestimonial::getTestimoniosPagina();
}
?>