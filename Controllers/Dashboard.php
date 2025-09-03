<?php 
    class Dashboard extends Controllers{
        public function __construct() {
            parent::__construct();
        }
        public function Dashboard(){

            //$data['page_id'] = 1;
            $data['page_tag'] = "Dashboard";
            $data['page_title']= "Dashboard";
            $data['page_name'] = "Dashboard";
            session_start();
            $this->views->getview($this,"dashboard",$data);
            
        }


    }
?>