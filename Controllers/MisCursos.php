<?php
class MisCursos extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . "/login");
        }
        getpermisos(6);
    }

    //Visualizacion
    public function MisCursos()
    {
        if(empty($_SESSION['permisosmod']['r'])){
            header('Location: '.base_url()."/dashboard");
        }
        $data['page_tag'] = "Usuarios";
        $data['page_title'] = "Pagina Principal";
        $data['page_name'] = "usuarios";
        $data['page_js'] = "functionmiscursos.js";

        $this->views->getview($this, "miscursos", $data);
    }
    //Visualizacion
    public function getcursos()
    {
        $arrdata = $this->model->selectcursos();
        $crudopciones="";
        
        for ($i = 0; $i < count($arrdata); $i++) {
            if ($arrdata[$i]['estado'] == 1) {
                $arrdata[$i]['estado'] = '<span class="badge badge-pill badge-success">Activo</span>';
            } else {
                $arrdata[$i]['estado'] = '<span class="badge badge-pill badge-danger">Inactivo</span>';
            }



            $crudopciones = '<div class="dropdown">
                <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted" aria-expanded="false"><i class="material-icons">more_horiz</i></a>
                <div class="dropdown-menu dropdown-menu-right" style="">
                
                    <a class="dropdown-item btneditcurso" rl="' . $arrdata[$i]['idcurso'] . '">Editar</a>
                    <a class="dropdown-item btnclases" rl="' . $arrdata[$i]['idcurso'] . '">Clases</a>
                    <div class="dropdown-divider"></div>
                    <a  class="dropdown-item text-danger btndelcurso" rl="' . $arrdata[$i]['idcurso'] . '">Eliminar</a>
                </div>
                </div>';

       

            $arrdata[$i]['acciones'] = '<div class="text-center">' . $crudopciones . '</div>';
        }

        echo json_encode($arrdata, JSON_UNESCAPED_UNICODE);
        die();
    }
    //Especial funciones de visualizacion

    public function getselecategorias()
    {
        $htmloptions = "";
        $arrdata = $this->model->selectcategorias();
        if (count($arrdata) > 0) {
            for ($i = 0; $i < count($arrdata); $i++) {
                $htmloptions .= '<option value="' . $arrdata[$i]['idcategoria'] . '">' . $arrdata[$i]['nombre'] . '</option>';
            }
        }
        echo $htmloptions;
        die();
    }


    public function getselectplataformas()
    {
        $htmloptions = "";
        $arrdata = $this->model->selectplataformas();
        if (count($arrdata) > 0) {
            for ($i = 0; $i < count($arrdata); $i++) {
                $htmloptions .= '<option value="' . $arrdata[$i]['idplataforma'] . '">' . $arrdata[$i]['nombre'] . '</option>';
            }
        }
        echo $htmloptions;
        die();
    }




    public function getcurso($idcurso)
    {

        $intkey = intval(strclean($idcurso));
        if ($intkey > 0) {
            $arrdata = $this->model->selectcurso($intkey);
            if (empty($arrdata)) {
                $arrresponse = array('status' => false, 'msg' => 'Datos no encontrados');
            } else {
                $arrresponse = array('status' => true, 'data' => $arrdata);
            }
            echo json_encode($arrresponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }



    public function setcurso()
    {
        //dep($_POST);
        $intidcurso = intval($_POST['idcurso']);
        $intidautor = $_SESSION['iduser'];
        $strtitulo = strclean($_POST['txttitulo']);
        $strdescripcion = strclean($_POST['txtdescripcion']);
        $intcategor = intval($_POST['listcategorias']);
        $intplataforma = intval($_POST['listplataformas']);
        $intprivacidad = intval($_POST['listprivacidad']);
        $intstatus = intval($_POST['liststatus']);
        

        $filename = $_FILES['materialimg']['name'];
        $extensionArchivo = pathinfo($filename, PATHINFO_EXTENSION);
        $filetamanio = $_FILES['materialimg']['size'];
        $temp = $_FILES['materialimg']['tmp_name'];
        $fileurl = './Assets/archivos/materiales/' . $filename;

        if ($intidcurso == 0) {
            $requestrol = $this->model->insertcurso($intidautor, $intprivacidad, $intcategor,$intplataforma, $strtitulo, $strdescripcion, $intstatus);

            $filename = 'Portada - '.$requestrol.'.'.$extensionArchivo;
            $fileurl = './Assets/archivos/portada-curso/' . $filename;
            $fileurl2 = '/Assets/archivos/portada-curso/' . $filename;
            $requestfile=$this->model->insertfile($requestrol,$filename, $fileurl2);

            $option = 1;
        }
        
        if ($intidcurso != 0) {
            $requestrol = $this->model->updatecurso($intidcurso, $intprivacidad, $intcategor,$intplataforma, $strtitulo, $strdescripcion, $intstatus);

            $filename = 'Portada - '.$intidcurso.'.'.$extensionArchivo;
            $fileurl = './Assets/archivos/portada-curso/' . $filename;
            $fileurl2 = '/Assets/archivos/portada-curso/' . $filename;
            $requestfile=$this->model->insertfile($intidcurso,$filename, $fileurl2);

            $option = 2;
        }


        if ($requestrol > 0) {

            if ($option == 1) {
                $arrresponse = array('status' => true, 'msg' => 'Datos Guardados Correctamente');
                if (file_exists($fileurl)) {
                    unlink($fileurl);
                    move_uploaded_file($temp, $fileurl);
                }else{
                    move_uploaded_file($temp, $fileurl);
                }
            }
            if ($option == 2) {
                $arrresponse = array('status' => true, 'msg' => 'Datos Actualizados Correctamente');
                if (file_exists($fileurl)) {
                    unlink($fileurl);
                    move_uploaded_file($temp, $fileurl);
                }else{
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


    public function asingclases($idcurso)
    {
        $_SESSION['idcurso'] = $idcurso;
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
