<?php 

    class PermisosModel extends Mysql{

        public $intidpermiso;
        public $intidrol;
        public $intidmodulo;
        public $rv;
        public $wv;
        public $uv;
        public $dv;
        public function __construct() {

            parent::__construct();
        }
        
        public function selectmodulos(){
            $sql= "SELECT * FROM tmodulos WHERE estado != 0";
            $request=$this->selectall($sql);
            return $request;
        }

        public function selectpermisos(int $idrol){
            $this->intidrol=$idrol;
            $sql= "SELECT * FROM tpermisos WHERE idrol = $this->intidrol";
            $request=$this->selectall($sql);
            return $request;
        }

        public function insertPermisos(int $idmodulo, int $idrol, $r,$w,$u,$d){
            
        
            $this->intidrol=$idrol;
            $this->intidmodulo=$idmodulo;
            $this->rv=$r;
            $this->wv=$w;
            $this->uv=$u;
            $this->dv=$d;

          
                $queryinsert="INSERT INTO tpermisos(idmodulo,idrol,r,w,u,d) VALUES (?,?,?,?,?,?)";
                $arrdata = array($this->intidmodulo,$this->intidrol,$this->rv,$this->wv,$this->uv,$this->dv);
                $requestinsert= $this->insert($queryinsert,$arrdata);
                $return = $requestinsert;
          
            return $return;

        }


        public function deletepermisos(int $idrol){
            
            $this->intidrol=$idrol;
    

            $querydelete="DELETE FROM tpermisos WHERE idrol = $this->intidrol";
            $request=$this->delete($querydelete);
            return $request;

        }

        public function selectrol(int $idrol){
            $this->intidrol= $idrol;
            $sql="SELECT * FROM troles WHERE idroles = $this->intidrol";
            $request=$this->select($sql);
            return $request;
        }

        public function permisosmodulo(int $idrol){
            $this->intidrol= $idrol;
            $sql= "SELECT tp.idrol, tp.idmodulo, tm.nombre, tp.r, tp.w, tp.u, tp.d
            FROM tpermisos tp
            INNER JOIN tmodulos tm
            ON tp.idmodulo = tm.idmodulo
            WHERE tp.idrol = $this->intidrol";
            $request=$this->selectall($sql);
            $arrpermisos = array();
            
            for ($i=0; $i < count($request); $i++) { 
                $arrpermisos[$request[$i]['idmodulo']]=$request[$i];
            }
            return $arrpermisos;

        }

    }

?>