<?php 
    class Plataformas extends Controllers{
        public function __construct() {
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url()."/login");
            }
            parent::__construct();
            getpermisos(9);
        }
        
        //Visualizacion
        public function Plataformas(){

            if(empty($_SESSION['permisosmod']['r'])){
                header('Location: '.base_url()."/dashboard");
            }
            $data['page_id'] = 1;
            $data['page_tag'] = "Plataformas";
            $data['page_title']= "Pagina Principal";
            $data['page_name'] = "plataformas";
            $data['page_js'] = "functionplataformas.js";
    
            $this->views->getview($this,"plataformas",$data);
            
        }
        //Visualizacion
        public function getplataformas(){
            $arrdata= $this->model->selecplataformas();
            $crudopciones='';
            for($i=0;$i< count($arrdata);$i++){
                if($arrdata[$i]['estado']==1){
                    $arrdata[$i]['estado']='<span class="badge badge-pill badge-success">Activo</span>';
                }else{
                    $arrdata[$i]['estado']='<span class="badge badge-pill badge-danger">Inactivo</span>';
                }
              
                
                $crudopciones='<div class="dropdown">
                <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted" aria-expanded="false"><i class="material-icons">more_horiz</i></a>
                <div class="dropdown-menu dropdown-menu-right" style="">
                    <a class="dropdown-item btneditplataforma" rl="'.$arrdata[$i]['idplataforma'].'">Editar</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger btndelplataforma" rl="'.$arrdata[$i]['idplataforma'].'">Eliminar</a>
                </div>
                </div>';

                $arrdata[$i]['acciones']= '<div class="text-center">'.$crudopciones.'</div>';
            }
            
            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }


        //Insert 
        //Logica update como
     public function setplataformas(){
            if($_POST){	
            if(empty($_POST['txtnombre']) || empty($_POST['txtdescripcion']) )
            {
                $arrresponse = array("status" => false, "msg" => 'Datos incorrectos.');
            }else{ 
                // No importa el orden de las variables
                $idplataforma = intval($_POST['idplataforma']);
                $strnombre = ucwords(strclean($_POST['txtnombre']));
                $strdescripcion = ucwords(strclean($_POST['txtdescripcion']));
                $intestado = intval(strclean($_POST['liststatus']));
           
                //Esto se basa en el id oculto que se usa en rl 
                if($idplataforma == 0)
                {
                    //Se incrementa mediante la respuesta del request de model
                   
                    $requestplataformas = $this->model->insertplataforma(
                    $strnombre, 
                    $strdescripcion, 
                    $intestado
                    );
                    $option = 1;
                    

                }
                if($idplataforma != 0){
                  
                    $requestplataformas = $this->model->updateplataforma(
                    $idplataforma,
                    $strnombre, 
                    $strdescripcion, 
                    $intestado
                    );
                    $option = 2;

                }
                if($requestplataformas > 0){
 
                    if($option == 1 ){
                        $arrresponse= array('status'=>true,'msg'=>'Datos Guardados Correctamente');
                    }
                    if($option == 2 ){
                        $arrresponse= array('status'=>true,'msg'=>'Datos Actualizados Correctamente');
                    }
                    
               }else{
                    if($requestplataformas == -1){
                        $arrresponse= array('status'=>false,'msg'=>'!Atencion! El rol ya existe');
                    }else
                    $arrresponse= array('status'=>true,'msg'=>'No se almaceno los datos');
               }
               



            }
            echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
        }
        die();
        }
        //Update
        public function getplataforma($idplataforma){
            //dep($_POST);
            $intidplataforma=intval(strclean($idplataforma));

            if ($intidplataforma>0){
                $arrdata = $this->model->selectplataforma($intidplataforma);
                if(empty($arrdata)){
                    $arrresponse= array('status'=>false,'msg'=>'Datos no encontrados');
                }else{
                    $arrresponse= array('status'=>true,'data'=>$arrdata);
                }
                echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            }
            die();
         }

        //Delete
        public function delplataforma(){
            if($_POST){
                $intidplataforma=intval($_POST['idplataforma']);
                $requestdelete=$this->model->deleteplataforma($intidplataforma);
                if($requestdelete == 'ok'){
                    $arrresponse= array('status'=>true,'msg'=>'Datos Eliminados Correctamente'.$requestdelete);
                
                }else{
                    if($requestdelete == 'existe'){
                        $arrresponse= array('status'=>false,'msg'=>'No es Posible Eliminar un plataforma asociado a un curso'.$requestdelete);
                    }else
                        $arrresponse= array('status'=>true,'msg'=>'No se elimino los datos'.$requestdelete);
               }
               echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }



    }
