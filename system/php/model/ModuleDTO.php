<?php

class ModuleDTO
{
    protected $id_modulo;
    protected $nombre;
    protected $titulo;
    protected $descripcion;
    protected $ruta;
    protected $icono;
    protected $color;
    protected $mostrar_en_dashboard;
    protected $tipo;
    protected $id_modulo_padre;
    protected $orden;
    protected $activo;
    protected $exclusivo_dev;
    protected $fecha_registro;

    public function __construct()
    {
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
     * Get the value of titulo
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     *
     * @return  self
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
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
     * Get the value of icono
     */
    public function getIcono()
    {
        return $this->icono;
    }

    /**
     * Set the value of icono
     *
     * @return  self
     */
    public function setIcono($icono)
    {
        $this->icono = $icono;
        return $this;
    }

    /**
     * Get the value of color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the value of color
     *
     * @return  self
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * Get the value of mostrar_en_dashboard
     */
    public function getMostrar_en_dashboard()
    {
        return $this->mostrar_en_dashboard;
    }

    /**
     * Set the value of mostrar_en_dashboard
     *
     * @return  self
     */
    public function setMostrar_en_dashboard($mostrar_en_dashboard)
    {
        $this->mostrar_en_dashboard = $mostrar_en_dashboard;
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
     * Get the value of exclusivo_dev
     */
    public function getExclusivo_dev()
    {
        return $this->exclusivo_dev;
    }

    /**
     * Set the value of exclusivo_dev
     *
     * @return  self
     */
    public function setExclusivo_dev($exclusivo_dev)
    {
        $this->exclusivo_dev = $exclusivo_dev;
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
     * Get the value of tipo
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        return $this;
    }

    /**
     * Get the value of id_modulo_padre
     */
    public function getId_modulo_padre()
    {
        return $this->id_modulo_padre;
    }

    /**
     * Set the value of id_modulo_padre
     *
     * @return  self
     */
    public function setId_modulo_padre($id_modulo_padre)
    {
        $this->id_modulo_padre = $id_modulo_padre;
        return $this;
    }
}

?>
