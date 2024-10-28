<?php
require_once 'UserController.php';

$userController = new UserController();
$userInfo = $userController->getUserInfo(1);

if ($userInfo) {
    echo "NIM: " . $userInfo['nim'] . "<br>";
    echo "Nama: " . $userInfo['nama'] . "<br>";
    echo "Email: " . $userInfo['email'];
} else {
    echo "Pengguna tidak ditemukan.";
}
?>
