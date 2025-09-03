<?php 
//Moises
    class ContenidoModel extends Mysql{
        //Nivel de accesos

        private $intidcurso;
        
        private $intidclase;
        private $intidprivacidad;
        private $strenlace;
        private $strtitulo;
        private $strdescripcion;

        private $intidusuario;

        private $strfilename;
        private $strfileurl;
     

        public function __construct() {

            parent::__construct();
        }
        //YO
        public function selectclases(int $idcurso){
            $this->intidcurso= $idcurso;
            $sql= "SELECT tcl.idclases , tc.idcurso, tc.titulo AS titcurso, tcl.titulo AS titclase, tcl.estado, tcl.privacidad
            FROM tclases tcl 
            JOIN tcursos tc ON tc.idcurso  = tcl.idcurso  
            WHERE tcl.estado != 0 AND tcl.idcurso =  $this->intidcurso";
            $request=$this->selectall($sql);
            return $request;
        }

        public function selectclase(int $idclase){
            $this->intidclase= $idclase;

            $sql= "SELECT tcl.idclases ,tcl.enlace,tcl.privacidad  ,tcl.archivos,tcl.archivourl, tcl.descripcion ,tc.idcurso, tc.titulo AS titcurso, tcl.titulo AS titclase, tcl.estado
            FROM tclases tcl 
            JOIN tcursos tc ON tc.idcurso  = tcl.idcurso  
            WHERE tcl.estado != 0 AND tcl.idclases =  $this->intidclase";

            $request=$this->select($sql);
            return $request;
        }



        public function selectusuario(int $iduser){
            $this->intidusuario= $iduser;
            $sql= "SELECT suscripcion
            FROM tusuarios 
            WHERE idusuario = $this->intidusuario";
            $request=$this->select($sql);
            return $request;
        }

        public function selectcurso(int $idcurso){
            $this->intidcurso= $idcurso;

            $sql= "SELECT tu.idusuario, tu.nombre, tu.apellidos, tc.idcurso , tc.descripcion, tc.titulo, tc.estado, tcat.nombre AS nombrecat, tcat.idcategoria, tc.portadaurl, tc.portadaname
            FROM tcursos tc
            JOIN tusuarios tu ON tc.idusuario = tu.idusuario 
            JOIN tcategoria tcat ON tcat.idcategoria = tc.idcategoria  
            WHERE tc.estado != 0 AND tc.idcurso = $this->intidcurso";

            $request=$this->select($sql);
            return $request;
        }

    }

?>