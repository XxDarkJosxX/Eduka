<?php 

    class LoginModel extends Mysql{

        public $intiduser;
        public $stremail;
        public $struser;
        public $strpassword;
        public $strtoken;

        public function __construct() {

            parent::__construct();
        }


        public function loginuser(string $user, string $password){
            $this->struser=$user;
            $this->strpassword=$password;
            $sql= "SELECT idusuario , estado FROM tusuarios WHERE correo='$this->struser'  AND password= '$this->strpassword' AND estado != 0";
            $request=$this->select($sql);
            return $request;
        }
        public function sessionlogin(int $iduser){
            $this->intiduser=$iduser;
         
            $sql= "SELECT tu.idusuario , tu.idroles , tr.tipo, tu.nombre, tu.apellidos, tu.correo, tu.telefono, tu.estado
            FROM tusuarios tu
            INNER JOIN troles tr
            ON tu.idroles  = tr.idroles 
            WHERE tu.idusuario = $this->intiduser";
            $request=$this->select($sql);
            $_SESSION['userdata']= $request;
            return $request;
        }

        public function getuseremail(string $email){
            $this->struser=$email;
         
            $sql= "SELECT idusuario , nombre, apellidos, estado FROM tusuarios WHERE correo='$this->struser' AND estado = 1";
            $request=$this->select($sql);
            return $request;
        }

        public function settokenuser(int $iduser, string $tokrn){
            $this->intiduser = $iduser;
            $this->strtoken= $tokrn;
            $queryupdate="UPDATE tusuarios SET token = ? WHERE idusuario =$this->intiduser";
            $arrdata = array($this->strtoken);
            $requestupdate= $this->update($queryupdate,$arrdata);
            return $requestupdate;
                
        }

        public function getuser(string $email, string $token){
            $this->struser=$email;
            $this->strtoken= $token;
            $sql= "SELECT idusuario  FROM tusuarios WHERE correo='$this->struser' AND token= '$this->strtoken' AND estado = 1";
            $request=$this->select($sql);
            return $request;
            

        }


        public function insertpassword(int $iduser, string $password){
            $this->intiduser = $iduser;
            $this->strpassword= $password;
            $queryupdate="UPDATE tusuarios SET password = ?, token = ? WHERE idusuario = $this->intiduser";
            $arrdata = array($this->strpassword,"");
            $requestupdate= $this->update($queryupdate,$arrdata);
            return $requestupdate;

        }
        
    }

?>