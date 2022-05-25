    <div class="ml-3 mb-5 card" style="width: 18rem;">
        <img class="card-img-top" src="<?=$datos->getImage()?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><?= $datos->titulo?></h5>
            <p class="card-text"><?= $datos->shortDescription()?></p>
            <a href="<?=FOLDER?>/article/<?=$datos->id?>" class="btn btn-primary">Ver artículo</a>
        </div>
    </div>
