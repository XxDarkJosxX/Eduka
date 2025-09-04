<?php 
//Moises
    class RegistrosModel extends Mysql{
        //Nivel de accesos
        private $intidusuario;
        private $intidrol;
 
        private $strnombre;
        private $strapellido;
        private $strcorreo;
        private $intestado;
        private $inttelefono;
      
        private $strpassword;
        private $intsuscripcion;
        private $strtoken;

        public function __construct() {

            parent::__construct();
        }
        public function insertregistro(int $idrol, string $nombre, string $apellido, string $email, string $suscripcion ,string $password, int $estado){
            $this->intidrol = $idrol;
			
			$this->strnombre = $nombre;
			$this->strapellido = $apellido;
            $this->strcorreo = $email;
            $this->intsuscripcion = $suscripcion;
            $this->strpassword = $password;
			$this->intestado = $estado;
            
			$return = 0;

			$sql = "SELECT * FROM tusuarios 
                    WHERE correo = '{$this->strcorreo}'";
			$request = $this->selectall($sql);

			if(empty($request))
			{
				$query  = "INSERT INTO tusuarios(idroles,nombre, apellidos,correo, suscripcion, password ,estado) 
								  VALUES(?,?,?,?,?,?,?)";
	        	$arrdata = array($this->intidrol,
        						 
        						$this->strnombre,
                                $this->strapellido,
        						$this->strcorreo,
                                $this->intsuscripcion,
                                $this->strpassword,
                                $this->intestado,
                            );
	        	$request = $this->insert($query,$arrdata);
	        	$return = $request;
			}else{
                $return=-1; 
            }
            
            return $return;
        }


        public function insertregistrogoogle(int $idrol, string $nombre, string $apellido, string $email, string $suscripcion , int $estado){
            $this->intidrol = $idrol;
			
			$this->strnombre = $nombre;
			$this->strapellido = $apellido;
            $this->strcorreo = $email;
            $this->intsuscripcion = $suscripcion;
      
			$this->intestado = $estado;
            
			$return = 0;

			$sql = "SELECT * FROM tusuarios 
                    WHERE correo = '{$this->strcorreo}'";
			$request = $this->selectall($sql);

			if(empty($request))
			{
				$query  = "INSERT INTO tusuarios(idroles,nombre, apellidos,correo, suscripcion,estado) 
								  VALUES(?,?,?,?,?,?)";
	        	$arrdata = array($this->intidrol,
        						 
        						$this->strnombre,
                                $this->strapellido,
        						$this->strcorreo,
                                $this->intsuscripcion,
                                $this->intestado,
                            );
	        	$request = $this->insert($query,$arrdata);
	        	$return = $request;
			}else{
                $return=-1; 
            }
            
            return $return;
        }
 

        public function settokenuser(int $iduser, string $token){
            $this->intidusuario = $iduser;
            $this->strtoken= $token;
            $queryupdate="UPDATE tusuarios SET token = ? WHERE idusuario =$this->intidusuario";
            $arrdata = array($this->strtoken);
            $requestupdate= $this->update($queryupdate,$arrdata);
            return $requestupdate;
                
        }
    }

?>