<?php

class ViewDTO
{
    protected $id_vista;
    protected $id_modulo;
    protected $nombre;
    protected $ruta;
    protected $descripcion;
    protected $activo;
    protected $orden;
    protected $fecha_registro;

    public function __construct()
    {
    }

    /**
     * Get the value of id_vista
     */
    public function getId_vista()
    {
        return $this->id_vista;
    }

    /**
     * Set the value of id_vista
     *
     * @return  self
     */
    public function setId_vista($id_vista)
    {
        $this->id_vista = $id_vista;
        return $this;
    }

    /**
     * Get the value of id_modulo
     */
    public function getId_modulo()
    {
        return $this->id_modulo;
    }

    /**
     * Set the value of id_modulo
     *
     * @return  self
     */
    public function setId_modulo($id_modulo)
    {
        $this->id_modulo = $id_modulo;
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
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * Get the value of ruta
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set the value of ruta
     *
     * @return  self
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;
        return $this;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    /**
     * Get the value of activo
     */
    public function getActivo()
    {
        if ($this->activo == 1) return explode(";", $this->activo . ';Activo');
        if ($this->activo == 0) return explode(";", $this->activo . ';Inactivo');
        return $this->activo;
    }

    /**
     * Set the value of activo
     *
     * @return  self
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
        return $this;
    }

    /**
     * Get the value of fecha_registro
     */
    public function getFecha_registro()
    {
        return $this->fecha_registro;
    }

    /**
     * Set the value of fecha_registro
     *
     * @return  self
     */
    public function setFecha_registro($fecha_registro)
    {
        $this->fecha_registro = $fecha_registro;
        return $this;
    }

    /**
     * Get the value of orden
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set the value of orden
     *
     * @return  self
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
        return $this;
    }
}

?>
