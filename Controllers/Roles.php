<?php 
    class Roles extends Controllers{
        public function __construct() {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url()."/login");
            }
            getpermisos(5);
        }
        
        //Visualizacion
        public function Roles(){

            if(empty($_SESSION['permisosmod']['r'])){
                header('Location: '.base_url()."/dashboard");
            }
       

            $data['page_id'] = 1;
            $data['page_tag'] = "Roles";
            $data['page_title']= "Pagina Principal";
            $data['page_name'] = "roles";
            $data['page_js'] = "functionroles.js";
    
            $this->views->getview($this,"roles",$data);
            
        }
        //Visualizacion
        public function getroles(){
            $arrdata= $this->model->selectroles();
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
                
                
                    <a class="dropdown-item btneditroles" rl="'.$arrdata[$i]['idroles'].'">Editar</a>
                    <a class="dropdown-item btnpermisorol" rl="'.$arrdata[$i]['idroles'].'">Permisos</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger btndelroles" rl="'.$arrdata[$i]['idroles'].'">Eliminar</a>
                </div>
                </div>';

                $arrdata[$i]['acciones']= '<div class="text-center">'.$crudopciones.'</div>';
            }
            
            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }


        //Insert 
        //Logica update como
        public function setroles(){
            //dep($_POST);
            $intidrol=intval($_POST['idrol']);
            $strtipo=strclean($_POST['txttipo']);
            $strdescripcion=strclean($_POST['txtdescripcion']);
            $intstatus=intval($_POST['liststatus']);
            
 
            if($intidrol == 0){
                 $requestrol=$this->model->insertrol($strtipo,$strdescripcion,$intstatus);
                 $option=1;
            }
            if($intidrol != 0){
                 $requestrol=$this->model->updaterol( $intidrol,$strtipo,$strdescripcion,$intstatus);
                 $option=2;
            }
 
            if($requestrol > 0){
 
                 if($option == 1 ){
                     $arrresponse= array('status'=>true,'msg'=>'Datos Guardados Correctamente');
                 }
                 if($option == 2 ){
                     $arrresponse= array('status'=>true,'msg'=>'Datos Actualizados Correctamente');
                 }
                 
            }else{
                 if($requestrol == -1){
                     $arrresponse= array('status'=>false,'msg'=>'!Atencion! El rol ya existe');
                 }else
                 $arrresponse= array('status'=>true,'msg'=>'No se almaceno los datos');
            }
            
            
            echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            die();
            
         }

        //Update
        public function getrol($idrol){
            //dep($_POST);
            $intidrol=intval(strclean($idrol));

            if ($intidrol>0){
                $arrdata = $this->model->selectrol($intidrol);
                if(empty($arrdata)){
                    $arrresponse= array('status'=>false,'msg'=>'Datos no encontrados');
                }else{
                    $arrresponse= array('status'=>true,'data'=>$arrdata);
                }
                echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            }
            die();
         }

        //Especial funciones de visualizacion

        public function getselectroles(){

            $htmloptions="";
            $arrdata = $this->model->selectroles();
            if(count($arrdata) > 0){
                for($i=0;$i < count($arrdata); $i++){
                    $htmloptions.='<option value="'.$arrdata[$i]['idroles'].'">'.$arrdata[$i]['tipo'].'</option>';
                }
            }
            echo $htmloptions;
            die();

        }

        //Delete
        public function delrol(){
            if($_POST){
                $intidrol=intval($_POST['idrol']);
                $requestdelete=$this->model->deleterol($intidrol);
                if($requestdelete == 'ok'){
                    $arrresponse= array('status'=>true,'msg'=>'Datos Eliminados Correctamente'.$requestdelete);
                
                }else{
                    if($requestdelete == 'existe'){
                        $arrresponse= array('status'=>false,'msg'=>'No es Posible Eliminar un rol asociado a un usuario'.$requestdelete);
                    }else
                        $arrresponse= array('status'=>true,'msg'=>'No se elimino los datos'.$requestdelete);
               }
               echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }



    }
?>