<?php 
    class Home extends Controllers{
        public function __construct() {
            parent::__construct();
        }
        public function home(){

            $data['page_id'] = 1;
            $data['page_tag'] = "Home";
            $data['page_title']= "Pagina Principal";
            $data['page_name'] = "home";
            session_start();
            $this->views->getview($this,"home",$data);
            
        }


    }
?>