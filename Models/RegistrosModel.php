<?php 
class RegistrosModel extends Mysql {
    //Nivel de accesos
    private $intidusuario;
    private $intidrol;
    private $strnombre;
    private $strapellido;
    private $strcorreo;

    private $intsuscripcion;
    private $strpassword;
    private $intestado;
    private $strtoken;

    public function __construct() {
        parent::__construct();
    }

    public function insertregistro(int $idrol, string $nombre, string $apellido, string $email, int $suscripcion, string $password, int $estado){
        $this->intidrol      = $idrol;
        $this->strnombre     = $nombre;
        $this->strapellido   = $apellido;
        $this->strcorreo     = $email;
        
        $this->intsuscripcion= $suscripcion;
        $this->strpassword   = $password;
        $this->intestado     = $estado;

        $return = 0;

        // Verificar si el correo ya existe
        $sql = "SELECT * FROM tusuarios WHERE correo = '{$this->strcorreo}'";
        $request = $this->selectall($sql);

        if (empty($request)) {
            $query  = "INSERT INTO tusuarios(idroles,nombre, apellidos, correo, telefono, suscripcion, password, estado) 
                        VALUES(?,?,?,?,?,?,?)";
            $arrdata = array(
                $this->intidrol,
                $this->strnombre,
                $this->strapellido,
                $this->strcorreo,
              
                $this->intsuscripcion,
                $this->strpassword,
                $this->intestado
            );
            $request = $this->insert($query, $arrdata);
            $return = $request;
        } else {
            $return = -1; 
        }
        return $return;
    }

    public function settokenuser(int $iduser, string $token){
        $this->intidusuario = $iduser;
        $this->strtoken     = $token;
        $queryupdate = "UPDATE tusuarios SET token = ? WHERE idusuario = $this->intidusuario";
        $arrdata = array($this->strtoken);
        $requestupdate = $this->update($queryupdate, $arrdata);
        return $requestupdate;
    }
}
?>
