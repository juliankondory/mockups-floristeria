<?php

class RoleDTO
{
    protected $id_rol;
    protected $nombre;
    protected $descripcion;
    protected $tipo_legacy;
    protected $activo;
    protected $fecha_registro;

    public function __construct()
    {
    }

    /**
     * Get the value of id_rol
     */
    public function getId_rol()
    {
        return $this->id_rol;
    }

    /**
     * Set the value of id_rol
     *
     * @return  self
     */
    public function setId_rol($id_rol)
    {
        $this->id_rol = $id_rol;
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
     * Get the value of tipo_legacy
     */
    public function getTipo_legacy()
    {
        return $this->tipo_legacy;
    }

    /**
     * Set the value of tipo_legacy
     *
     * @return  self
     */
    public function setTipo_legacy($tipo_legacy)
    {
        $this->tipo_legacy = $tipo_legacy;
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
}

?>
