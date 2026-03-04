<?php

class PermissionDTO
{
    protected $id_permiso;
    protected $nombre;
    protected $descripcion;
    protected $fecha_registro;

    public function __construct()
    {
    }

    /**
     * Get the value of id_permiso
     */
    public function getId_permiso()
    {
        return $this->id_permiso;
    }

    /**
     * Set the value of id_permiso
     *
     * @return  self
     */
    public function setId_permiso($id_permiso)
    {
        $this->id_permiso = $id_permiso;
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
}

?>
