<?php
    class DBConnection {

        private const HOST       = "localhost";
        private const USER       = "root";
        private const PASSWORD   = "root";
        private const BBDD       = "db_proyectoPHP";
        private $connection;

        public function __construct(){
            //como las constantes son privadas se tienen que poner con self:: delante
            $conexion = mysqli_connect( self::HOST, self::USER, self::PASSWORD, self::BBDD ) or die("Hay problemas de conexión: ".mysqli_connect_error());
            
            $this->connection = $conexion;
            $this->connection->set_charset('utf8');

        }

        public function getConnection(){
            return $this->connection;
        }

        public static function connect(){
            $conexion = mysqli_connect( self::HOST, self::USER, self::PASSWORD, self::BBDD ) or die("Hay problemas de conexión: ".mysqli_connect_error());

            

            return $conexion;
        }

        


    }
    



?>