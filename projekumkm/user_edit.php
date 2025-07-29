<?php
session_start();
include "koneksi.php";

// Cek login dan role admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

// Ambil ID user yang mau diedit
if (!isset($_GET['id'])) {
    header("Location: user_show.php");
    exit();
}

$id = $_GET['id'];

// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email']; 
    $role = $_POST['role'];
    $password = $_POST['password'];

    if (!empty($password)) {
        // Hash password baru
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
       $sql = "UPDATE data2 SET username=?, email=?, password=?, role=? WHERE id=?";
       $stmt = $conn->prepare($sql);
       $stmt->bind_param("ssssi", $username, $email, $hashed_password, $role, $id);
    } else {
        // Update tanpa ubah password
        $sql = "UPDATE data2 SET username=?, email=?, role=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $email, $role, $id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('User berhasil di update!'); window.location='user_show.php';</script>";
        exit();
    } else {
        echo "<script>alert('Gagal mengupdate user');</script>";
    }
}

// Ambil data user lama
$sql = "SELECT * FROM data2 WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows != 1) {
    echo "<script>alert('User tidak ditemukan'); window.location='user_show.php';</script>";
    exit();
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit user</title>
    <style>
       body {
    background-color: #0f0a24; 
    font-family: Georgia, serif;
    margin: 0;
    padding: 20px;
}

.form-container {
    max-width: 500px;
    margin: 40px auto;
    background: linear-gradient(135deg, #1a1446, #2c1e77, #3e278f); 
    padding: 30px;
    border-radius: 15px;
    border: 2px solid #5e35b1;
    box-shadow: 0 0 25px rgba(94, 53, 177, 0.3);
    color: #ffffff;
}

h2 {
    text-align: center;
    color: #ffe96a;
    text-shadow: 0 0 4px #ffef9d;
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #ffe96a;
}

input[type="text"],
input[type="password"],
input[type="email"],
select {
    width: 95%;
    padding: 10px;
    margin-bottom: 12px;
    border: 1px solid #4a23abff;
    border-radius: 5px;
    background-color: rgba(255, 0, 0, 0.05); 
    font-family: Georgia, serif;
    color: #ffffff; 
}

input::placeholder {
    color: #c7bfff;
}

.btn {
    background: linear-gradient(to right, #00c9ff, #92fe9d);
    color: #0f0a24;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
    font-family: Georgia, serif;
}

.btn:hover {
    background: linear-gradient(to right, #92fe9d, #00c9ff);
    color: #ffffff;
    transform: scale(1.05);
}

.back-link {
    text-align: center;
    margin-top: 20px;
}

.back-link a {
    text-decoration: none;
    background: linear-gradient(to right, #5e35b1, #7c4dff);
    color: white;
    padding: 8px 15px;
    border-radius: 5px;
    font-weight: bold;
}

.back-link a:hover {
    background: linear-gradient(to right, #7c4dff, #5e35b1);
    color: #ffe96a;
}
    </style>

</head>
<body>
<div class="form-container">
    <h2>Edit User</h2>
    <form method="post">
        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
<br><br>
        <label>Username:</label>
        <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
<br><br>
        <label>Password Baru:</label>
        <input type="password" name="password">
<br><br>
        <label>Role:</label>
        <select name="role" required>
            <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>
<br><br>
        <button type="submit" class="btn">Update</button>
</form>
    <div class="back-link"><br>
        <a href="user_show.php">Kembali</a>
    </div>
</div>
</body>
</html>