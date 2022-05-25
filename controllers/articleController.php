<?php

class ArticleController{

    public function __construct( )
    {   
        
    }

    public function show( $id ){
        global $currentUser;

        try {
            //ir a por el usuario nº1
            $article = Article::getByIdArt($id);
            //print_r($article);

            //cargar la vista del articulo
            require_once($_SERVER['DOCUMENT_ROOT'].FOLDER."/views/post/show.php");
            
        } catch (\Throwable $th) {
            echo "ERROR: ".$th->getMessage();
        }

    }

    public function createArt(){
        try {
            $idArt = Article::signupArt();

            //header("Location: ".FOLDER."/article/$idArt");

        } catch (\Throwable $th) {
            echo "ERROR: ".$th->getMessage();
        }
    }


   public function deleteArt(){
       try {
            Article::borradoArt();

            //echo "Artículo borrado";
            //header("Location: ".FOLDER."/");
       } catch (\Throwable $th) {
            echo "ERROR: ".$th->getMessage();
       }
   }

   public function editArt($id){
       try {
           //echo "HEMOS LLEGADO";
           Article::editarArt($id);
       } catch (\Throwable $th) {
            echo "ERROR: ".$th->getMessage();
       }
   }

}


?>