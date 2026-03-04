<?php

class TestimonioDTO
{
    protected $id_testimonio ;
    protected $nombre;
    protected $genero;
    protected $opinion;
    protected $calificacion;
    protected $fecha_registro;

    public function __construct()
    {
    }



    /**
     * Get the value of id_testimonio
     */
    public function getIdTestimonio()
    {
        return $this->id_testimonio;
    }

    /**
     * Set the value of id_testimonio
     */
    public function setIdTestimonio($id_testimonio)
    {
        $this->id_testimonio = $id_testimonio;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of fecha_registro
     */
    public function getFechaRegistro()
    {
        return $this->fecha_registro;
    }

    /**
     * Set the value of fecha_registro
     */
    public function setFechaRegistro($fecha_registro)
    {
        $this->fecha_registro = $fecha_registro;

        return $this;
    }

    /**
     * Get the value of opinion
     */
    public function getOpinion()
    {
        return $this->opinion;
    }

    /**
     * Set the value of opinion
     */
    public function setOpinion($opinion)
    {
        $this->opinion = $opinion;

        return $this;
    }

    /**
     * Get the value of genero
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set the value of genero
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get the value of calificacion
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * Set the value of calificacion
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;

        return $this;
    }
}
