<?php 
//Moises
    class DcursosModel extends Mysql{
        //Nivel de accesos

        private $intidcurso;
        private $intidusuario;
        private $intidrol;
        private $strtitulo;
        private $strdescripcion;
        private $intcategoria;
        private $intplataforma;
        private $intprivacidad;
        private $intestado;
     
        private $strfilename;
        private $strfileurl;


        public function __construct() {

            parent::__construct();
        }
        //YO

        
        public function selectcursos(){
            $this->intidcurso = $_SESSION['idcurso'];
            $sql= "SELECT tu.idusuario, tu.nombre, tu.apellidos, tc.idcurso , tc.titulo, tc.estado, tcat.nombre AS nombrecat
            FROM tcursos tc 
            JOIN tusuarios tu ON tc.idusuario = tu.idusuario 
            JOIN tcategoria tcat ON tcat.idcategoria = tc.idcategoria  
            WHERE tc.estado != 0  ";
            $request=$this->selectall($sql);
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


        public function insertcurso(int $idautor, int $idprivacidad, int $idcategoria,int $idplataforma,string $titulo, string $descripcion,  int $estado){
            $this->intidusuario = $idautor;
            $this->intcategoria = $idcategoria;
            $this->intplataforma = $idplataforma;
            $this->intprivacidad = $idprivacidad;
			$this->strtitulo = $titulo;
			$this->strdescripcion = $descripcion;
          
            $this->intestado = $estado;
		
			$return = 0;

			$sql = "SELECT titulo FROM tcursos 
                    WHERE titulo = '{$this->strtitulo}'";

			$request = $this->selectall($sql);

			if(empty($request))
			{
				$query  = "INSERT INTO tcursos(idusuario,privacidad,idcategoria,idplataforma ,titulo,descripcion,estado) 
								  VALUES(?,?,?,?,?,?,?)";
	        	$arrdata = array($this->intidusuario,
                                $this->intprivacidad,
                                $this->intcategoria,
                                $this->intplataforma,
                                $this->strtitulo,
        						$this->strdescripcion,
                                $this->intestado,
                            );
	        	$request = $this->insert($query,$arrdata);
	        	$return = $request;
			}else{
                $return=-1; 
            }
            
            return $return;
        }

        //Visualizacion Especial
        public function selectcategorias(){
          
            $sql="SELECT * FROM tcategoria WHERE estado != 0";
            $request=$this->selectall($sql);
            return $request;
        }
        //Visualizacion Especial
        public function selectplataformas(){
            
            $sql="SELECT * FROM tplataforma WHERE estado != 0";
            $request=$this->selectall($sql);
            return $request;
        }
        
        //Update
        public function updatecurso(int $idcurso,int $idprivacidad ,int $idcategoria,int $idplataforma, string $titulo, string $descripcion, int $estado){
            
            $this->intidcurso = $idcurso;
            $this->intcategoria = $idcategoria;
            $this->intplataforma = $idplataforma;
            $this->intprivacidad = $idprivacidad;
			$this->strtitulo = $titulo;
			$this->strdescripcion = $descripcion;
           
            $this->intestado = $estado;

            $sql = "SELECT titulo FROM tcursos 
                    WHERE titulo = '{$this->strtitulo}' AND idcurso != $this->intidcurso";

            $requestupdate = $this->selectall($sql);
            
            if(empty($requestupdate)){
                $queryupdate="UPDATE tcursos SET privacidad=?, idcategoria = ?, idplataforma=?, titulo=?, descripcion=? , estado = ? WHERE idcurso=$this->intidcurso";
                $arrdata = array($this->intprivacidad,$this->intcategoria, $this->intplataforma ,$this->strtitulo,$this->strdescripcion,$this->intestado);
                $requestupdate= $this->update($queryupdate,$arrdata);
                $return=$requestupdate;
            }else{
                $return=-1;
            }
            
            return $return;

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


        public function insertfile(int $idcurso,string $filename ,string $fileurl){
            $this->intidcurso = $idcurso;

            $this->strfilename = $filename;
            $this->strfileurl = $fileurl;

            $queryupdate="UPDATE tcursos SET portadaname = ?, portadaurl=?  WHERE idcurso = $this->intidcurso";

            $arrdata = array($this->strfilename,$this->strfileurl);
            $requestupdate= $this->update($queryupdate,$arrdata);
            $return=$requestupdate;
        }

    }

?>