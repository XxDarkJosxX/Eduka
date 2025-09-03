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
        public function insertplataforma(string $nombre, string $descripcion,  int $estado){
            $return = 0;
            $this->strnombre=$nombre;
            $this->strdescripcion=$descripcion;
            $this->intestado=$estado;

            $sql= "SELECT * FROM tplataforma WHERE nombre='{$this->strnombre}'";
            $requestinsert = $this->selectall($sql);
            if(empty($requestinsert)){
                $queryinsert="INSERT INTO tplataforma(nombre,descripcion,estado) VALUES (?,?,?)";
                $arrdata = array($this->strnombre,$this->strdescripcion,$this->intestado);
                $requestinsert= $this->insert($queryinsert,$arrdata);
                $return = $requestinsert;
            }else{
                $return=-1;
            }
            return $return;
        }
        //Update
        public function updateplataforma(int $idplatafor, string $nombre, string $descripcion, int $estado){
            
            $this->intidplatafo=$idplatafor;
            $this->strnombre=$nombre;
            $this->strdescripcion=$descripcion;
            $this->intestado=$estado;
            $sql= "SELECT * FROM tplataforma WHERE nombre='$this->strnombre' AND idplataforma != $this->intidplatafo";
            $requestupdate = $this->selectall($sql);
            
            if(empty($requestupdate)){
                $queryupdate="UPDATE tplataforma SET nombre=?,estado=? ,descripcion=?WHERE idplataforma=$this->intidplatafo";
                $arrdata = array($this->strnombre,$this->intestado,$this->strdescripcion);
                $requestupdate= $this->update($queryupdate,$arrdata);
                $return=$requestupdate;
            }else{
                $return=-1;
            }
            
            return $return;

        }

   
        //parte del delete
        public function selectplataforma(int $idplataforma){
            $this->intidplatafo= $idplataforma;
            $sql="SELECT * FROM tplataforma WHERE idplataforma = $this->intidplatafo";
            $request=$this->select($sql);
            return $request;
        }



   
        //Delete
        public function deleteplataforma(int $idplataforma){
            $this->intidplatafo=$idplataforma;

            //$sql= "SELECT * FROM tcursos WHERE idplataforma=$this->intidplatafo";

            //$requestdelete = $this->selectall($sql);
            
            //if(empty($requestdelete)){
                $querydelete="UPDATE tplataforma SET estado=? WHERE idplataforma = $this->intidplatafo";
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
            //    $return='existe';
            //}
            
            return $return;

        }


    }

?>