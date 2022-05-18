<!DOCTYPE html>
<html>
<head>
	<title> Blog de PHP </title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<meta charset="utf-8">

</head>
<body>
	<?php
		require_once($_SERVER['DOCUMENT_ROOT']."/modules/navigator.php");

	?>

	<!-- POST -->
	<div class="container page post">
		<div class="row justify-content-center">
			<span><?=$article->creado_en;?></span>
		</div>

		
			<img src="/assets/imgs/blog_default.png">
		

			<h1><?= $article->titulo; ?></h1>
			<div class="body_post">
				<p><?= $article->texto; ?></p>
			</div>
		<div class="row justify-content-end">
			<div class="col-6">
			<!-- <?= $user->name; ?> -->
			</div>
			
		</div>

		<?php
			if($currentUser && $currentUser->id == $article->user_id){
		?>
			<form action="/deleteArticle" method="post">
        		<button class="btn btn-danger" name="borrarArt" value="<?=$article->id?>"> Borrar </button>
      		</form>

			<a class="btn btn-warning" href="<?= FOLDER ?>/editArticle/<?=$article->id?>">Editar</a>

			  <!-- <form action="/editArticle" method="post">
        		<button class="btn btn-warning" name="editarArt" value="<?=$article->id?>"> Editar </button>
      		</form> -->
		<?php
			}
		?>
	</div>

	<!-- FOOTER -->
	<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/modules/footer.php");

	?>
</body>
</html>