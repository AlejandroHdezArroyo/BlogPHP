<?php

const FOLDER = "";

  // Receptor de TODAS las peticiones
  require_once($_SERVER['DOCUMENT_ROOT'].FOLDER."/config/ini.php");

  $currentUser = User::isLogged();

  //print_r($_SESSION);

  print_r($currentUser);
  //preguntar por login...

  //conectamos a bbdd
  $connect_obj = new DBConnection();
  $connection = $connect_obj->getConnection();


  //se va a encargar de analizar rutas y hacer cosas en consecuencia
  $rc = new RouterController();
  // echo "<br><br>";
  // print_r($rc);
  // echo "<br><br>";

  $rc->manageUris();
    

?>