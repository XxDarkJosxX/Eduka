<?php 
//Moises
    class ComentariosclaseModel extends Mysql{
       //Nivel de accesos

        private $idcomentario;
        
        private $idusuario;
        private $idclase;
        private $idrespuestas;
        private $comentario;
        private $fecha;


        public function __construct() {

            parent::__construct();
        }


    

    }
