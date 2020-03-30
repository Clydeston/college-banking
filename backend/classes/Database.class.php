
<?php 
    class Database {
        // database information only accessible from this class
        private $host = "localhost"; 
        private $user = "root";
        private $pass = "";
        private $db_name = "banking";

        public function connect() {
            // creating db connection
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name;
            $pdo = new PDO($dsn, $this->user, $this->pass);

            // setting PDO attributes - fetch mode -> fetching associative arrays 
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        }
    }
?>