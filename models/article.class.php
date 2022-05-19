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
            // $query = "SELECT * FROM `Articulos` WHERE id = $id";
            $query = "SELECT `Articulos`.`id`, `Articulos`.`titulo`, `Articulos`.`texto`, `Articulos`.`user_id`, `Articulos`.`imagen`, `Articulos`.`categoria`, `Articulos`.`creado_en`, `user`.`nombre`, `user`.`apellidos` FROM `Articulos`, `user` WHERE `Articulos`.`id` = $id AND `Articulos`.`user_id` = `user`.`id`";
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
            $id = $_POST['borrarArt'];
            $article = Article::getByIdArt($id);
            if($currentUser && $currentUser->id == $article->user_id && isset($_POST['borrarArt'])){
                global $connection;
    
                $q_delete_art = "DELETE FROM `Articulos` WHERE id = $id";
    
                $connection->query($q_delete_art);

                if( $connection->error ){
                    throw new Exception( "Error al borrar artículo: ". $connection->error );
                }
            }
        }

        public static function editarArt($id){
            global $currentUser;
            extract($_POST);
            $article = Article::getByIdArt($id);
            if($currentUser && $currentUser->id == $article->user_id && isset($_POST['editArticle'])){
                global $connection;

                $q_update_art = "UPDATE `Articulos` SET `titulo`='$titulo',`texto`='$texto' WHERE id = $id";

                $connection->query($q_update_art);

                if( $connection->error ){
                    throw new Exception( "Error al editar artículo: ". $connection->error );
                }

                echo $q_update_art;
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