<?php
class Video extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    //Visualizacion
    public function Video()
    {


        $data['page_tag'] = "Usuarios";
        $data['page_title'] = "Pagina Principal";
        $data['page_name'] = "usuarios";
        $data['page_js'] = "functionvideo.js";

        $this->views->getview($this, "video", $data);
    }


    public function getclase()
    {
        $idclase = $_SESSION['idclasev'];

        $arrdata = $this->model->selectclase($idclase);

        echo json_encode($arrdata, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getcurso()
    {
        $idclase = $_SESSION['idclasev'];

        $arrdata = $this->model->selectcurso($idclase);

        echo json_encode($arrdata, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getcomentarios()
    {
        $idclase = $_SESSION['idclasev'];
        $arrdata = $this->model->selectcomentarios($idclase);

        echo json_encode($arrdata, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function setcomentario()
    {
        if ($_POST) {
            if (empty($_POST['comentario'])) {
                $arrresponse = array("status" => false, "msg" => "El comentario está vacío.");
            } else {
                $idusuario = $_SESSION['iduser'];
                $idclase   = $_SESSION['idclasev'];
                $comentario = strclean($_POST['comentario']); // tu función de limpieza

                $request = $this->model->insertComentario($idusuario, $idclase, $comentario);

                if ($request > 0) {
                    $arrresponse = array("status" => true, "msg" => "Comentario agregado correctamente.");
                } else {
                    $arrresponse = array("status" => false, "msg" => "No se pudo agregar el comentario.");
                }
            }

            echo json_encode($arrresponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
