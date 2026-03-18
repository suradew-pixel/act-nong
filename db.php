<?php
$host = "localhost";
$dbname = "nongsim_project";
$username = "root";
$password = "12345678"; // แก้เป็นรหัสผ่าน AppServ ของคุณ

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>