<?php
session_start();
include "koneksi.php";

// Cek login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Cek apakah role-nya admin
if ($_SESSION['role'] != 'admin') {
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Akses Ditolak</title>
        <style>
      body {
    background-color: #0f0a24; /* latar galaksi */
    font-family: Georgia, serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.error-box {
    background: linear-gradient(135deg, #1a1446, #2c1e77, #3e278f); /* gradasi ungu-biru gelap */
    padding: 30px;
    border: 2px solid #5e35b1; /* ungu terang serasi */
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 0 25px rgba(94, 53, 177, 0.4);
    max-width: 400px;
    color: #ffffff;
}

h3 {
    color: #ffe96a; /* kuning terang agar jelas */
    margin-bottom: 20px;
    font-size: 22px;
    text-shadow: 0 0 4px #ffef9d;
}

a {
    display: inline-block;
    padding: 10px 15px;
    background: linear-gradient(to right, #00c9ff, #92fe9d);
    color: #ffffffff;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    font-family: Georgia, serif;
}

a:hover {
    background: linear-gradient(to right, #92fe9d, #00c9ff);
    transform: scale(1.05);
}
        </style>
    </head>
    <body>
        <div class="error-box">
            <h3>Akses ditolak. Hanya admin yang dapat mengakses halaman ini.</h3>
            <a href="welcome.php">Kembali</a>
        </div>
    </body>
    </html>';
    exit();
}

// Ambil semua user
$sql = "SELECT * FROM data2";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manajemen User</title>
    <style>
       body {
    background-color: #0f0a24;
    font-family: 'Georgia', serif;
    margin: 0;
    padding: 20px;
}

h2 {
    text-align: center;
    color: #ffe96a;
    text-shadow: 0 0 4px #ffef9d;
}

table {
    margin: 0 auto;
    border-collapse: collapse;
    width: 80%;
    background: linear-gradient(135deg, #1a1446, #2c1e77, #431b9a);
    box-shadow: 0 0 20px rgba(94, 53, 177, 0.4);
    border-radius: 10px;
    overflow: hidden;
}

th, td {
    border: 1px solid #5e35b1;
    padding: 10px;
    text-align: center;
    color: #ffffff;
}

th {
    background-color: #2a1e52;
    color: #ffe96a;
    font-weight: bold;
}

td {
    background-color: rgba(255, 255, 255, 0.05);
}

a {
    margin: 0 5px;
    padding: 6px 12px;
    background: linear-gradient(to right, #00c9ff, #92fe9d);
    color: #0f0a24;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
}

a:hover {
    background: linear-gradient(to right, #92fe9d, #00c9ff);
    color: #ffffff;
    transform: scale(1.05);
}

a.delete {
    background: linear-gradient(to right, #ff4e00, #ff9500);
    color: white;
}

a.delete:hover {
    background: linear-gradient(to right, #ff9500, #ff4e00);
    transform: scale(1.05);
}

.back-link {
    display: block;
    text-align: center;
    margin-top: 20px;
}

.back-link a {
    background: linear-gradient(to right, #5e35b1, #7c4dff);
    color: white;
    padding: 10px 15px;
    font-weight: bold;
}

.back-link a:hover {
    background: linear-gradient(to right, #7c4dff, #5e35b1);
    color: #ffe96a;
}
    </style>
</head>
<body>
    <h2>Daftar Pengguna</h2>
    <table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th> 
        <th>Role</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) : ?>
    <tr>
        <td><?= $row['id']; ?></td>
        <td><?= htmlspecialchars($row['username']); ?></td>
        <td><?= htmlspecialchars($row['email']); ?></td> 
        <td><?= htmlspecialchars($row['role']); ?></td>
        <td>
            <a href="user_edit.php?id=<?= $row['id']; ?>">Edit</a>
            <a href="user_delete.php?id=<?= $row['id']; ?>" class="delete" onclick="return confirm('Hapus user ini?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
    <div class="back-link">
        <a href="admin_dashboard.php">Kembali</a>
    </div>
</body>
</html>