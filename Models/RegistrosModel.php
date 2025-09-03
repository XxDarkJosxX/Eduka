<?php 
//Moises
    class RegistrosModel extends Mysql{
        //Nivel de accesos
        private $intidusuario;
        private $intidrol;
        private $strci;
        private $strnombre;
        private $strapellido;
        private $strcorreo;
        private $intestado;
        private $inttelefono;
        private $intci;
        private $strpassword;
        private $intsuscripcion;
        private $strtoken;

        public function __construct() {

            parent::__construct();
        }
        public function insertregistro(int $idrol,string $ci, string $nombre, string $apellido, string $email, int $telefono, string $suscripcion ,string $password, int $estado){
            $this->intidrol = $idrol;
			$this->intci = $ci;
			$this->strnombre = $nombre;
			$this->strapellido = $apellido;
            $this->strcorreo = $email;
			$this->inttelefono = $telefono;
            $this->intsuscripcion = $suscripcion;
            $this->strpassword = $password;
			$this->intestado = $estado;
            
			$return = 0;

			$sql = "SELECT * FROM tusuarios 
                    WHERE correo = '{$this->strcorreo}' OR ci = '{$this->intci}'";
			$request = $this->selectall($sql);

			if(empty($request))
			{
				$query  = "INSERT INTO tusuarios(idroles,ci,nombre, apellidos,correo, telefono, suscripcion, password ,estado) 
								  VALUES(?,?,?,?,?,?,?,?,?)";
	        	$arrdata = array($this->intidrol,
        						$this->intci,
        						$this->strnombre,
                                $this->strapellido,
        						$this->strcorreo,
        						$this->inttelefono,
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