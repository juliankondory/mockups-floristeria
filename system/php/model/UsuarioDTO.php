<?php 

    class UsuarioDTO {

        protected $id_usuario;
        protected $nombre;
        protected $cedula;
        protected $correo;
        protected $telefono;
        protected $pass;
        protected $estado;
        protected $tipo;
        protected $fecha_registro;




        public function __construct(){
         
        }
            
        
        /**
         * Get the value of id_usuario
         */ 
        public function getId_usuario()
        {
                return $this->id_usuario;
        }

        /**
         * Set the value of id_usuario
         *
         * @return  self
         */ 
        public function setId_usuario($id_usuario)
        {
                $this->id_usuario = $id_usuario;

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
         * Get the value of cedula
         */ 
        public function getCedula()
        {
                return $this->cedula;
        }

        /**
         * Set the value of cedula
         *
         * @return  self
         */ 
        public function setCedula($cedula)
        {
                $this->cedula = $cedula;

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
         * Get the value of pass
         */ 
        public function getPass()
        {
                return $this->pass;
        }

        /**
         * Set the value of pass
         *
         * @return  self
         */ 
        public function setPass($pass)
        {
                $this->pass = $pass;

                return $this;
        }

        /**
         * Get the value of estado
         */ 
        public function getEstado()
        {
                if($this->estado==1) return explode(";", $this->estado.';Activo') ;
                if($this->estado==0) return explode(";", $this->estado.';Inactivo') ;

                return $this->estado;
        }

        /**
         * Set the value of estado
         *
         * @return  self
         */ 
        public function setEstado($estado)
        {
                $this->estado = $estado;

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