<?php 
//Moises
    class PlataformasModel extends Mysql{
        //Nivel de accesos
        private $intidplatafo;
        private $strnombre;
        private $strdescripcion;
        private $intestado;


        public function __construct() {

            parent::__construct();
        }
        //Visualizacion
        public function selecplataformas(){
          
            $sql="SELECT * FROM tplataforma";
            $request=$this->selectall($sql);
            return $request;
        }
   

        //Insert
        public function insertrol(string $tipo, string $descripcion,  int $estado){
            $return = 0;
            $this->strtipo=$tipo;
            $this->strdescripcion=$descripcion;
            $this->intestado=$estado;

            $sql= "SELECT * FROM troles WHERE tipo='{$this->strtipo}'";
            $requestinsert = $this->selectall($sql);
            if(empty($requestinsert)){
                $queryinsert="INSERT INTO troles(tipo,descripcion,estado) VALUES (?,?,?)";
                $arrdata = array($this->strtipo,$this->strdescripcion,$this->intestado);
                $requestinsert= $this->insert($queryinsert,$arrdata);
                $return = $requestinsert;
            }else{
                $return=-1;
            }
            return $return;
        }
        //Update
        public function updaterol(int $idrol, string $tipo, string $descripcion, int $estado){
            
            $this->intidrol=$idrol;
            $this->strtipo=$tipo;
            $this->strdescripcion=$descripcion;
            $this->intestado=$estado;
            $sql= "SELECT * FROM troles WHERE tipo='$this->strtipo' AND idroles != $this->intidrol";
            $requestupdate = $this->selectall($sql);
            
            if(empty($requestupdate)){
                $queryupdate="UPDATE troles SET tipo=?,estado=? ,descripcion=?WHERE idroles=$this->intidrol";
                $arrdata = array($this->strtipo,$this->intestado,$this->strdescripcion);
                $requestupdate= $this->update($queryupdate,$arrdata);
                $return=$requestupdate;
            }else{
                $return=-1;
            }
            
            return $return;

        }

   
     
        //parte del delete
        public function selectrol(int $idrol){
            $this->intidrol= $idrol;
            $sql="SELECT * FROM troles WHERE idroles = $this->intidrol";
            $request=$this->select($sql);
            return $request;
        }



   
        //Delete
        public function deleterol(int $idrol){
            
            $this->intidrol=$idrol;
    

            $sql= "SELECT * FROM tusuarios WHERE idroles=$this->intidrol";
            $requestdelete = $this->selectall($sql);
            
            if(empty($requestdelete)){
                $querydelete="UPDATE troles SET estado=? WHERE idroles = $this->intidrol";
                $arrdata = array(0);
                $requestdelete= $this->update($querydelete,$arrdata);
                if($requestdelete){
                    $requestdelete='ok';
                    $return=$requestdelete;
                }else{
                    $request='error';
                    $return=$request;
                }
            }else{
                $return='existe';
            }
            
            return $return;

        }


    }

?>