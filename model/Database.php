<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "cobaan";
    private static $instance = null;
    private $conn;

    // Constructor dibuat public agar bisa digunakan untuk semua versi
    public function __construct() {
        // Kosongkan constructor agar bisa digunakan untuk semua versi
    }

    // Versi 1: Menggunakan mysqli dengan if-else
    public function connectMysqli() {
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);
        
        if ($this->conn) {
            return $this->conn;
        } else {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    // Versi 2: Menggunakan PDO dengan try-catch
    public function connectPDO() {
        try {
            $this->conn = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname", 
                $this->username, 
                $this->password,
                array(PDO::ATTR_PERSISTENT => true)
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $this->conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Versi 3: Menggunakan PDO dengan Singleton Pattern
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
            try {
                self::$instance->conn = new PDO(
                    "mysql:host=" . self::$instance->host . 
                    ";dbname=" . self::$instance->dbname . 
                    ";charset=utf8mb4", 
                    self::$instance->username, 
                    self::$instance->password,
                    array(
                        PDO::ATTR_PERSISTENT => true,
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
                    )
                );
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return self::$instance->conn;
    }

    // Method untuk menutup koneksi
    public function closeConnection() {
        $this->conn = null;
        self::$instance = null;
    }
}

// Cara penggunaan (pilih salah satu):
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    try {
        // 1. Menggunakan mysqli if-else untuk projek kecil
        //$db = new Database();
        //$conn = $db->connectMysqli();
        
        // 2. Menggunakan PDO biasa
        $db = new Database();
        $conn = $db->connectPDO();
        
        // 3. Menggunakan Singleton Pattern untuk projek besar
        //$conn = Database::getInstance();
        
        echo "Database connection successful!";
        
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
