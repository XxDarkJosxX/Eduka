<?php 
    class Comentariosclase extends Controllers{
        public function __construct() {
            parent::__construct();
            session_start();
          
        }
            
        //Visualizacion
        public function Comentariosclase(){

       
            $data['page_tag'] = "Usuarios";
            $data['page_title']= "Pagina Principal";
            $data['page_name'] = "usuarios";
            $data['page_js'] = "functioncomentariosclase.js";
    
            $this->views->getview($this,"comentariosclase",$data);
            
        }


   
   
    }
