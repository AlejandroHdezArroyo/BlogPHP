<?php

    class UserController
    {
        
        public function __construct( )
        {   
            
        }

        public function show( $id ){

            try {
                //ir a por el usuario nº1
                $user =  User::getById($id);
    
                //cargar la vista del usuario
                require_once($_SERVER['DOCUMENT_ROOT'].FOLDER."/views/user/show.php");
                
            } catch (\Throwable $th) {
                echo "ERROR: ".$th->getMessage();
            }
  
        }

        public function signup() {
            global $currentUser;
            try {
                //llamar a método create de User
                //echo "Signup de userController";
                User::signup();

                //Hacer login
                $user = User::login();
                //redirigir a su perfil /profile

                //redirigir al usuario a /login
                header("Location: ".FOLDER."/");

            } catch (\Throwable $th) {
                //echo "ERROR: ".$th->getMessage();
                $error = $th->getMessage();
                //plantilla de formulario de signup --> y ponerle un error donde corresponda
                require_once($_SERVER['DOCUMENT_ROOT'].FOLDER."/views/user/signup.php");
            }
        }

        public function login(){
            try {
                $user = User::login();
                header("Location: ".FOLDER."/");
                
            } catch (\Throwable $th) {
                print_r($th->getMessage());
            }
        }

        public function logout(){
            try {
                User::userLogout();
                header("Location: ".FOLDER."/login");
                
            } catch (\Throwable $th) {
                print_r($th->getMessage());
            }
        }



    }
    


?>