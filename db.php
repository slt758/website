<?php
$host = "sql.24.svpj.link";
$db   = "db_116757";
$user = "db_116757";
$pass = "UWPwWHDw9UQNHI06";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Błąd bazy danych");
}
