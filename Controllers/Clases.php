<?php
class Clases extends Controllers
{

    public function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . "/login");
        }
        if (empty($_SESSION['idcurso'])) {
            header('Location: ' . base_url() . "/Cursos");
        }
        getpermisos(7);
    }

    //Visualizacion
    public function Clases()
    {

        if (empty($_SESSION['permisosmod']['r'])) {
            header('Location: ' . base_url() . "/dashboard");
        }

        $data['page_tag'] = "Usuarios";
        $data['page_title'] = "Pagina Principal";
        $data['page_name'] = "usuarios";
        $data['page_js'] = "functionclases.js";

        $this->views->getview($this, "clases", $data);
    }

    //Visualizacion
    public function getclases()
    {
        $idcurso = $_SESSION['idcurso'];
        $crudopciones = "";

        $arrdata = $this->model->selectclases($idcurso);

        for ($i = 0; $i < count($arrdata); $i++) {
            if ($arrdata[$i]['estado'] == 1) {
                $arrdata[$i]['estado'] = '<span class="badge badge-pill badge-success">Activo</span>';
            } else {
                $arrdata[$i]['estado'] = '<span class="badge badge-pill badge-danger">Inactivo</span>';
            }
            if ($arrdata[$i]['privacidad'] == 1) {
                $arrdata[$i]['privacidad'] = '<span class="badge badge-pill badge-success">Publico</span>';
            } else {
                $arrdata[$i]['privacidad'] = '<span class="badge badge-pill badge-danger">Privado</span>';
            }

            $crudopciones = '<div class="dropdown">
                <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted" aria-expanded="false"><i class="material-icons">more_horiz</i></a>
                <div class="dropdown-menu dropdown-menu-right" style="">
                
                    <a class="dropdown-item btneditclase" rl="' . $arrdata[$i]['idclases'] . '">Editar</a>
          
                    <div class="dropdown-divider"></div>
                    <a  class="dropdown-item text-danger btndelclase" rl="' . $arrdata[$i]['idclases'] . '">Eliminar</a>
                </div>
                </div>';


            $arrdata[$i]['acciones'] = '<div class="text-center">' . $crudopciones . '</div>';
        }

        echo json_encode($arrdata, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function getclase($idclase)
    {

        $intkey = intval(strclean($idclase));
        if ($intkey > 0) {
            $arrdata = $this->model->selectclase($intkey);
            if (empty($arrdata)) {
                $arrresponse = array('status' => false, 'msg' => 'Datos no encontrados');
            } else {
                $arrresponse = array('status' => true, 'data' => $arrdata);
            }
            echo json_encode($arrresponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }


    //Insert 
    //Logica update como
    public function setclase()
    {
        //dep($_POST);
        $idcurso = $_SESSION['idcurso'];
        $intidclase = intval($_POST['idclase']);
        $strtitulo = strclean($_POST['txttitulo']);
        $strdescripcion = strclean($_POST['txtdescripcion']);
        $strenlace = $_POST['txtenlace'];

        $filename = $_FILES['materialfile']['name'];
        $extensionArchivo = pathinfo($filename, PATHINFO_EXTENSION);
        $filetamanio = $_FILES['materialfile']['size'];
        $temp = $_FILES['materialfile']['tmp_name'];
        $fileurl = './Assets/archivos/materiales/' . $filename;


        $intprivacidad = intval($_POST['listprivacidad']);
        $intstatus = intval($_POST['liststatus']);

        if ($intidclase == 0) {
            $requestrol = $this->model->insertclase($idcurso, $strtitulo, $strdescripcion, $strenlace, $intprivacidad, $intstatus);
            //acciones para realizar la inserion del archivo
            $filename = 'Material de Clase - ' . $requestrol . '.' . $extensionArchivo;
            $fileurl = './Assets/archivos/materiales/' . $filename;
            $fileurl2 = '/Assets/archivos/materiales/' . $filename;
            $requestfile = $this->model->insertfile($requestrol, $filename, $fileurl2);

            $option = 1;
        }
        if ($intidclase != 0) {
            $requestrol = $this->model->updateclase($intidclase, $idcurso, $strtitulo, $strdescripcion, $strenlace, $intprivacidad, $intstatus);

            $filename = 'Material de Clase - ' . $intidclase . '.' . $extensionArchivo;
            $fileurl = './Assets/archivos/materiales/' . $filename;
            $fileurl2 = './Assets/archivos/materiales/' . $filename;
            $requestfile = $this->model->insertfile($intidclase, $filename, $fileurl2);
            $option = 2;
        }

        if ($requestrol > 0) {

            if ($option == 1) {
                $arrresponse = array('status' => true, 'msg' => 'Datos Guardados Correctamente');
                if (file_exists($fileurl)) {
                    unlink($fileurl);
                    move_uploaded_file($temp, $fileurl);
                } else {
                    move_uploaded_file($temp, $fileurl);
                }
            }
            if ($option == 2) {
                $arrresponse = array('status' => true, 'msg' => 'Datos Actualizados Correctamente');
                if (file_exists($fileurl)) {
                    unlink($fileurl);
                    move_uploaded_file($temp, $fileurl);
                } else {
                    move_uploaded_file($temp, $fileurl);
                }
            }
        } else {
            if ($requestrol == -1) {
                $arrresponse = array('status' => false, 'msg' => '!Atencion! El curso ya existe');
            } else
                $arrresponse = array('status' => true, 'msg' => 'No se almaceno los datos');
        }


        echo json_encode($arrresponse, JSON_UNESCAPED_UNICODE);
        die();
    }



    public function delcurso()
    {
        if ($_POST) {
            $intidcurso = intval($_POST['idcurso']);
            $requestdelete = $this->model->deletecurso($intidcurso);
            if ($requestdelete == 'ok') {
                $arrresponse = array('status' => true, 'msg' => 'Datos Eliminados Correctamente' . $requestdelete);
            } else {
                if ($requestdelete == 'existe') {
                    $arrresponse = array('status' => false, 'msg' => 'No es Posible Eliminar un curso asociado a una leccion' . $requestdelete);
                } else
                    $arrresponse = array('status' => true, 'msg' => 'No se elimino los datos' . $requestdelete);
            }
            echo json_encode($arrresponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
