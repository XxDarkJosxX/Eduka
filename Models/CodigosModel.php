<?php 
//Moises
    class CodigosModel extends Mysql{
        //Nivel de accesos
        private $intcodigo;
        private $strnombre;

        public function __construct() {

            parent::__construct();
        }
        //YO
        public function selectcodigos(){
            $sql= "SELECT tc.idcodigo, tc.codigo
            FROM tcodigos tc";
            $request=$this->selectall($sql);
            return $request;
        }

   


        public function inserttokens(string $token){
			$this->strnombre = $token;
        
		
				$query  = "INSERT INTO tcodigos(codigo) 
								  VALUES(?)";
	        	$arrdata = array($this->strnombre
                            );
	        	$request = $this->insert($query,$arrdata);
	        	$return = $request;
            return $return;
        }
   
   
  
        //Delete
      
   //Delete
   public function deletetoken(int $idcodigo){
            
    $this->intcodigo=$idcodigo;

        $querydelete="DELETE FROM tcodigos WHERE idcodigo = $this->intcodigo";
        $requestdelete= $this->delete($querydelete);
        if($requestdelete){
            $requestdelete='ok';
            $return=$requestdelete;
        }else{
            $request='error';
            $return=$request;
        }
    //}else{
      //  $return='existe';
  //  }
    
    return $return;

}

    }

?>