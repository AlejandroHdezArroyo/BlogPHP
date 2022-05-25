<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <title> Editar artículo</title>
  </head>
  <body>


  <div class="container">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1>Editar Artículo</h1>
          <form action="" method="post" enctype="multipart/form-data">
            <label for="nombre">Título</label>
            <input class="form-control" type="text" id="titulo" name="titulo" value="<?=$article->titulo?>">

            <div class="form-group">
              
              <img src="<?=$article->getImage()?>">
              <h6><?=$article->imagen?></h6>

              <label for="formFile" class="form-label">Imagen</label>
              <input class="form-control" type="file" id="imagen" name="imagen">
            </div>

            <label for="descripcion">Texto</label>
            <textarea class="form-control" name="texto" id="texto" cols="30" rows="10"><?=$article->texto?></textarea>


            <br>
            <button class="btn btn-warning" type="submit" name="editArticle">Editar</button>

          </form>

        </div>
      </div>
    </div>

      <?php

     
      ?>
     


    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    

  </body>
</html>