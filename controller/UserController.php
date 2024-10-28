<?php
class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function getUserInfo($id) {
        return $this->userModel->getUserById($id);
    }

    // Tambah method untuk mengambil semua data
    public function getAllUsers() {
        return $this->userModel->getAllUsers();
    }
}
?>
