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
  
    // Inserción general (sirve para normal y Gmail)
public function setregistros()
{
    if ($_POST) {
        if (empty($_POST['txtnombre']) || empty($_POST['txtapellido']) || empty($_POST['txtcorreo'])) {
            $arrresponse = array("status" => false, "msg" => 'Datos incompletos.');
        } else {
            $strnombre     = ucwords(strclean($_POST['txtnombre']));
            $strapellido   = ucwords(strclean($_POST['txtapellido']));
            $strcorreo     = strtolower(strclean($_POST['txtcorreo']));
            $inttelefono   = empty($_POST['txttelefono']) ? 0 : intval(strclean($_POST['txttelefono']));
            $intestado     = 1;
            $intidrol      = 3;
            $intsuscripcion= 0;

            // Password: si viene vacío (Gmail), se genera dummy
            $strpassword = empty($_POST['txtcontrasenia']) ? bin2hex(random_bytes(6)) : $_POST['txtcontrasenia'];
            $strpasswordencript = hash("SHA256", $strpassword);

            $requestusuario = $this->model->insertregistro(
                $intidrol,
                $strnombre,
                $strapellido,
                $strcorreo,
                $inttelefono,
                $intsuscripcion,
                $strpasswordencript,
                $intestado
            );

            if ($requestusuario > 0) {
                $arrresponse = array('status' => true, 'msg' => 'Usuario registrado correctamente');
            } else {
                if ($requestusuario == -1) {
                    $arrresponse = array('status' => false, 'msg' => '!Atención! El usuario ya existe');
                } else {
                    $arrresponse = array('status' => false, 'msg' => 'No se almacenaron los datos');
                }
            }
        }
        echo json_encode($arrresponse, JSON_UNESCAPED_UNICODE);
    }
    die();
}




}
