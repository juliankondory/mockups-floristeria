<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/model/TestimonioDTO.php';

class Testimonio extends system
{

    public static function newTestimonio($nombre, $genero, $opinion, $calificacion, $fecha_registro)
    {
        $dbh  = parent::Conexion();
        $stmt = $dbh->prepare("INSERT INTO Testimonio (nombre, genero, opinion, calificacion, fecha_registro) 
                                VALUES (:nombre, :genero, :opinion, :calificacion, :fecha_registro)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':opinion', $opinion);
        $stmt->bindParam(':calificacion', $calificacion);
        $stmt->bindParam(':fecha_registro', $fecha_registro);
        return  $stmt->execute();
    }


    public static function setTestimonio($id_testimonio, $nombre, $genero, $opinion, $calificacion)
    {
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("UPDATE Testimonio SET nombre = :nombre, genero = :genero, opinion = :opinion, calificacion = :calificacion WHERE id_testimonio = :id_testimonio");
        $stmt->bindParam(':id_testimonio', $id_testimonio);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':opinion', $opinion);
        $stmt->bindParam(':calificacion', $calificacion);
        return  $stmt->execute();
    }


    public static function getTestimonio($id_testimonio){
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Testimonio WHERE id_testimonio = :id_testimonio");
        $stmt->bindParam(':id_testimonio', $id_testimonio);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'TestimonioDTO');
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function getTestimonioJs($id_testimonio){
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Testimonio WHERE id_testimonio = :id_testimonio");
        $stmt->bindParam(':id_testimonio', $id_testimonio);
        $stmt->execute();
        return $stmt->fetch();
    }


    public static function listTestimonio()
    {
        $dbh  = parent::Conexion();
        $stmt = $dbh->prepare("SELECT * FROM Testimonio");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'TestimonioDTO');
        $stmt->execute();
        return  $stmt->fetchAll();
    }
    
    public static function deleteTestimonio($id_testimonio)
    {
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("DELETE FROM Testimonio WHERE id_testimonio = :id_testimonio");
        $stmt->bindParam(':id_testimonio', $id_testimonio);
        return  $stmt->execute();
    }

    public static function getCountTestimonio(){
        $dbh             = parent::Conexion();
        $stmt = $dbh->prepare("SELECT COUNT(*) as total FROM Testimonio");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }

}
