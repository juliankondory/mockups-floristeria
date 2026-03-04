<?php

class RoleViewPermissionDTO
{
    protected $id_rol_vista_permiso;
    protected $id_rol;
    protected $id_vista;
    protected $id_permiso;
    protected $fecha_asignacion;
    protected $asignado_por;

    public function __construct()
    {
    }

    /**
     * Get the value of id_rol_vista_permiso
     */
    public function getId_rol_vista_permiso()
    {
        return $this->id_rol_vista_permiso;
    }

    /**
     * Set the value of id_rol_vista_permiso
     *
     * @return  self
     */
    public function setId_rol_vista_permiso($id_rol_vista_permiso)
    {
        $this->id_rol_vista_permiso = $id_rol_vista_permiso;
        return $this;
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
     * Get the value of fecha_asignacion
     */
    public function getFecha_asignacion()
    {
        return $this->fecha_asignacion;
    }

    /**
     * Set the value of fecha_asignacion
     *
     * @return  self
     */
    public function setFecha_asignacion($fecha_asignacion)
    {
        $this->fecha_asignacion = $fecha_asignacion;
        return $this;
    }

    /**
     * Get the value of asignado_por
     */
    public function getAsignado_por()
    {
        return $this->asignado_por;
    }

    /**
     * Set the value of asignado_por
     *
     * @return  self
     */
    public function setAsignado_por($asignado_por)
    {
        $this->asignado_por = $asignado_por;
        return $this;
    }
}

?>
