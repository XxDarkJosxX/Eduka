<?php 
//Moises
    class ClasesModel extends Mysql{
        //Nivel de accesos

        private $intidcurso;
        
        private $intidclase;
        private $intidprivacidad;
        private $strenlace;
        private $strtitulo;
        private $strdescripcion;

        private $intestado;

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


        public function insertclase(int $idcurso,string $titulo, string $descripcion, string $enlace,int $privacidad,int $estado){
 
            $this->intidcurso = $idcurso;
			$this->strtitulo = $titulo;
			$this->strdescripcion = $descripcion;
            $this->strenlace = $enlace;
            $this->intidprivacidad = $privacidad;
            $this->intestado = $estado;

        
			$return = 0;

			$sql = "SELECT titulo FROM tclases
                    WHERE titulo = '$this->strtitulo' AND idcurso = $this->intidcurso";

			$request = $this->selectall($sql);

			if(empty($request))
			{
                

				$query  = "INSERT INTO tclases(idcurso,titulo,descripcion,enlace,privacidad,estado) 
								  VALUES(?,?,?,?,?,?)";
	        	$arrdata = array($this->intidcurso,
        						$this->strtitulo,
        						$this->strdescripcion,
                                $this->strenlace,
                                $this->intidprivacidad,
                                $this->intestado);
	        	$request = $this->insert($query,$arrdata);
	        	$return = $request;
			}else{
                $return=-1; 
            }
            
            return $return;
        }

        //Update
        public function updateclase(int $idclase,int $idcurso,string $titulo, string $descripcion, string $enlace,int $privacidad,int $estado){
            
            $this->intidclase = $idclase;
            $this->intidcurso = $idcurso;
			$this->strtitulo = $titulo;
			$this->strdescripcion = $descripcion;
            $this->strenlace = $enlace;
            $this->intidprivacidad = $privacidad;
            $this->intestado = $estado;


            $sql = "SELECT titulo FROM tclases 
                    WHERE titulo = '$this->strtitulo' AND idclases != $this->intidclase AND idcurso = $this->intidcurso";

            $requestupdate = $this->selectall($sql);
            
            if(empty($requestupdate)){
                $queryupdate="UPDATE tclases SET titulo=?,enlace=? ,privacidad = ?,descripcion = ?, estado = ? WHERE idclases =$this->intidclase";

                $arrdata = array($this->strtitulo,$this->strenlace,$this->intidprivacidad,$this->strdescripcion,$this->intestado);
                $requestupdate= $this->update($queryupdate,$arrdata);
                $return=$requestupdate;
            }else{
                $return=-1;
            }
            
            return $return;

        }

        public function insertfile(int $idclase,string $filename ,string $fileurl){
            $this->intidclase = $idclase;
            $this->strfilename = $filename;
            $this->strfileurl = $fileurl;
            $queryupdate="UPDATE tclases SET archivos = ?,archivourl=?  WHERE idclases = $this->intidclase";

            $arrdata = array($this->strfilename,$this->strfileurl);
            $requestupdate= $this->update($queryupdate,$arrdata);
            $return=$requestupdate;
        }

        
        public function deletecurso(int $idcurso){
            
            $this->intidcurso=$idcurso;
    

            $sql= "SELECT idcurso  FROM tlecciones WHERE idcurso =$this->intidcurso";
            $requestdelete = $this->selectall($sql);
            
            if(empty($requestdelete)){
                $querydelete="UPDATE tcursos SET estado=? WHERE idcurso  = $this->intidcurso";
                $arrdata = array(0);
                $requestdelete= $this->update($querydelete,$arrdata);

                //$querydelete="DELETE FROM rol  WHERE idrol = $this->intidrol";
                //$arrdata = array(0);
                //$requestdelete= $this->delete($querydelete,$arrdata);

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