<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/Elements.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/class/System.php';
session_start();

date_default_timezone_set('America/Bogota');
System::validarSession();

$userType = $_SESSION['tipo'] ?? null;
$userId = $_SESSION['id'] ?? null;

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'];
$baseFolder = '/system/views/admin/';
$baseUrl = $protocol . $host . $baseFolder;

$currentPath = $_SERVER['REQUEST_URI'];
$pathParts = explode('/', trim($currentPath, '/'));

// ==========================================
// SISTEMA DINÁMICO - Permisos desde la BD
// ==========================================

// Obtener cartas visibles para el dashboard desde la sesión (cargadas en el login)
$visibleCards = isset($_SESSION['dashboard_cards']) ? $_SESSION['dashboard_cards'] : [];

// Obtener id_rol desde la sesión
$id_rol = isset($_SESSION['id_rol']) ? $_SESSION['id_rol'] : null;

// Verificar acceso al módulo actual usando permisos dinámicos
$hasAccess = System::checkModuleAccess($pathParts, $id_rol);
if (!$hasAccess) {
    System::handleAccessDenied($baseUrl);
}

$response = System::processAccessDeniedMessage();

// ==========================================
// ROUTING DINÁMICO
// El menú del sidebar ya está cargado en $_SESSION['sidebar_menu']
// ==========================================

// Cargar el routing correspondiente según el tipo de usuario
switch ($userType) {
    case 0: // Dev
    case 5: // Administrador
    case 1: // Operativo
    case 2: // Mensajero
        include_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/routing/Admin.php';
        $itemsSlider = $_SERVER['DOCUMENT_ROOT'] . '/system/assets/html/sidebar-dynamic.php';
        break;
    default:
        header("Location: /");
        break;
}
?>
