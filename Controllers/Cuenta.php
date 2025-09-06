<?php 
    class Cuenta extends Controllers{
        public function __construct() {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url()."/login");
            }
            getpermisos(0);
        }
        
        //Visualizacion
        public function Cuenta(){
            $data['page_tag'] = "Cuentas";
            $data['page_title']= "Pagina Principal";
            $data['page_name'] = "cuentas";
            $data['page_js'] = "functioncuenta.js";
            $this->views->getview($this,"cuenta",$data);
        }
        
        //Insert 
        //Logica update como
        public function setcuentas(){
            
            if($_POST){	
            if(empty($_POST['txtnombre']) || empty($_POST['txtapellido']) )
            {
                $arrresponse = array("status" => false, "msg" => 'Datos incorrectos.');
            }else{ 
                // No importa el orden de las variables
                $intidautor=$_SESSION['iduser'];
           
                $strnombre = ucwords(strclean($_POST['txtnombre']));
                $strapellido = ucwords(strclean($_POST['txtapellido']));
                $strtelefono = ucwords(strclean($_POST['txttelefono']));
           

                if($intidautor != 0){
                    $requestusuario = $this->model->updatecuenta(
                    $intidautor,
                    $strnombre, 
                    $strapellido, 
                    $strtelefono
                    ); 
                    $arrresponse= array('status'=>true,'msg'=>'Datos Actualizados Correctamente');
                }
               
            }
            echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
        }
        die();
        }

        
        public function getusuario(){
            
            $intkey= $_SESSION['iduser'];
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

    }
