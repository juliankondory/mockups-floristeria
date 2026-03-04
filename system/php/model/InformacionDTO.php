<?php
class InformacionDTO
{
    protected $id_perfil;
    protected $nombre;
    protected $direccion;
    protected $correo;
    protected $telefono;
    protected $departamento;
    protected $ciudad;
    protected $nit;
    protected $wp;
    protected $fb;
    protected $instagram;
    protected $imagen;
    protected $color1;

    public function __construct(){
        
    }

    /**
     * Get the value of id_perfil
     */ 
    public function getId_perfil()
    {
        return $this->id_perfil;
    }

    /**
     * Set the value of id_perfil
     *
     * @return  self
     */ 
    public function setId_perfil($id_perfil)
    {
        $this->id_perfil = $id_perfil;

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
     * Get the value of direccion
     */ 
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */ 
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get the value of correo
     */ 
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set the value of correo
     *
     * @return  self
     */ 
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get the value of telefono
     */ 
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */ 
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get the value of departamento
     */ 
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Set the value of departamento
     *
     * @return  self
     */ 
    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;

        return $this;
    }

    /**
     * Get the value of ciudad
     */ 
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set the value of ciudad
     *
     * @return  self
     */ 
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get the value of nit
     */ 
    public function getNit()
    {
        return $this->nit;
    }

    /**
     * Set the value of nit
     *
     * @return  self
     */ 
    public function setNit($nit)
    {
        $this->nit = $nit;

        return $this;
    }

    /**
     * Get the value of wp
     */ 
    public function getWp()
    {
        return $this->wp;
    }

    /**
     * Set the value of wp
     *
     * @return  self
     */ 
    public function setWp($wp)
    {
        $this->wp = $wp;

        return $this;
    }

    /**
     * Get the value of fb
     */ 
    public function getFb()
    {
        return $this->fb;
    }

    /**
     * Set the value of fb
     *
     * @return  self
     */ 
    public function setFb($fb)
    {
        $this->fb = $fb;

        return $this;
    }

    /**
     * Get the value of instagram
     */ 
    public function getInstagram()
    {
        return $this->instagram;
    }

    /**
     * Set the value of instagram
     *
     * @return  self
     */ 
    public function setInstagram($instagram)
    {
        $this->instagram = $instagram;

        return $this;
    }

    /**
     * Get the value of imagen
     */ 
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set the value of imagen
     *
     * @return  self
     */ 
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get the value of color1
     */ 
    public function getColor1()
    {
        return $this->color1;
    }

    /**
     * Set the value of color1
     *
     * @return  self
     */ 
    public function setColor1($color1)
    {
        $this->color1 = $color1;

        return $this;
    }
}
?>