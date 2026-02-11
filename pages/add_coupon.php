<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stake   = (float)$_POST['stake'];
    $odds    = (float)$_POST['odds'];
    $matches = (int)$_POST['matches'];
    $last    = $_POST['last_match'];

    if ($stake > 0 && $odds > 0 && $matches > 0 && $last) {
        $potential = $stake * $odds;

        $stmt = $pdo->prepare("
            INSERT INTO coupons 
            (user_id, stake, odds, matches, last_match, potential_win)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $_SESSION['user_id'],
            $stake,
            $odds,
            $matches,
            $last,
            $potential
        ]);

        header("Location: index.php?page=dashboard");
        exit;
    } else {
        $error = "Wypełnij poprawnie wszystkie pola";
    }
}
?>

<h2>Dodaj kupon</h2>

<form method="POST" id="couponForm">
    <input type="number" step="0.01" name="stake" id="stake" placeholder="Stawka (zł)" required>
    <input type="number" step="0.01" name="odds" id="odds" placeholder="Kurs całkowity" required>
    <input type="number" name="matches" placeholder="Ilość meczy" required>
    <input type="datetime-local" name="last_match" required>

    <p>Możliwa wygrana: <strong><span id="win">0.00</span> zł</strong></p>

    <button type="submit">Dodaj kupon</button>
</form>

<?php if (!empty($error)) echo "<p>$error</p>"; ?>
