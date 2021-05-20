<?php 

    class Database {

        private $server;
        private $dbname;
        private $username;
        private $password;

        public function connection() {
            $this->server = 'localhost';
            $this->dbname = 'dbusermanagement';
            $this->username = 'root';
            $this->password = '';

            try{
                $dsn = 'mysql:host='.$this->server.';dbname='.$this->dbname;
                $pdo = new PDO($dsn, $this->username, $this->password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
            }catch(PDOException $e) {
                die('Connection Failed ' .$e->getMessage());
            }
        }

    }

?>