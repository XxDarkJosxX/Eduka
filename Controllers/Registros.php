<?php
class Registros extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        session_start();
       
        //getpermisos(3);
    }

    //Visualizacion
    public function Registros()
    {
        $data['page_tag'] = "Registros";
        $data['page_title'] = "Pagina Principal";
        $data['page_name'] = "registros";
        $data['page_js'] = "functionregistros.js";
        $this->views->getview($this, "registros", $data);
    }

    //Insert 
    //Logica update como
    public function setregistros()
    {
        if ($_POST) {
            if (empty($_POST['txtnombre']) || empty($_POST['txtapellido']) || empty($_POST['txttelefono']) ||  empty($_POST['txtci']) ||  empty($_POST['txtcorreo'])) {
                $arrresponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                // No importa el orden de las variables
        
                $strci = strclean($_POST['txtci']);
                $strnombre = ucwords(strclean($_POST['txtnombre']));
                $strapellido = ucwords(strclean($_POST['txtapellido']));
                $inttelefono = intval(strclean($_POST['txttelefono']));
                $strcorreo = strtolower(strclean($_POST['txtcorreo']));
                $intestado = intval(1);
                $intidrol = intval(3);
                $intsuscripcion = intval(0);

                //Se incrementa mediante la respuesta del request de model
                $strpassword =  empty($_POST['txtcontrasenia']) ? passgenerator() : $_POST['txtcontrasenia'];
                $strpasswordencript = hash("SHA256", $strpassword);

                $requestusuario = $this->model->insertregistro(
                    $intidrol,
                    $strci,
                    $strnombre,
                    $strapellido,
                    $strcorreo,
                    $inttelefono,
                    $intsuscripcion,
                    $strpasswordencript,
                    $intestado
                );

                if ($requestusuario > 0) {
                    $arrresponse = array('status' => true, 'msg' => 'Datos Guardados Correctamente');
                    $token = token();
                    $nombreuser = $strnombre . ' ' . $strapellido;
                    $stremail = strtolower(strclean($strcorreo));

                    $urlrecuperar = base_url() . '/Login/confirmuser/' . $stremail . '/' . $token;
                    $requestupdate = $this->model->settokenuser($requestusuario, $token);

                    $datausuario = array(
                        'nombreuser' => $nombreuser,
                        'email' => $stremail,
                        'asunto' => 'Recuperar cuenta - ' . NOMBRE_REMITENTE,
                        'urlrecuperacion' => $urlrecuperar
                    );
                    $sendemail = sendEmail($datausuario, 'emailcambiopassword');
                } else {
                    if ($requestusuario == -1) {
                        $arrresponse = array('status' => false, 'msg' => '!Atencion! El usuario ya existe');
                    } else
                        $arrresponse = array('status' => true, 'msg' => 'No se almaceno los datos');
                }
            }
            echo json_encode($arrresponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
