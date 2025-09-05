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
      public function setplataformas()
    {
        // 1. Validar que la solicitud sea POST y que los datos esenciales no estén vacíos.
        if ($_POST) {
            if (empty($_POST['txtnombre']) || empty($_POST['txtdescripcion']) || empty($_POST['liststatus'])) {
                $arrresponse = array("status" => false, "msg" => 'Datos incorrectos o incompletos.');
            } else {
                // 2. Limpieza y asignación de variables
                $intidplataforma = intval($_POST['idplataforma']);
                $strnombre = ucwords(strclean($_POST['txtnombre']));
                $strdescripcion = strclean($_POST['txtdescripcion']);
                $intstatus = intval($_POST['liststatus']);
                $option = 0;
                $requestplataforma = 0;

                // 3. Lógica para Insertar o Actualizar (uso de if/else para mayor claridad)
                if ($intidplataforma == 0) {
                    // Es un nuevo registro
                    $requestplataforma = $this->model->insertplataforma($strnombre, $strdescripcion, $intstatus);
                    $option = 1;
                } else {
                    // Es una actualización
                    $requestplataforma = $this->model->updateplataforma($intidplataforma, $strnombre, $strdescripcion, $intstatus);
                    $option = 2;
                }

                // 4. Manejo de la respuesta
                if ($requestplataforma > 0) {
                    if ($option == 1) {
                        $arrresponse = array('status' => true, 'msg' => 'Datos Guardados Correctamente');
                    } else { // $option == 2
                        $arrresponse = array('status' => true, 'msg' => 'Datos Actualizados Correctamente');
                    }
                } else {
                    // Manejo de errores basado en el valor de retorno del modelo
                    if ($requestplataforma == -1) {
                        $arrresponse = array('status' => false, 'msg' => '!Atencion! El nombre de la plataforma ya existe');
                    } else {
                        // Aquí se corrige la inconsistencia, si falla, el status es false
                        $arrresponse = array('status' => false, 'msg' => 'No se almacenaron los datos');
                    }
                }
            }
            // 5. Envío de la respuesta JSON
            echo json_encode($arrresponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
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
