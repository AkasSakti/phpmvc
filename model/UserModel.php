<?php
class UserModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance();
    }

    public function getUserById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM pemakai WHERE id_user = :id_user");
        $stmt->bindParam(":id_user", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tambah method untuk mengambil semua data
    public function getAllUsers() {
        $stmt = $this->conn->prepare("SELECT * FROM pemakai");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>