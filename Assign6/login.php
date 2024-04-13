<?php
$host = 'localhost';
$db   = 'mydatabase';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$email = $_POST['Email'];
$password = $_POST['Password'];

$stmt = $pdo->prepare("SELECT shop_id, name, address FROM Shopkeeper WHERE email = ? AND password = ?");
$stmt->execute([$email, $password]);
$user = $stmt->fetch();

if ($user) {
    setcookie("address", $user['address'], time() + 3600, "/"); 
    setcookie("name", $user['name'], time() + 3600, "/");
    setcookie("shop_id", $user['shop_id'], time() + 3600, "/");
    echo '<script>window.location.href = "../2 Selected shop/index.php";</script>';
} else {
    echo "Incorrect Email or Password";
}

?>
