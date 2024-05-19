<?php

    $port=3306;

    //Set the db you want to use
    $host="mariadb";
    $host="mysql";

    //if you want to log in as root 
    $user="root";
    $pass="passr";

    //if you want to log in as normal user
    $user="admin";
    $pass="pass";

    $database=""; // set after creation
        
    define("MAIN_DB_PORT", 3306);
    define("MAIN_DB_CHARSET", "utf8mb4");
    define("MAIN_DB_COLLATION", "utf8mb4_unicode_ci");

    $db=connectdb($host, $database, $user, $pass);

    function connectdb($host, $database, $user, $pass)
    {
        echo "<br> Connecting pdo: " . $host . ", " . $user . ", " . $pass . ", " . $database . ", " . MAIN_DB_PORT;
        $db = new database_pdo($host, $user, $pass, $database, MAIN_DB_CHARSET, MAIN_DB_COLLATION);
        if (!$db->dbConnect()) {
            echo "<br>Connection failed:";
            echo "<br>" . $db->errmsg;
            echo "<br>" . $db->errnum;
            die;
        } else {
            echo "<br>Successfully!";
            return $db;
        }
    }

    class database_pdo
    {
        private $host;
        private $user;
        private $password;
        private $charset;
        public $dbname;
        public $link;
        public $errmsg;
        public $errnum;
    
    public function __construct($host, $user, $password, $dbname, $charset)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->charset = $charset;
    }

    public function dbConnect()
    {
        $timeout = 5;
        try {
            $this->link = new PDO(
                'mysql:host=' . $this->host . ':3306;dbname=' . $this->dbname,
                $this->user,
                $this->password,
                array(
                    PDO::ATTR_TIMEOUT => $timeout,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET utf8; SET NAMES ' . $this->charset,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NUM,
                    PDO::MYSQL_ATTR_LOCAL_INFILE => 1,
                )
            );
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            $this->errmsg = $e->errorInfo[2];
            $this->errnum = $e->errorInfo[1];
            return false;
        }
        echo "<br> $this->dbname connected!";
        return $this->link;
    }
}


