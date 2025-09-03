<?php 
    class Catalogo extends Controllers{
        public function __construct() {
            parent::__construct();
            session_start();
          
        }
            
        //Visualizacion
        public function Catalogo(){

            
            
            $data['page_tag'] = "Usuarios";
            $data['page_title']= "Pagina Principal";
            $data['page_name'] = "usuarios";
            $data['page_js'] = "functioncatalogo.js";
    
            $this->views->getview($this,"catalogo",$data);
            
        }

        //Visualizacion
        public function getcursos(){
            $arrdata= $this->model->selectcursos();
        
            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getcategorias(){
            $arrdata= $this->model->selectcateorias();
        
            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getplataformas(){
            $arrdata= $this->model->selectplataformas();
        
            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function asingclases($idcurso){
            $_SESSION['idcursocontent']=$idcurso;
            
         }

    }
