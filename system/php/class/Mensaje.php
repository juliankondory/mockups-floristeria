<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/model/MensajeDTO.php';

class Mensaje extends system
{
    public static function newMensaje($nombre, $correo, $celular, $mensaje, $ip, $fecha_registro)
    {
        $dbh  = parent::Conexion();
        $stmt = $dbh->prepare("INSERT INTO Mensaje (nombre, correo, telefono, mensaje, ip, estado, fecha_creacion) 
                                VALUES (:nombre, :correo, :telefono, :mensaje, :ip, '0', :fecha_creacion)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':telefono', $celular);
        $stmt->bindParam(':mensaje', $mensaje);
        $stmt->bindParam(':ip', $ip);
        $stmt->bindParam(':fecha_creacion', $fecha_registro);
        return  $stmt->execute();
    }

    public static function listMensaje()
    {
        $dbh  = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Mensaje ORDER BY fecha_creacion DESC");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'MensajeDTO');
        $stmt->execute();
        return  $stmt->fetchAll();
    }

    public static function deleteMensaje($id_mensaje)
    {
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("DELETE FROM Mensaje WHERE id_mensaje = :id_mensaje ");
        $stmt->bindParam(':id_mensaje', $id_mensaje);
        return  $stmt->execute();
    }

    public static function getCountMensajesNoVistos(){
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("SELECT COUNT(estado) as total FROM Mensaje WHERE estado = '0'");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }

    public static function getCountMensajes(){
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("SELECT COUNT(*) as total FROM Mensaje");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }

    public static function updateEstadoMensajes(){
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("UPDATE Mensaje SET estado = '1' WHERE estado = '0'");
        return  $stmt->execute();
    }

}
