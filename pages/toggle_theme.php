<?php
session_start();
require_once "../db.php"; // dopasuj ścieżkę do twojego db.php

// tylko VIP, Admin i Owner mogą przełączać motyw
$allowed_roles = ['vip', 'admin', 'owner'];

if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], $allowed_roles)) {
    header("Location: ../index.php");
    exit;
}

// obecny motyw
$current = $_SESSION['theme'] ?? 'light';

// przełącz motyw
$new = $current === 'dark' ? 'light' : 'dark';

// aktualizacja w bazie
$stmt = $pdo->prepare("UPDATE users SET theme = ? WHERE id = ?");
$stmt->execute([$new, $_SESSION['user_id']]);

// aktualizacja w sesji
$_SESSION['theme'] = $new;

// wracamy do poprzedniej strony (lub dashboard)
$ref = $_SERVER['HTTP_REFERER'] ?? '../index.php?page=dashboard';
header("Location: $ref");
exit;
