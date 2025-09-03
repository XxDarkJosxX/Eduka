<?php 
//Moises
    class CategoriasModel extends Mysql{
        //Nivel de accesos
        private $intcategorias;
        private $strnombre;
        private $strdescripcion;
        private $intestado;

        public function __construct() {

            parent::__construct();
        }
        //YO
        public function seleccategorias(){
            $sql= "SELECT tc.idcategoria, tc.nombre, tc.descripcion, tc.estado
            FROM tcategoria tc 
            WHERE tc.estado != 0";
            $request=$this->selectall($sql);
            return $request;
        }

        public function selectcategoria(int $iduser){
            $this->intcategorias= $iduser;
            $sql= "SELECT tc.idcategoria, tc.nombre, tc.descripcion, tc.estado
            FROM tcategoria tc
            WHERE tc.idcategoria = $this->intcategorias";
            $request=$this->select($sql);
            return $request;
        }


        public function insertcategorias(string $nombre, string $descripcion, int $estado){
			$this->strnombre = $nombre;
			$this->strdescripcion = $descripcion;
			$this->intestado = $estado;
            
			$return = 0;

			$sql = "SELECT * FROM tcategoria
                    WHERE nombre = '{$this->strnombre}'";
			$request = $this->selectall($sql);

			if(empty($request))
			{
				$query  = "INSERT INTO tcategoria(nombre, descripcion, estado) 
								  VALUES(?,?,?)";
	        	$arrdata = array($this->strnombre,
                                $this->strdescripcion,
                                $this->intestado
                            );
	        	$request = $this->insert($query,$arrdata);
	        	$return = $request;
			}else{
                $return=-1; 
            }
            
            return $return;
        }
        //Update
        public function updatecategorias(int $idcategorias,string $nombre, string $descripcion, int $estado){
			
            $this->intcategorias = $idcategorias;
			$this->strnombre    = $nombre;
			$this->strdescripcion  = $descripcion;
            $this->intestado     = $estado;
            

            $sql= "SELECT * FROM tcategoria WHERE nombre='$this->strnombre' AND idcategoria != $this->intcategorias";
            $requestupdate = $this->selectall($sql);
            
            if(empty($requestupdate)){

                    $queryupdate="UPDATE tcategoria SET nombre=?, descripcion=?,estado=? WHERE idcategoria =$this->intcategorias";
                    $arrdata = array(
                        $this->strnombre,
                        $this->strdescripcion,
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
   
  
        //Delete
      
   //Delete
   public function deletecategoria(int $idcategoria){
            
    $this->intcategorias=$idcategoria;


  //  $sql= "SELECT * FROM tcategoria WHERE idcategoria=$this->intcategorias";
//$requestdelete = $this->selectall($sql);
    
    //if(empty($requestdelete)){
        $querydelete="UPDATE tcategoria SET estado=? WHERE idcategoria = $this->intcategorias";
        $arrdata = array(0);
        $requestdelete= $this->update($querydelete,$arrdata);
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