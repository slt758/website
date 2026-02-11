<?php
// =====================================
// USTAWIENIE ZAKRESU
// =====================================
$range = $_GET['range'] ?? 'month';

switch ($range) {
    case 'week':
        $from = date('Y-m-d H:i:s', strtotime('-7 days'));
        break;
    case 'year':
        $from = date('Y-m-d H:i:s', strtotime('-1 year'));
        break;
    case 'all':
        $from = '1970-01-01 00:00:00'; // Wszystko od początku
        break;
    default:
        $from = date('Y-m-d H:i:s', strtotime('-1 month'));
        $range = 'month';
}

// =====================================
// POBRANIE STATYSTYK DLA UŻYTKOWNIKA
// =====================================
$userId = $_SESSION['user_id'];

// OBSTAWIONE
$stmt = $pdo->prepare("
    SELECT COALESCE(SUM(stake),0) 
    FROM coupons 
    WHERE user_id = ? AND created_at >= ?
");
$stmt->execute([$userId, $from]);
$staked = $stmt->fetchColumn();

// WYGRANE
$stmt = $pdo->prepare("
    SELECT COALESCE(SUM(potential_win),0)
    FROM coupons
    WHERE user_id = ? AND status = 'won' AND created_at >= ?
");
$stmt->execute([$userId, $from]);
$won = $stmt->fetchColumn();

// PRZEGRANE
$stmt = $pdo->prepare("
    SELECT COALESCE(SUM(stake),0)
    FROM coupons
    WHERE user_id = ? AND status = 'lost' AND created_at >= ?
");
$stmt->execute([$userId, $from]);
$lost = $stmt->fetchColumn();

$balance = $won - $lost;
?>

<h2>Statystyki</h2>

<!-- ================= STATS NAV ================= -->
<div class="stats-nav">
    <a href="index.php?page=stats&range=week" class="<?= $range === 'week' ? 'active' : '' ?>">Tydzień</a>
    <a href="index.php?page=stats&range=month" class="<?= $range === 'month' ? 'active' : '' ?>">Miesiąc</a>
    <a href="index.php?page=stats&range=year" class="<?= $range === 'year' ? 'active' : '' ?>">Rok</a>
    <a href="index.php?page=stats&range=all" class="<?= $range === 'all' ? 'active' : '' ?>">Wszystko</a>
</div>

<!-- ================= STAT BOXES ================= -->
<div class="stats-boxes">

    <div class="box">
        <h3>Obstawione</h3>
        <p><?= number_format($staked,2) ?> zł</p>
    </div>

    <div class="box">
        <h3>Wygrane</h3>
        <p class="green"><?= number_format($won,2) ?> zł</p>
    </div>

    <div class="box">
        <h3>Przegrane</h3>
        <p class="red"><?= number_format($lost,2) ?> zł</p>
    </div>

    <div class="box">
        <h3>Bilans</h3>
        <p class="<?= $balance >= 0 ? 'green' : 'red' ?>">
            <?= number_format($balance,2) ?> zł
        </p>
    </div>

</div>
