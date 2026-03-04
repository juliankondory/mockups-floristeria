<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/model/ClientesDTO.php';

class Clientes extends system
{

    public static function newClientes($nombre, $identificacion, $correo, $telefono, $departamento, $ciudad, $fecha_registro, $id_usuario, $tipo_usuario)
    {
        $dbh  = parent::Conexion();
        $stmt = $dbh->prepare("INSERT INTO Clientes (id_usuario, tipo_usuario, nombre, identificacion, correo, telefono, departamento, ciudad, estado, fecha_registro) 
                                VALUES (:id_usuario, :tipo_usuario, :nombre, :identificacion, :correo, :telefono, :departamento, :ciudad, '1', :fecha_registro)");
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':tipo_usuario', $tipo_usuario);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':identificacion', $identificacion);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':departamento', $departamento);
        $stmt->bindParam(':ciudad', $ciudad);
        $stmt->bindParam(':fecha_registro', $fecha_registro);
        return  $stmt->execute();
    }


    public static function setClientes($id_cliente, $nombre, $identificacion, $correo, $telefono, $departamento, $ciudad, $estado)
    {
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("UPDATE Clientes SET nombre = :nombre, identificacion = :identificacion, correo = :correo, telefono = :telefono, departamento = :departamento, ciudad = :ciudad, estado = :estado WHERE id_cliente = :id_cliente");
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':identificacion', $identificacion);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':departamento', $departamento);
        $stmt->bindParam(':ciudad', $ciudad);
        $stmt->bindParam(':estado', $estado);
        return  $stmt->execute();
    }


    public static function getClientes($id_cliente){
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Clientes WHERE id_cliente = :id_cliente");
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'ClientesDTO');
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function getClientesJs($id_cliente){
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Clientes WHERE id_cliente = :id_cliente");
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->execute();
        return $stmt->fetch();
    }


    public static function listClientes()
    {
        $dbh  = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Clientes");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'ClientesDTO');
        $stmt->execute();
        return  $stmt->fetchAll();
    }
    
    public static function listClientesUsuario($id_usuario)
    {
        $dbh  = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Clientes WHERE id_usuario = :id_usuario AND tipo_usuario = 1");
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'ClientesDTO');
        $stmt->execute();
        return  $stmt->fetchAll();
    }
    
    public static function deleteClientes($id_cliente)
    {
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("DELETE FROM Clientes WHERE id_cliente = :id_cliente");
        $stmt->bindParam(':id_cliente', $id_cliente);
        return  $stmt->execute();
    }

    public static function getCountClientes(){
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("SELECT COUNT(*) as total FROM Clientes");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }

    public static function getCountClientesUsuario($id_usuario){
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("SELECT COUNT(*) as total FROM Clientes WHERE id_usuario = '$id_usuario' AND tipo_usuario = 1");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }
}
