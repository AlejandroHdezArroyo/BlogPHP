<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?=FOLDER?>/assets/css/style.css">

    <title>Home</title>
</head>
<body>
    <?php
	    require_once($_SERVER['DOCUMENT_ROOT'].FOLDER."/modules/navigator.php");
    ?>
    
    <h1> Soy la HOME</h1>

    <div>
    <?php
        foreach ($articulos as $orden => $datos) {
    ?>
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="/assets/imgs/blog_default.png" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><?= $datos['titulo']?></h5>
            <p class="card-text"><?= $datos['texto']?></p>
            <a href="<?=FOLDER?>/article/<?=$datos['id']?>" class="btn btn-primary">Ver artículo</a>
        </div>
    </div>
    <?php
        }
    ?>
    </div>
    
    

    <!-- FOOTER -->
  	<?php
	    require_once($_SERVER['DOCUMENT_ROOT'].FOLDER."/modules/footer.php");
	?>
    
</body>
</html>