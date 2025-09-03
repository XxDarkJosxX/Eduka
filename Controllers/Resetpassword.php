<?php 
    class Resetpassword extends Controllers{
        public function __construct() {
            parent::__construct();
        }
        public function Resetpassword(){

            $data['page_js'] = "functionresetpassword.js";
            session_start();
            $this->views->getview($this,"resetpassword",$data);
            
        }


        public function reset(){
            if($_POST){
                if(empty($_POST['txtemailreset'])){
                    $arrresponse= array('status'=>false,'msg'=>'Error en los campos');
                }else{
                    $token= token();
                    $stremail = strtolower(strclean($_POST['txtemailreset']));
                    $arrdata = $this->model->getuseremail($stremail);
                    if(empty($arrdata)){
                        $arrresponse= array('status'=>false,'msg'=>'Usuario no encontrado');
                    }else{
                        $idpersona = $arrdata['idusuario'];
                        $nombreuser= $arrdata['nombre'].' '.$arrdata['apellidos'];

                        $urlrecuperar= base_url().'/Login/confirmuser/'.$stremail.'/'.$token;
                        $requestupdate = $this->model->settokenuser($idpersona,$token);

                        $datausuario = array(
                            'nombreuser'=>$nombreuser,
                            'email'=>$stremail,
                            'asunto'=>'Recuperar cuenta - '.NOMBRE_REMITENTE,
                            'urlrecuperacion'=>$urlrecuperar
                        );

                   
                        
                        if($requestupdate){
                            $sendemail= sendEmail($datausuario,'emailcambiopassword');
                            if($sendemail){
                                $arrresponse= array('status'=>true,'msg'=>'Se envio un email a tu correo para cambiar tu contraseña');
                            }
                            else{
                                $arrresponse= array('status'=>false,'msg'=>'No es posible realizar el proceso');
                            }
                        }
                        else{
                            $arrresponse= array('status'=>false,'msg'=>'No es posible realizar el proceso');
                        }
                    }
                }
                echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }



    }
?>