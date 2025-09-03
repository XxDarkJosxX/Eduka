<?php
//Moises
class VideoModel extends Mysql
{
    //Nivel de accesos

    private $intidcurso;

    private $intidclase;
    private $intidprivacidad;
    private $strenlace;
    private $strtitulo;
    private $strdescripcion;

    private $intestado;

    private $strfilename;
    private $strfileurl;





    private $idcomentario;

    private $idusuario;
    private $idclase;
    private $idrespuestas;
    private $comentario;
    private $fecha;



    public function __construct()
    {

        parent::__construct();
    }
    //YO

    public function selectclase(int $idclase)
    {
        $this->intidclase = $idclase;

        $sql = "SELECT tcl.idclases ,tcl.enlace,tcl.privacidad  ,tcl.archivos,tcl.archivourl, tcl.descripcion ,tc.idcurso, tc.titulo AS titcurso, tcl.titulo AS titclase, tcl.estado
            FROM tclases tcl 
            JOIN tcursos tc ON tc.idcurso  = tcl.idcurso  
            WHERE tcl.estado != 0 AND tcl.idclases =  $this->intidclase";

        $request = $this->select($sql);
        return $request;
    }

    public function selectcurso(int $idclase)
    {

        $this->intidclase = $idclase;

        $sql = "SELECT tc.titulo, tc.portadaurl, tu.nombre, tu.apellidos
                   FROM tcursos tc
                   JOIN tclases tcl ON tc.idcurso  = tcl.idcurso
                   JOIN tusuarios tu ON tu.idusuario  = tc.idusuario
                   WHERE tcl.idclases = $this->intidclase";

        $request = $this->select($sql);
        return $request;
    }


    public function selectcomentarios(int $idclase)
    {
        $this->intidclase = $idclase;
        $sql = "SELECT tc.comentario, tc.fecha, tu.nombre, tu.apellidos
                   FROM tcomentario tc
                   JOIN tclases tcl ON tc.idclase  = tcl.idclases
                   JOIN tusuarios tu ON tu.idusuario  = tc.idusuario
                   WHERE tc.idclase = $this->intidclase";

        $request = $this->selectall($sql);
        return $request;
    }

    public function insertComentario(int $idusuario, int $idclase, string $comentario){
    $fecha = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tcomentario (idusuario, idclase, comentario, fecha) VALUES (?, ?, ?, ?)";
    $arrData = array($idusuario, $idclase, $comentario, $fecha);
    $request = $this->insert($sql, $arrData);
    return $request;
}

}
