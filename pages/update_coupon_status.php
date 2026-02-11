<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $coupon_id = (int)$_POST['coupon_id'];
    $status = $_POST['status'];

    if (in_array($status, ['won','lost'])) {
        $stmt = $pdo->prepare("
            UPDATE coupons 
            SET status = ?
            WHERE id = ? AND user_id = ?
        ");
        $stmt->execute([$status, $coupon_id, $_SESSION['user_id']]);
    }
}

header("Location: index.php?page=dashboard");
exit;
