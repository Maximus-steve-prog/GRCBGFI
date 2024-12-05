<?php
    // Require once Database file
    require_once ("Database.php");

    // Database Configuration
    class Config {

        private const USER = db_user;
        private const PASSWORD = db_password;
        private $dsn = db_type.':host='.db_host.';dbname='.db_name;
        protected $Connexion = null;

        public function __construct (){
            try{
                $this->Connexion = new PDO($this->dsn, self::USER, self::PASSWORD);
                $this->Connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            }catch (PDOException $e){
                die('error :' .$e->getMessage());
            }
        }
    }
?>