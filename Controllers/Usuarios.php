<?php 
    class Usuarios extends Controllers{
        public function __construct() {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url()."/login");
            }
            getpermisos(2);
        }

                
        //Visualizacion
        public function Usuarios(){
            if(empty($_SESSION['permisosmod']['r'])){
                header('Location: '.base_url()."/dashboard");
            }
            $data['page_tag'] = "Usuarios";
            $data['page_title']= "Pagina Principal";
            $data['page_name'] = "usuarios";
            $data['page_js'] = "functionsusuarios.js";
    
            $this->views->getview($this,"usuarios",$data);
            
        }
        //Visualizacion
        public function getusuarios(){
            $arrdata= $this->model->selectusuarios();
            $script='';
            for($i=0;$i< count($arrdata);$i++){
                if($arrdata[$i]['estado']==1){
                    $arrdata[$i]['estado']='<span class="badge badge-pill badge-success">Activo</span>';
                }else{
                    $arrdata[$i]['estado']='<span class="badge badge-pill badge-danger">Inactivo</span>';
                }
                //Id Usuario de acuerdo a su tabla en la base de datos esto recupera los datos de la BD
                //El funcion fntwiew ya se inicializa con un evento


              //  $btnview='<button class="btn btn-info btn-sm btnviewsstyle btnviewusuario" onClick="fntviewcliente('.$arrdata[$i]['idusuario'].')" title="Ver usuario"><i class="far fa-eye"></i></button>';
              //  $btnedit='<button class="btn btn-primary btn-sm btneditstyle btneditusuario" rl="'.$arrdata[$i]['idusuario'].'" title="Editar" type="button"><i class="fas fa-pencil-alt"></i></button>';
              //  $btndelete='<button class="btn btn-danger btn-sm btndelstyle btndelusuario" rl="'.$arrdata[$i]['idusuario'].'" title="Eliminar" type="button"><i class="fas fa-trash-alt"></i></button>';

                if($i == (count($arrdata)-1)){
                    //Necesario agregar para que funciones las funciones de delete y update
                    $script='<script type="text/javascript"> fnteditusuario(); fntdelusuario();</script>';
                }

                $crudopciones='<div class="dropdown">
                <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted" aria-expanded="false"><i class="material-icons">more_horiz</i></a>
                <div class="dropdown-menu dropdown-menu-right" style="">
                    <a onClick="fntviewcliente('.$arrdata[$i]['idusuario'].')" class="dropdown-item">Detalles</a>
                    <a class="dropdown-item btneditusuario" rl="'.$arrdata[$i]['idusuario'].'">Editar</a>
                    <div class="dropdown-divider"></div>
                    <a  class="dropdown-item text-danger btndelusuario" rl="'.$arrdata[$i]['idusuario'].'">Eliminar</a>
                </div>
                </div>';

                $arrdata[$i]['acciones']= '<div class="text-center">'.$crudopciones.' '.$script.'</div>';
            }
            
            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }


        //Insert 
        //Logica update como
        public function setusuarios(){
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
                $intidrol=intval($_POST['txtrol']);
                //Esto se basa en el id oculto que se usa en rl 
                if($idusuario == 0)
                {
                    //Se incrementa mediante la respuesta del request de model
                    $option = 1;
                    $strpassword =  empty($_POST['txtcontrasenia']) ? passgenerator() : $_POST['txtcontrasenia'];
                    $strpasswordencript=hash("SHA256",$strpassword);

                    $requestusuario = $this->model->insertusuario(
                    $intidrol,
                    
                    $strnombre, 
                    $strapellido, 
                    $strcorreo,
                    $inttelefono,
                    $strpasswordencript,
                    $intestado
                 );
                }else{
                    $option = 2;
                    $requestusuario = $this->model->updateusuario(
                    $idusuario,
                    $intidrol,
                    
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
        //Update
        public function getusuario($idusuario){
            
            $intkey=intval(strclean($idusuario));
            if ($intkey>0){
                $arrdata = $this->model->selectusuario($intkey);
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
        public function delusuario(){
            if($_POST){
                
                $intidusuario=intval($_POST['idusuario']);
                
                $requestdelete=$this->model->deleteusaurio($intidusuario);

                if($requestdelete == 'ok'){
                    $arrresponse= array('status'=>true,'msg'=>'Datos Eliminados Correctamente '.$requestdelete);
                
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
