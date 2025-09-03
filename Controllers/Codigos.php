<?php 
    class Codigos extends Controllers{
        public function __construct() {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url()."/login");
            }
            getpermisos(8);
        }
        
        //Visualizacion
        public function Codigos(){
            if(empty($_SESSION['permisosmod']['r'])){
                header('Location: '.base_url()."/dashboard");
            }
            $data['page_tag'] = "Codigos";
            $data['page_title']= "Pagina Principal";
            $data['page_name'] = "Codigos";
            $data['page_js'] = "functioncodigos.js";
            $this->views->getview($this,"codigos",$data);
        }
        
        //Visualizacion
        public function getcodigos(){
            $arrdata= $this->model->selectcodigos();
            $crudopciones="";
            
            for($i=0;$i< count($arrdata);$i++){

                $crudopciones='<div class="dropdown">
                <a  data-toggle="dropdown" data-caret="false" class="text-muted" aria-expanded="false"><i class="material-icons">more_horiz</i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                       
                        <div class="dropdown-divider"></div>
                        <a  class="dropdown-item text-danger btndeltoken" rl="'.$arrdata[$i]['idcodigo'].'">Eliminar</a>
                    </div>
                </div>
                ';
             
                $arrdata[$i]['acciones']= '<div class="text-center">'.$crudopciones.'</div>';
            }
            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }


        public function setinsert(){
            $generadoToken = token();
            $this->model->inserttokens($generadoToken );
            die();
        }





        //Delete
        public function deltoken(){
            if($_POST){
                $intidcodigo=intval($_POST['idcodigo']);
                $requestdelete=$this->model->deletetoken($intidcodigo);
                if($requestdelete == 'ok'){
                    $arrresponse= array('status'=>true,'msg'=>'Datos Eliminados Correctamente'.$requestdelete);
                
                }else{
                    if($requestdelete == 'existe'){
                        $arrresponse= array('status'=>false,'msg'=>'No es Posible Eliminar Categoria 45 '.$requestdelete);
                    }else
                        $arrresponse= array('status'=>true,'msg'=>'No se elimino los datos'.$requestdelete);
               }
               echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }



    


    }
?>