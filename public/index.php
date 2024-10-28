<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load semua file yang diperlukan
require_once __DIR__ . '/../model/Database.php';
require_once __DIR__ . '/../model/UserModel.php';
require_once __DIR__ . '/../controller/UserController.php';

// Buat instance controller
$userController = new UserController();

// Ambil semua data
$users = $userController->getAllUsers();

// Tampilkan data dalam bentuk tabel
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pemakai</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Data Pemakai</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>NIM</th>
            <th>Nama</th>
        </tr>
        <?php foreach($users as $user): ?>
        <tr>
            <td><?php echo $user['id_user']; ?></td>
            <td><?php echo $user['nim']; ?></td>
            <td><?php echo $user['nama']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
