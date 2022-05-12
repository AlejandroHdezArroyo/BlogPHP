
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <title>Creación artículo</title>
  </head>
  <body>

  <h1>Nuevo Artículo</h1>
  <div class="container-fluid">
  
      <div class="row justify-content-center fila">
      
        <div class="col-6">
          <form action="" method="POST">
            <div class="form-group">
              <label for="Titulo">Título</label>
              <input type="text" class="form-control" id="Titulo" name="Titulo" placeholder="Título">
            </div>
            <div class="form-group">
              <label for="Texto">Texto</label>
              <textarea class="form-control" id="texto" name="texto" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="formFile" class="form-label">Imagen</label>
              <input class="form-control" type="file" id="imagen" name="imagen">
            </div>
            <div class="form-group">
                <select class="form-select">
                    <option selected>Categoría</option>
                    <option value="1">Uno</option>
                    <option value="2">Dos</option>
                    <option value="3">Tres</option>
                </select>
            </div>



            <button type="submit" class="btn btn-success" name="action" value="create">Publicar</button>
          </form> 
        </div>
      </div>

    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    

  </body>
</html>