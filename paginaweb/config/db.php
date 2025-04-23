<?php
$host = 'sql100.infinityfree.com'; // Cambiar por tu host de InfinityFree
$db   = 'if0_38808168_plataforma_educativa'; // Cambiar por tu nombre de BD
$user = 'if0_38808168'; // Cambiar por tu usuario
$pass = 'chZzVKdocj'; // Cambiar por tu contraseña
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>