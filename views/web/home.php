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
    
    <h1 class="ml-3 my-5 page-title"> Soy la HOME</h1>
    <div class="mx-auto d-flex flex-wrap">
        <?php
            foreach ($articulos as $orden => $datos) {
                require($_SERVER['DOCUMENT_ROOT'].FOLDER."/modules/card.php");
            }
        ?>
    </div>

    

    <nav aria-label="Page navigation example">
        <ul class="ml-3 pagination">

            <?php
                if($pages>=2){
            ?>
                <li class="page-item"><a class="page-link" href="<?=FOLDER?>/home/pagina/<?=$pages - 1?>">Anterior</a></li>
            <?php
                }
            ?>
                <?php
                    for ($i=0; $i < $paginas; $i++) {
                ?>
                        <li class="page-item
                            <?php
                                if($pages == $i+1){
                                    echo "active";
                                }
                            ?>
                        ">
                        <a class="page-link" href="<?=FOLDER?>/home/pagina/<?=$i+1?>">
                            <?=$i+1?>
                        </a></li>
                <?php
                    }
                ?>

                <?php
                    if($pages!=$paginas){
                ?>
                    <li class="page-item"><a class="page-link" href="<?=FOLDER?>/home/pagina/<?=$pages + 1?>">Siguiente</a></li>
                 <?php
                    }
                ?>
           
        </ul>
    </nav>
    
    

    <!-- FOOTER -->
  	<?php
	    require_once($_SERVER['DOCUMENT_ROOT'].FOLDER."/modules/footer.php");
	?>
    
</body>
</html>