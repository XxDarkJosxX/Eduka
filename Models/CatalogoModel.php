<?php 
//Moises
    class CatalogoModel extends Mysql{
        //Nivel de accesos

        public function __construct() {

            parent::__construct();
        }
        public function selectcursos(){
            $sql= "SELECT tu.idusuario,tcat.idcategoria,tp.idplataforma, tu.nombre, tu.apellidos, tc.idcurso ,tc.privacidad , tc.titulo, tc.estado, tcat.nombre AS nombrecat, tc.portadaurl
            FROM tcursos tc 
            JOIN tusuarios tu ON tc.idusuario = tu.idusuario
            JOIN tplataforma tp ON tp.idplataforma = tc.idplataforma
            JOIN tcategoria tcat ON tcat.idcategoria = tc.idcategoria  
            WHERE tc.estado != 0";
            $request=$this->selectall($sql);
            return $request;
        }

        public function selectcateorias(){
            $sql= "SELECT idcategoria, nombre
            FROM  tcategoria";
            $request=$this->selectall($sql);
            return $request;
        }
       
        public function selectplataformas(){
            $sql= "SELECT idplataforma, nombre 
            FROM  tplataforma";
            $request=$this->selectall($sql);
            return $request;
        }

    }

?>