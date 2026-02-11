<?php
session_start();
require_once "db.php";

$page = $_GET['page'] ?? 'login';

$public = ['login','register'];

if (!in_array($page, $public) && !isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login");
    exit;
}

include "includes/header.php";

if (isset($_SESSION['user_id'])) {
    include "includes/navbar.php";
}

switch ($page) {
    case 'login':
        include "pages/login.php";
        break;

    case 'register':
        include "pages/register.php";
        break;

    case 'dashboard':
        include "pages/dashboard.php";
        break;

    case 'add_coupon':
        include "pages/add_coupon.php";
        break;

    case 'update_coupon_status':
        include "pages/update_coupon_status.php";
        break;
    
    case 'stats':   // <-- TU musi być
        include "pages/stats.php";
    break;

    case 'logout':
        include "pages/logout.php";
        break;

    default:
        echo "404";
}

include "includes/footer.php";
