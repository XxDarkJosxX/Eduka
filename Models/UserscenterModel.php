<?php 
//Moises
    class UserscenterModel extends Mysql{
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
        //YO
        public function selectusuarios(){
            $sql= "SELECT tu.idusuario, tu.idroles, tu.nombre, tu.apellidos, tu.correo, tu.telefono,tu.password,tu.suscripcion, tu.estado, tr.tipo 
            FROM tusuarios tu 
            JOIN troles tr ON tu.idroles = tr.idroles 
           WHERE tu.estado = 1 OR tu.estado = 0";
            $request=$this->selectall($sql);
            return $request;
        }

        public function selectusuario(int $iduser){
            $this->intidusuario= $iduser;
            $sql= "SELECT tu.idusuario, tu.idroles, tu.nombre, tu.apellidos, tu.telefono, tu.correo, tu.estado,tu.suscripcion, tr.tipo
            FROM tusuarios tu
            JOIN troles tr ON tu.idroles = tr.idroles
            WHERE tu.idusuario = $this->intidusuario";
            $request=$this->select($sql);
            return $request;
        }


        public function insertusuario(int $idrol, string $nombre, string $apellido, string $email, int $telefono, string $password, int $suscripcion, int $estado){
            $this->intidrol = $idrol;
	
			$this->strnombre = $nombre;
			$this->strapellido = $apellido;
			$this->strcorreo = $email;
			$this->inttelefono = $telefono;
            $this->strpassword = $password;
            $this->intsuscripcion = $suscripcion;
			$this->intestado = $estado;
            
			$return = 0;

			$sql = "SELECT * FROM tusuarios 
                    WHERE correo = '{$this->strcorreo}' ";
			$request = $this->selectall($sql);

			if(empty($request))
			{
				$query  = "INSERT INTO tusuarios(idroles,nombre,apellidos,telefono,correo,password,suscripcion,estado) 
								  VALUES(?,?,?,?,?,?,?,?,?)";
	        	$arrdata = array($this->intidrol,
        						
        						$this->strnombre,
                                $this->strapellido,
        						$this->inttelefono,
        						$this->strcorreo,
                                $this->strpassword,
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
        //Update
        public function updateusuario(int $idusuario, int $rol, string $nombre, string $apellido, string $correo,int $telefono, int $suscripcion, int $estado){
			
            $this->intidusuario = $idusuario;
            $this->intidrol     = $rol;
			
			$this->strnombre    = $nombre;
			$this->strapellido  = $apellido;
			$this->strcorreo    = $correo;
			$this->inttelefono  = $telefono;
            $this->intsuscripcion = $suscripcion;
            $this->intestado     = $estado;
            

            $sql= "SELECT * FROM tusuarios WHERE nombre='{$this->strnombre}' AND apellidos='{$this->strapellido}' AND idusuario != $this->intidusuario";
            $requestupdate = $this->selectall($sql);
            
            if(empty($requestupdate)){

                    $queryupdate="UPDATE tusuarios SET idroles=?,  nombre=?, apellidos=?, correo=? ,telefono=?, suscripcion=? ,estado=? WHERE idusuario=$this->intidusuario";
                    $arrdata = array(
                                $this->intidrol,
        						
        						$this->strnombre,
                                $this->strapellido,
        						$this->strcorreo,
        						$this->inttelefono,
                                $this->intsuscripcion,
                                $this->intestado
                                //Cuidao al borrar
                    );
                $requestupdate= $this->update($queryupdate,$arrdata);
                $return=$requestupdate;
                
            }else{
                $return=-1;
            }
            
            return $return;

        }
        //Pate del Update
    
        //Especial
        public function selectroles(){
          
            $sql="SELECT * FROM troles WHERE estado != 0";
            $request=$this->selectall($sql);
            return $request;
        }





        public function settokenuser(int $iduser, string $token){
            $this->intidusuario = $iduser;
            $this->strtoken= $token;
            $queryupdate="UPDATE tusuarios SET token = ? WHERE idusuario =$this->intidusuario";
            $arrdata = array($this->strtoken);
            $requestupdate= $this->update($queryupdate,$arrdata);
            return $requestupdate;
                
        }
        //Delete
      


    }

?>