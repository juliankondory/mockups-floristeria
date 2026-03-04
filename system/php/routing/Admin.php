<?php
// Este archivo se incluye desde Index.php que ya maneja la sesión y validación
// No es necesario volver a validar aquí

$response = null;

// ==========================================
// CONTROLLERS DE MÓDULOS PRINCIPALES
// ==========================================

include_once $_SERVER['DOCUMENT_ROOT'].'/system/php/modules/dashboard/ControllerDashboard.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/system/php/modules/administrator/ControllerAdmin.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/system/php/modules/user/ControllerUser.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/system/php/modules/information/ControllerInformation.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/system/php/modules/message/ControllerMessage.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/system/php/modules/client/ControllerClient.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/system/php/modules/testimonial/ControllerTestimonial.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/system/php/modules/page/ControllerPage.php';

// ==========================================
// CONTROLLERS DEL SISTEMA DE ROLES Y PERMISOS
// ==========================================

include_once $_SERVER['DOCUMENT_ROOT'].'/system/php/modules/role/ControllerRole.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/system/php/modules/permission/ControllerPermission.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/system/php/modules/module/ControllerModule.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/system/php/modules/view/ControllerView.php';
?>