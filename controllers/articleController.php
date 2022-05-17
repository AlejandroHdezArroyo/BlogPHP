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

            header("Location: ".FOLDER."/article/$idArt");

        } catch (\Throwable $th) {
            echo "ERROR: ".$th->getMessage();
        }
    }

}




// $query = "SELECT * FROM article, user WHERE article.id = $id AND article.user_id = user.id";
?>