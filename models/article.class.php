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
            //print_r($_FILES);
            //print_r($_POST);
            //1. validar campos
            if( !self::validateFields() ){
                throw new Exception("Campos no válidos");
            }

            //2.conexion
            global $connection;
            global $currentUser;
            extract($_POST);

            $imagen = $_FILES['imagen']['name'];
            //meter en la query 'imagen'

            $query_insert_art = "INSERT INTO `Articulos`(`titulo`, `texto`, `categoria`, `user_id`, `imagen`) VALUES ('$titulo','$texto','$categoria', '$currentUser->id', '$imagen')";
            //7. ejecutar query
            $connection->query($query_insert_art);
            //8. errores... 
            if( $connection->error ){
                throw new Exception( "Error al crear artículo: ". $connection->error );
            }
            //artículo creado
            $idArt = $connection->insert_id;

            self::save_file($idArt);

            return $idArt;
        }

        public function shortDescription(){
            return substr($this->texto, 0, 100)."...";
        }


        public static function save_file($idArt){
            $path = FOLDER."uploads/";
            $file = $_FILES['imagen'];
            if(!file_exists($path)){
                mkdir($path);
            }
            $path .= "post_".$idArt;
            if(!file_exists($path)){
                mkdir($path);
            }
            $image_temp =  $file['tmp_name'];
            $filename =  $file['name'];
            move_uploaded_file($image_temp, $path."/".$filename);

        }


        public function getImage(){
            return $this->imagen ? FOLDER."/uploads/post_".$this->id."/".$this->imagen : FOLDER."/assets/imgs/blog_default.png";
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

            self::deleteImage($id);
        }

        public static function deleteImage($id){
            $folder = $_SERVER["DOCUMENT_ROOT"].FOLDER."/uploads/post_".$id;
            $contenido = scandir($folder);
            foreach ($contenido as $pos => $file) {
                if($pos != 0 && $pos !=1){
                    unlink($folder."/".$file);
                }
            }

            rmdir($folder);
        }

        public static function editarArt($id){
            global $currentUser;
            extract($_POST);
            $article = Article::getByIdArt($id);
            if($currentUser && $currentUser->id == $article->user_id && isset($_POST['editArticle'])){
                global $connection;
                $imagen = $_FILES['imagen']['name'];

                $q_update_art = "UPDATE `Articulos` SET `titulo`='$titulo',`texto`='$texto',`imagen`='$imagen' WHERE id = $id";

                $connection->query($q_update_art);

                if( $connection->error ){
                    throw new Exception( "Error al editar artículo: ". $connection->error );
                }



                $folder = $_SERVER["DOCUMENT_ROOT"].FOLDER."/uploads/post_".$id;
                $contenido = scandir($folder);
                foreach ($contenido as $pos => $file) {
                    if($pos != 0 && $pos !=1){
                        unlink($folder."/".$file);
                    }
                }

                self::save_file($id);




            }
        }


        public static function list($pages){
            global $connection;
            $articulosPagina = 4;
            $offset = ($pages -1) * $articulosPagina;

            $query_paginacion_art = "SELECT * FROM `Articulos` WHERE 1 LIMIT $articulosPagina OFFSET $offset";

            $query_listado_art = "SELECT * FROM `Articulos` WHERE 1";

            $execqQueryPages = $connection->query($query_paginacion_art);

            $execQueryArt = $connection->query($query_listado_art);
            

            if( $connection->error ){
                throw new Exception( "Error al cargar artículos: ". $connection->error );
            }

            $paginasArticulos = $execqQueryPages->fetch_all(MYSQLI_ASSOC);

            $articles = [];
            foreach ($paginasArticulos as $article) {
                $article_obj = new Article($article);
                array_push($articles, $article_obj);
            }


            $paginas = $execQueryArt->num_rows/$articulosPagina;
            $paginas = ceil($paginas);
            
            $result = [
                "data" => $articles,
                "pages" => $paginas,
            ];

            return $result;

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

            //crear validaciones imagenes

            if($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" ||$_FILES['imagen']['type'] == "image/png" || $_FILES['imagen']['type'] == "image/gif"){
                return true;
            }
            
            throw new Exception("Formato de imagen no válido");
        }

    }
    

?>