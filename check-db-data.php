<?php
require_once 'system/php/class/System.php';
require_once 'system/php/class/Informacion.php';

try {
    $info = Informacion::getInformacion();
    if ($info) {
        echo json_encode($info, JSON_PRETTY_PRINT);
    } else {
        echo "No info found in database.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
