<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/modules/dashboard/ServiceDashboard.php';

if(basename($_SERVER['PHP_SELF']) == 'index.php'){
    // Mantener métodos legacy por compatibilidad
    $listCountsAdmin = ServiceDashboard::getCountsCardsAdmin();
    $listCountsUser = ServiceDashboard::getCountsCardsUser();

    // Cargar dashboard cards dinámicas basadas en permisos
    $dashboardCards = ServiceDashboard::getDashboardCards();
}

?>