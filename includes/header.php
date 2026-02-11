<?php
// Ustawienie motywu z sesji (jeśli brak, użyj light)
$theme_class = ($_SESSION['theme'] ?? 'light') === 'dark' ? 'dark-mode' : 'light-mode';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>21 WEBSITE PZDR</title>
    <link rel="stylesheet" href="assets/css/style.css">
  	<script src="assets/js/app.js"></script>
  	<link rel="icon" href="/favicon.png">
</head>
<body class="<?= $theme_class ?>">
