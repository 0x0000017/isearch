<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset = utf-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, X-Auth-User");

date_default_timezone_set("Asia/Manila");

define("SERVER", "localhost");
define("DBASE", "isearch_db");
define("USER", "root");
define("PASSWORD", "");
// define("TOKEN_KEY", "9f0124bf5124b4e1140b70f070806120d2e8e44d43f926f88681db3f2aa98d59");
// define("SECRET_KEY", "WebDevelopmentDemo");

    class Database{
        //DB params
        protected $conString = "mysql:host=".SERVER.";dbname=".DBASE.";charset=utf8mb4";
        protected $options = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, \PDO::ATTR_EMULATE_PREPARES => false];


        //DB connect
        public function connect(){
            try{
                return new \PDO($this->conString, USER, PASSWORD, $this->options);
            }
            catch(PDOException $e){
                echo 'Connection Error: ' . $e->getMessage();
            }
        }



    }