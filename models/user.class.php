<?php

    class User extends DBConnection {
        private $id;
        private $email;
        private $nombre;
        private $apellidos;
        private $password;
        private $created_at;

        //$params será un array asociativo con todos los parámetros de arriba, ejemplo:
        // $params = [
        //     'id'=>1,
        //     'email'=>manu@manu.com,
        //     'password'=>123456,
        //     'created_at'=>21321213,
        // ];
       
        public function __construct( $params ){
            foreach ($params as $key => $value) {
                $this->$key = $value;
            }
        }

        function __get($name){
            return $this->$name;
        }

        //obtiene usuario de la bbdd y devulve un User Object
        public static function getById($id){
            //conectar con bbdd del
            global $connection;
            //SQL query
            $query = "SELECT * FROM user WHERE id = $id";
            //ejecutar query
            $execq = $connection->query($query);

            if($connection->error){
                throw new Exception ("Error al obtener un usuario: ".$connection->error);
            }

            if($execq->num_rows != 1){
                throw new Exception ("No se encuentra al usuario");
            }
            //recoger usuario
            $user_bd = $execq->fetch_assoc();

            $user = new User($user_bd);


            return $user;
            //devolver un User Object
            
        }

        public static function signup(){
            
            //1. validar campos
                 //correo y password está ok?
            if( !self::validateFields() ){
                throw new Exception("Campos no válidos");
            }

            //2.conexion
            global $connection;
            $email = $_POST['email'];
            
            //3.query (SELECT correo?) para verificar que el correo no existe ya en la bbdd
            $query_email = "SELECT id FROM user WHERE email = '$email'";
            //4. ejecutamos query
            $exec_q_email = $connection->query( $query_email );
            //5. errores...
            if( $connection->error ){
                throw new Exception( "Error al obtener usuario por email: ". $connection->error );
            }
            if( $exec_q_email->num_rows !=0 ){
                throw new Exception("Este usuario ya está registrado");
            }
            //ciframos la contraseña con password_hash
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            //6. query (insert) para añadir usuario a la bbdd
            $query_insert = "INSERT INTO `user`(`email`, `password`) VALUES ('$email','$password')";
            //7. ejecutar query
            $connection->query($query_insert);
            //8. errores... 
            if( $connection->error ){
                throw new Exception( "Error al crear usuario: ". $connection->error );
            }
            //usuario registrado
        }

        public static function login(){
            //validación de campos
            if( !self::validateFields() ){
                throw new Exception("Campos no válidos");
            }

            //preguntar si existe un usuario por email
            global $connection;
            $email = $_POST['email'];

            $query_email = "SELECT * FROM user WHERE email = '$email'";

            $exec_q_email = $connection->query( $query_email );

            if( $connection->error ){
                throw new Exception( "Error al crear usuario: ". $connection->error );
            }

            if( $exec_q_email->num_rows !=1 ){
                throw new Exception("El usuario no está registrado");
            }

            //comparar passwords --> login
            $user_bbdd = $exec_q_email->fetch_assoc();
            $password = $_POST['password'];

            if(!password_verify($password, $user_bbdd['password'])){
                throw new Exception("Contraseña incorrecta");
            }

            //hemos hecho login!
            $user = new User($user_bbdd);
            print_r($user);

            $user->create_session();

            return $user;
        }

        private function create_session(){
            $_SESSION['id'] = $this->id;
            $_SESSION['email'] = $this->email;
        }


        private static function validateFields(){
            if( 
                !isset($_POST['email']) ||
                !isset($_POST['password']) ||
                empty($_POST['email']) ||
                empty($_POST['password']) 
            ){
                throw new Exception("Campos obligatorios: email y password");
            }
    
            if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL ) ){
                throw new Exception("Formato de correo no válido");
            }

            if( strlen($_POST['password'])<6 ){
                throw new Exception("La contraseña debe tener mínimos 6 caracteres");
            }

            return true;
            
        }


        public static function isLogged(){
            session_start();
            if(isset($_SESSION['id'])){
                $user = new User($_SESSION);
                return $user;
            }
            return false;
        }

        public static function userLogout(){
            global $currentUser;
            if(isset($currentUser)){
                setcookie('PHPSESSID','',time()-100);
                unset($_SESSION);
                session_destroy();
            }
            return false;
        }







    }
    

?>