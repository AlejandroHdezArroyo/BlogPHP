<?php

    class WebController
    {
        
        public function __construct( )
        {   
            
        }

        
        public function index(){
          global $currentUser;
          try {
            $articulos = Article::list();
            //print_r($articulos);
            require_once($_SERVER['DOCUMENT_ROOT'].FOLDER."/views/web/home.php");
          } catch (\Throwable $th) {
            echo "ERROR: ".$th->getMessage();
          }

        }

        public function services(){
          
          require_once($_SERVER['DOCUMENT_ROOT'].FOLDER."/views/web/services.php");

        }

        public function signup(){
          global $currentUser;
          require_once($_SERVER['DOCUMENT_ROOT'].FOLDER."/views/user/signup.php");

        }

        public function login(){
          global $currentUser;
          if($currentUser){
            header("Location:".FOLDER."/");
          }

          require_once($_SERVER['DOCUMENT_ROOT'].FOLDER."/views/user/login.php");

        }

        public function profile(){
          require_once($_SERVER['DOCUMENT_ROOT'].FOLDER."/views/user/profile.php");
        }

        public function createArt(){
          require_once($_SERVER['DOCUMENT_ROOT'].FOLDER."/views/post/create.php");
        }

        public function editArt(){
          //Article::editarArt();
          require_once($_SERVER['DOCUMENT_ROOT'].FOLDER."/views/post/edit.php");
        }



    }

?>