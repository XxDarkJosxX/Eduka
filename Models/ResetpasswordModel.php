<?php 
//Moises
    class ResetpasswordModel extends Mysql{
        //Nivel de accesos
    
        public $intiduser;
        public $stremail;
        public $struser;
        public $strpassword;
        public $strtoken;

        public function __construct() {

            parent::__construct();
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
       
      
    }

?>