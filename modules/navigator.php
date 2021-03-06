<nav class="navbar navbar-dark bg-dark">
   <a class="navbar-brand" href="/home/pagina/1">Blog MVC en PHP</a>
   <ul class="nav justify-content-end">

   		<?php 
			if(!$currentUser){
		?>
				<li class="nav-item">
					<a class=" btn btn-outline-light" href="<?= FOLDER ?>/login">Login</a>
				</li>
				<li class="nav-item">
					<a class="btn btn-primary" href="<?= FOLDER ?>/signup">Registro</a>
				</li>
		<?php 
			}else{
		?>

				<li class="nav-item">
					<a class=" btn btn-outline-light" href="<?= FOLDER ?>/profile"><?=$currentUser->email?></a>
				</li>
				<li class="nav-item">
					<a class="btn btn-success" href="<?= FOLDER ?>/create">Crear Artículo</a>
				</li>
				<li class="nav-item">
					<form action="<?= FOLDER ?>/logout" method="post">
						<button class="btn btn-danger" type="submit" id="logout" name="logout">Salir</button>
					</form>
				</li>

		<?php
			}
		?>
	</ul>
</nav>

<script>
	document.getElementById("logout").addEventListener("click", function(e) {
		let confirmacion = confirm("¿Seguro que quieres salir?");
		if(!confirmacion){
		console.log("NO!");
		e.preventDefault(); // PARAR el evento de submit
	}
});
</script>

