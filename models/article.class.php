<?php

    class Article extends DBConnection {
        private $id;
        private $titulo;
        private $texto;
        private $user_id;
        private $imagen;
        private $categoria;
        private $created_at;

       
        public function __construct( $params ){
            foreach ($params as $key => $value) {
                $this->$key = $value;
            }
        }

        function __get($name){
            return $this->$name;
        }

        
        public static function getByIdArt($id){
            //conectar con bbdd del
            global $connection;
            //SQL query
            $query = "SELECT * FROM Articulos WHERE id = $id";
            //ejecutar query
            $execq = $connection->query($query);

            if($connection->error){
                throw new Exception ("Error al obtener un artículo: ".$connection->error);
            }

            if($execq->num_rows != 1){
                throw new Exception ("No se encuentra al artículo");
            }

            $article_bd = $execq->fetch_assoc();

            $article = new Article($article_bd);


            return $article;            
        }


        public static function signupArt(){
            print_r($_POST);
            //1. validar campos
            if( !self::validateFields() ){
                throw new Exception("Campos no válidos");
            }

            //2.conexion
            global $connection;
            global $currentUser;
            extract($_POST);

            $query_insert_art = "INSERT INTO `Articulos`(`titulo`, `texto`, `categoria`, `user_id`) VALUES ('$titulo','$texto','$categoria', '$currentUser->id')";
            //7. ejecutar query
            $connection->query($query_insert_art);
            //8. errores... 
            if( $connection->error ){
                throw new Exception( "Error al crear artículo: ". $connection->error );
            }
            //artículo creado
        }




        private static function validateFields(){
            if( 
                !isset($_POST['titulo']) ||
                !isset($_POST['categoria']) ||
                empty($_POST['titulo']) ||
                empty($_POST['categoria']) 
            ){
                throw new Exception("Campos obligatorios: título y categoría");
            }

            return true;
            
        }

    }
    

?>