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
            $query = "SELECT * FROM `Articulos` WHERE id = $id";
            //echo $query;
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
            //print_r($_POST);
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
            $idArt = $connection->insert_id;
            return $idArt;
        }

        public static function borradoArt(){
            global $currentUser;
            if($currentUser && isset($_POST['borrarArt'])){
                global $connection;
                $id = $_POST['borrarArt'];
    
                $q_delete_art = "DELETE FROM `Articulos` WHERE id = $id";
    
                $connection->query($q_delete_art);

                if( $connection->error ){
                    throw new Exception( "Error al borrar artículo: ". $connection->error );
                }
            }
        }

        public static function editarArt(){
            global $currentUser;
            global $article;
            if($currentUser){
                global $connection;
                $id = $article->id;

                $qArt = "SELECT * FROM `Articulos` WHERE id = $id";

                $execqArt = $connection->query($qArt);

                // if($connection->error){
                //     throw new Exception ("Error al editar un artículo: ".$connection->error);
                // }
                $article_bd = $execqArt->fetch_all(MYSQLI_ASSOC);
            }
        }


        public static function list(){
            global $connection;

            $query_listado_art = "SELECT * FROM `Articulos` WHERE 1";

            $execQueryArt = $connection->query($query_listado_art);

            if( $connection->error ){
                throw new Exception( "Error al cargar artículos: ". $connection->error );
            }

            $datosArticulos = $execQueryArt->fetch_all(MYSQLI_ASSOC);
            return $datosArticulos;

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