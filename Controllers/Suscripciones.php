<?php 
    class Suscripciones extends Controllers{
        public function __construct() {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url()."/login");
            }
            getpermisos(2);
        }
        
        //Visualizacion
        public function Suscripciones(){
            if(empty($_SESSION['permisosmod']['r'])){
                header('Location: '.base_url()."/dashboard");
            }
            $data['page_tag'] = "Suscripciones";
            $data['page_title']= "Pagina Principal";
            $data['page_name'] = "Suscripciones";
            $data['page_js'] = "functionsuscripciones.js";
            $this->views->getview($this,"suscripciones",$data);
        }
        
        //Visualizacion
        public function getsuscripciones(){
            $arrdata= $this->model->selecsuscripciones();
            $crudopciones="";
            
            for($i=0;$i< count($arrdata);$i++){
                if($arrdata[$i]['estado']==1){
                    $arrdata[$i]['estado']='<span class="badge badge-pill badge-success">Activo</span>';
                }else{
                    $arrdata[$i]['estado']='<span class="badge badge-pill badge-danger">Inactivo</span>';
                }

              
                $crudopciones='<div class="dropdown">
                <a  data-toggle="dropdown" data-caret="false" class="text-muted" aria-expanded="false"><i class="material-icons">more_horiz</i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item btneditsuscripciones" rl="'.$arrdata[$i]['idsuscripcion'].'">Editar</a>
                        <div class="dropdown-divider"></div>
                        <a  class="dropdown-item text-danger btndelsuscripciones" rl="'.$arrdata[$i]['idsuscripcion'].'">Eliminar</a>
                    </div>
                </div>
                ';
             
                $arrdata[$i]['acciones']= '<div class="text-center">'.$crudopciones.'</div>';
            }
            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }




        //Insert 
        //Logica update como
        public function setcategorias(){
            if($_POST){	
            if(empty($_POST['txtnombre']) || empty($_POST['txtdescripcion']) )
            {
                $arrresponse = array("status" => false, "msg" => 'Datos incorrectos.');
            }else{ 
                // No importa el orden de las variables
                $idcategorias = intval($_POST['idcategoria']);
                $strnombre = ucwords(strclean($_POST['txtnombre']));
                $strdescripcion = ucwords(strclean($_POST['txtdescripcion']));
                $intestado = intval(strclean($_POST['liststatus']));
           
                //Esto se basa en el id oculto que se usa en rl 
                if($idcategorias == 0)
                {
                    //Se incrementa mediante la respuesta del request de model
                   
                    $requestcategorias = $this->model->insertcategorias(
                    $strnombre, 
                    $strdescripcion, 
                    $intestado
                    );
                    $option = 1;
                    

                }
                if($idcategorias != 0){
                  
                    $requestcategorias = $this->model->updatecategorias(
                    $idcategorias,
                    $strnombre, 
                    $strdescripcion, 
                    $intestado
                    );
                    $option = 2;

                }
                if($requestcategorias > 0){
 
                    if($option == 1 ){
                        $arrresponse= array('status'=>true,'msg'=>'Datos Guardados Correctamente');
                    }
                    if($option == 2 ){
                        $arrresponse= array('status'=>true,'msg'=>'Datos Actualizados Correctamente');
                    }
                    
               }else{
                    if($requestcategorias == -1){
                        $arrresponse= array('status'=>false,'msg'=>'!Atencion! El rol ya existe');
                    }else
                    $arrresponse= array('status'=>true,'msg'=>'No se almaceno los datos');
               }
               



            }
            echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
        }
        die();
        }
        public function getcategoria($idkey){
            
            $intkey=intval(strclean($idkey));
            if ($intkey>0){
                $arrdata = $this->model->selectcategoria($intkey);
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
        public function delcategoria(){
            if($_POST){
                $intidcategoria=intval($_POST['idcategoria']);
                $requestdelete=$this->model->deletecategoria($intidcategoria);
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