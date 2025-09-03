<?php 
    class Contenido extends Controllers{
        public function __construct() {
            parent::__construct();
            session_start();
      
            if(empty($_SESSION['login'])){
                header('Location: '.base_url()."/login");
            }
        }
            
        //Visualizacion
        public function Contenido(){

       
            $data['page_tag'] = "Usuarios";
            $data['page_title']= "Pagina Principal";
            $data['page_name'] = "usuarios";
            $data['page_js'] = "functioncontenido.js";
    
            $this->views->getview($this,"contenido",$data);
            
        }


        public function getclases(){
            $idcurso = $_SESSION['idcursocontent'];

            $intkey=intval($_SESSION['iduser']);
            
            $arrdatauser = $this->model->selectusuario($intkey);

            $arrdata= $this->model->selectclases($idcurso);

            for($i=0;$i< count($arrdata);$i++){
                if($i == 0){
                    $arrdata[$i]['iconp']='<span class="icon-holder icon-holder--small icon-holder--dark rounded-circle d-inline-flex icon--left">
                    <i class="material-icons icon-16pt">check_circle</i>
                </span>';
                }else{
                    if($arrdata[$i]['privacidad'] == 1 || $arrdatauser['suscripcion'] == 1){
                        $arrdata[$i]['iconp']='  <span class="icon-holder icon-holder--small icon-holder--primary rounded-circle d-inline-flex icon--left">
                        <i class="material-icons icon-16pt">play_circle_outline</i>
                        </span>';
                    }else{
                        $arrdata[$i]['iconp']='<span class="icon-holder icon-holder--small icon-holder--light rounded-circle d-inline-flex icon--left">
                        <i class="material-icons icon-16pt">lock</i>
                    </span>';
                    }
                }
            }
            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }
   

        public function getusuario(){
            
            $intkey=intval($_SESSION['iduser']);

            if ($intkey>0){
                $arrdata = $this->model->selectusuario($intkey);
             
                echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
        
        public function asingclases($idclase){
            $_SESSION['idclasev']=$idclase;
            
        }


        public function getcurso(){
            
            $intkey=intval($_SESSION['idcursocontent']);

            if ($intkey>0){
                $arrdata = $this->model->selectcurso($intkey);
             
                echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
 

    }
