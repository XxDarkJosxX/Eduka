<?php 
    class Docentes extends Controllers{
        public function __construct() {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url()."/login");
            }
            getpermisos(3);
        }
        
        //Visualizacion
        public function Docentes(){

            if(empty($_SESSION['permisosmod']['r'])){
                header('Location: '.base_url()."/dashboard");
            }

            $data['page_tag'] = "Docentes";
            $data['page_title']= "Pagina Principal";
            $data['page_name'] = "docentes";
            $data['page_js'] = "functiondocentes.js";
            $this->views->getview($this,"docentes",$data);
        }
        
        //Visualizacion
        public function getdocentes(){
            $arrdata= $this->model->selectdocentes();
            $crudopciones="";
            for($i=0;$i< count($arrdata);$i++){
                if($arrdata[$i]['estado']==1){
                    $arrdata[$i]['estado']='<span class="badge badge-pill badge-success">Activo</span>';
                }else{
                    $arrdata[$i]['estado']='<span class="badge badge-pill badge-danger">Inactivo</span>';
                }

                if($arrdata[$i]['suscripcion']==1){
                    $arrdata[$i]['suscripcion']='<span class="badge badge-pill badge-success">Activo</span>';
                }else{
                    $arrdata[$i]['suscripcion']='<span class="badge badge-pill badge-danger">Inactivo</span>';
                }
              
                $crudopciones='<div class="dropdown">
                <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted" aria-expanded="false"><i class="material-icons">more_horiz</i></a>
                <div class="dropdown-menu dropdown-menu-right" style="">
                    <a class="dropdown-item btnviewdocentes"  rl="'.$arrdata[$i]['idusuario'].'">Detalles</a>
                    <a class="dropdown-item btneditdocentes" rl="'.$arrdata[$i]['idusuario'].'">Editar</a>
                    <div class="dropdown-divider"></div>
                    <a  class="dropdown-item text-danger btndeldocentes" rl="'.$arrdata[$i]['idusuario'].'">Eliminar</a>
                </div>
                </div>';


                $arrdata[$i]['acciones']= '<div class="text-center">'.$crudopciones.'</div>';
            }
            
            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getdocente($idusuario){
            
            $intkey=intval(strclean($idusuario));
            if ($intkey>0){
                $arrdata = $this->model->selectdocente($intkey);
                if(empty($arrdata)){
                    $arrresponse= array('status'=>false,'msg'=>'Datos no encontrados');
                }else{
                    $arrresponse= array('status'=>true,'data'=>$arrdata);
                }
                echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }


        //Insert 
        //Logica update como
        public function setdocentes(){
            echo "hola";
            if($_POST){	
            if(empty($_POST['txtnombre']) || empty($_POST['txtapellido']) || empty($_POST['txtcorreo']) )
            {
                $arrresponse = array("status" => false, "msg" => 'Datos incorrectos.');
            }else{ 
                // No importa el orden de las variables
                $idusuario = intval($_POST['idusuario']);
                
                $strnombre = ucwords(strclean($_POST['txtnombre']));
                $strapellido = ucwords(strclean($_POST['txtapellido']));
                $strcorreo = strtolower(strclean($_POST['txtcorreo']));
                $inttelefono = intval(strclean($_POST['txttelefono']));
                $intestado = intval(strclean($_POST['liststatus']));
                $intidrol=intval(2);
                $intsuscripcion = intval(0);
                //Esto se basa en el id oculto que se usa en rl 
                if($idusuario == 0)
                {
                    //Se incrementa mediante la respuesta del request de model
                    $option = 1;
                    $strpassword =  empty($_POST['txtcontrasenia']) ? passgenerator() : $_POST['txtcontrasenia'];
                    $strpasswordencript=hash("SHA256",$strpassword);

                    $requestusuario = $this->model->insertdocentes(
                    $intidrol,
                    
                    $strnombre, 
                    $strapellido, 
                    $strcorreo,
                    $inttelefono,
                    $intsuscripcion,
                    $strpasswordencript,
                    $intestado
                 );
                }else{
                    $option = 2;
                    $requestusuario = $this->model->updatedocentes(
                    $idusuario,
                  
                    $strnombre, 
                    $strapellido, 
                    $strcorreo,
                    $inttelefono,
                    $intestado
                    );

                }
                if($requestusuario > 0){

                    if($option == 1 ){
                        $arrresponse= array('status'=>true,'msg'=>'Datos Guardados Correctamente');
                        $token= token();
                        $nombreuser= $strnombre.' '.$strapellido;
                        $stremail = strtolower(strclean($strcorreo));
                        
                        $urlrecuperar= base_url().'/Login/confirmuser/'.$stremail.'/'.$token;
                        $requestupdate = $this->model->settokenuser($requestusuario,$token);

                           $datausuario = array(
                            'nombreuser'=>$nombreuser,
                            'email'=>$stremail,
                            'asunto'=>'Recuperar cuenta - '.NOMBRE_REMITENTE,
                            'urlrecuperacion'=>$urlrecuperar
                        );
                        $sendemail= sendEmail($datausuario,'emailcambiopassword');

                    }
                    if($option == 2 ){
                        $arrresponse= array('status'=>true,'msg'=>'Datos Actualizados Correctamente');
                    }
                    
               }else{
                    if($requestusuario == -1){
                        $arrresponse= array('status'=>false,'msg'=>'!Atencion! El usuario ya existe');
                    }else
                    $arrresponse= array('status'=>true,'msg'=>'No se almaceno los datos');
               }
            }
            echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
        }
        die();
        }
    


    }
