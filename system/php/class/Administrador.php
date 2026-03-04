<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/model/AdministradorDTO.php';
class Administrador extends System
{

    public static function newAdministrator($nombre, $correo, $telefono, $cedula, $pass_hash, $estado, $tipo, $fecha_registro)
    {
        $validarAdmin = self::validateAdministrator($cedula, $correo, null);
        $validarUser = Usuario::validateUser($cedula, $correo, null);

        if (!$validarAdmin && !$validarUser) {
            $dbh             = parent::Conexion();
            $stmt = $dbh->prepare("INSERT INTO Administrador (nombre, correo, telefono, cedula, pass, estado, tipo, fecha_registro) 
                                VALUES (:nombre, :correo, :telefono, :cedula, :pass, :estado, :tipo, :fecha_registro)");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':cedula', $cedula);
            $stmt->bindParam(':pass', $pass_hash);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':fecha_registro', $fecha_registro);
            return  $stmt->execute();
        } else {
            return false;
        }
    }

    public static function setAdministrator($id_administrador, $nombre, $correo, $telefono, $cedula, $estado)
    {
        $validarAdmin = self::validateAdministrator($cedula, $correo, $id_administrador);
        $validarUser = Usuario::validateUser($cedula, $correo, null);

        if (!$validarAdmin && !$validarUser) {
            $dbh             = parent::Conexion();
            $stmt = $dbh->prepare("UPDATE Administrador SET nombre = :nombre, correo = :correo, telefono = :telefono, cedula = :cedula, estado = :estado WHERE id_administrador = :id_administrador ");
            $stmt->bindParam(':id_administrador', $id_administrador);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':cedula', $cedula);
            $stmt->bindParam(':estado', $estado);
            return  $stmt->execute();
        } else {
            return false;
        }
    }



    public static function getAdministrador($cedula, $pass_hash)
    {
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Administrador WHERE cedula = :cedula AND pass = :pass AND estado = 1");
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':pass', $pass_hash);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'AdministradorDTO');
        $stmt->execute();
        return  $stmt->fetch();
    }


    public static function listAdministrador($id_administrador)
    {
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Administrador WHERE id_administrador != :id_administrador ");
        $stmt->bindParam(':id_administrador', $id_administrador);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'AdministradorDTO');
        $stmt->execute();
        return  $stmt->fetchAll();
    }


    public static function getAdministradorByCedula($cedula)
    {
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Administrador WHERE cedula = :cedula ");
        $stmt->bindParam(':cedula', $cedula);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'AdministradorDTO');
        $stmt->execute();
        return  $stmt->fetch();
    }

    public static function getAdministradorById($id_administrador)
    {
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Administrador WHERE id_administrador = :id_administrador ");
        $stmt->bindParam(':id_administrador', $id_administrador);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'AdministradorDTO');
        $stmt->execute();
        return  $stmt->fetch();
    }

    public static function setAdministradorPass($id_administrador, $pass_hash)
    {
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("UPDATE Administrador SET pass = :pass WHERE id_administrador = :id_administrador ");
        $stmt->bindParam(':id_administrador', $id_administrador);
        $stmt->bindParam(':pass', $pass_hash);
        return  $stmt->execute();
    }


    public static function setAdministratorProfile($id_administrador, $nombre, $correo, $telefono, $cedula)
    {
        $validarAdmin = self::validateAdministrator($cedula, $correo, $id_administrador);
        $validarUser = Usuario::validateUser($cedula, $correo, null);

        if (!$validarAdmin && !$validarUser) {
            $dbh             = parent::Conexion();
            $stmt = $dbh->prepare("UPDATE Administrador SET nombre = :nombre, correo = :correo, telefono = :telefono, cedula = :cedula WHERE id_administrador = :id_administrador ");
            $stmt->bindParam(':id_administrador', $id_administrador);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':cedula', $cedula);
            return  $stmt->execute();
        } else {
            return false;
        }
    }

    public static function deleteAdministrador($id_administrador)
    {
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("DELETE FROM Administrador WHERE id_administrador = :id_administrador ");
        $stmt->bindParam(':id_administrador', $id_administrador);
        return  $stmt->execute();
    }

    public static function validateAdministrator($cedula, $correo, $id_administrador)
    {
        $dbh             = parent::Conexion();

        if ($id_administrador == null) {
            $stmt = $dbh->prepare("SELECT * FROM Administrador WHERE cedula = :cedula OR correo = :correo");
        } else {
            $stmt = $dbh->prepare("SELECT * FROM Administrador WHERE (cedula = :cedula OR correo = :correo) AND id_administrador != :id_administrador");
            $stmt->bindParam(':id_administrador', $id_administrador);
        }
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':correo', $correo);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'AdministradorDTO');
        $stmt->execute();

        if ($stmt->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    public static function lastAdministrator(){
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Administrador ORDER BY id_administrador DESC LIMIT 1");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'AdministradorDTO');
        $stmt->execute();
        return  $stmt->fetch();
    }

    public static function countAdministrators(){
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("SELECT count(*) as contador FROM Administrador");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['contador'];
    }
}
