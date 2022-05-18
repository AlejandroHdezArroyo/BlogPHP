<?php
    /**
     * Controlador Principal que se encarga de manejar las rutas
     */
    class RouterController
    {
        private $method;
        private $uri;

        public function __construct(){
            $this->method = $_SERVER['REQUEST_METHOD'];
            $this->uri = str_replace(FOLDER, "", $_SERVER['REQUEST_URI']);
        }

        public function manageUris(){
           
            $webController = new WebController();
            $userController = new UserController();
            $articleController = new ArticleController();
            
            if( $this->method == "GET" && ($this->uri == "/" || $this->uri == "/home") ){

                $webController->index();
                
            }

            if($this->method == "GET" && $this->uri == "/services"){

                $webController->services();

            }

            if($this->method == "GET" && $this->uri == "/signup"){

                $webController->signup();

            }

            
            if($this->method == "POST" && $this->uri == "/signup"){
                //registro usuario
                $userController->signup();
            }
            
            
            if($this->method == "GET" && $this->uri == "/login"){
                $webController->login();
            }
            

            if($this->method == "POST" && $this->uri == "/login"){
                //registro usuario
                $userController->login();
            }


            if($this->method == "POST" && $this->uri == "/logout"){
                $userController->logout();
            }


            if($this->method == "GET" && $this->uri == "/create"){
                $webController->createArt();
            }


            if($this->method == "POST" && $this->uri == "/article"){
                $articleController->createArt();
            }


            if($this->method == "POST" && $this->uri == "/deleteArticle"){
                $articleController->deleteArt();
            }

            // if($this->method == "GET" && $this->uri == "/editArticle"){
            //     $webController->editArt();
            // }


            if($this->method == "GET" && $this->uri == "/profile"){
                $webController->profile();
            }
            


            //con la expresión regular le decimos que la url sea user/y el número que sea
            if( $this->method == "GET" && preg_match("/^\/user\/[0-9]+$/i", $this->uri) ){

                $id = str_replace("/user/", "", $this->uri);

                $userController->show($id);

                // $directory = preg_replace("/[0-9]+$/", "", $this->uri );
                // $id = str_replace( $directory, "" , $this->uri );

                // $userController = new UserController();
                // $userController->show( $id );
                
            }


            if( $this->method == "GET" && preg_match("/^\/article\/[0-9]+$/i", $this->uri) ){

                $id = str_replace("/article/", "", $this->uri);

                $articleController->show($id);
            }
            

            if( $this->method == "GET" && preg_match("/^\/editArticle\/[0-9]+$/i", $this->uri) ){

                $id = str_replace("/editArticle/", "", $this->uri);

                $webController->editArt();
            }

        }
        
    }
    



?>