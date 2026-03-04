<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/model/UsuarioDTO.php';

class Usuario extends System
{
    public static function newUser($nombre, $correo, $telefono, $cedula, $pass_hash, $estado, $tipo, $fecha_registro)
    {
        $validarUser = self::validateUser($cedula, $correo, null);
        $validarAdmin = Administrador::validateAdministrator($cedula, $correo, null);

        if (!$validarAdmin && !$validarUser) {
            $dbh             = parent::Conexion();
            $stmt = $dbh->prepare("INSERT INTO Usuario (nombre, correo, telefono, cedula, pass, estado, tipo, fecha_registro) 
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

    public static function setUser($id_usuario, $nombre, $correo, $telefono, $cedula, $estado)
    {
        $validarUser = self::validateUser($cedula, $correo, $id_usuario);
        $validarAdmin = Administrador::validateAdministrator($cedula, $correo, null);

        if (!$validarAdmin && !$validarUser) {
            $dbh             = parent::Conexion();
            $stmt = $dbh->prepare("UPDATE Usuario SET nombre = :nombre, correo = :correo, telefono = :telefono, cedula = :cedula, estado = :estado WHERE id_usuario = :id_usuario ");
            $stmt->bindParam(':id_usuario', $id_usuario);
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



    public static function getUser($cedula, $pass_hash)
    {
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Usuario WHERE cedula = :cedula AND pass = :pass AND estado = 1");
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':pass', $pass_hash);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'UsuarioDTO');
        $stmt->execute();
        return  $stmt->fetch();
    }


    public static function listUser()
    {
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Usuario");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'UsuarioDTO');
        $stmt->execute();
        return  $stmt->fetchAll();
    }


    public static function getUserByCedula($cedula)
    {
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Usuario WHERE cedula = :cedula ");
        $stmt->bindParam(':cedula', $cedula);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'UsuarioDTO');
        $stmt->execute();
        return  $stmt->fetch();
    }

    public static function getUserById($id_usuario)
    {
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Usuario WHERE id_usuario = :id_usuario ");
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'UsuarioDTO');
        $stmt->execute();
        return  $stmt->fetch();
    }

    public static function setUserPass($id_usuario, $pass_hash)
    {
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("UPDATE Usuario SET pass = :pass WHERE id_usuario = :id_usuario ");
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':pass', $pass_hash);
        return  $stmt->execute();
    }


    public static function setUserProfile($id_usuario, $nombre, $correo, $telefono, $cedula)
    {
        $validarUser = self::validateUser($cedula, $correo, $id_usuario);
        $validarAdmin = Administrador::validateAdministrator($cedula, $correo, null);

        if (!$validarAdmin && !$validarUser) {
            $dbh             = parent::Conexion();
            $stmt = $dbh->prepare("UPDATE Usuario SET nombre = :nombre, correo = :correo, telefono = :telefono, cedula = :cedula WHERE id_usuario = :id_usuario ");
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':cedula', $cedula);
            return  $stmt->execute();
        } else {
            return false;
        }
    }

    public static function deleteUser($id_usuario)
    {
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("DELETE FROM Usuario WHERE id_usuario = :id_usuario");
        $stmt->bindParam(':id_usuario', $id_usuario);
        return  $stmt->execute();
    }

    public static function validateUser($cedula, $correo, $id_usuario)
    {
        $dbh  = parent::Conexion();

        if ($id_usuario == null) {
            $stmt = $dbh->prepare("SELECT * FROM Usuario WHERE cedula = :cedula OR correo = :correo");
        } else {
            $stmt = $dbh->prepare("SELECT * FROM Usuario WHERE (cedula = :cedula OR correo = :correo) AND id_usuario != :id_usuario");
            $stmt->bindParam(':id_usuario', $id_usuario);
        }

        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':correo', $correo);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'UsuarioDTO');
        $stmt->execute();

        if ($stmt->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    public static function lastUsuario(){
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Usuario ORDER BY id_usuario DESC LIMIT 1");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'UsuarioDTO');
        $stmt->execute();
        return  $stmt->fetch();
    }
    
    public static function countUsuarios(){
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("SELECT count(*) as total FROM Usuario");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }
}
