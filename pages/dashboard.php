<?php
// OSTATNI KUPON
$stmt = $pdo->prepare("
    SELECT * FROM coupons 
    WHERE user_id = ? 
    ORDER BY created_at DESC 
    LIMIT 1
");
$stmt->execute([$_SESSION['user_id']]);
$last = $stmt->fetch();

// HISTORIA
$stmt = $pdo->prepare("
    SELECT * FROM coupons 
    WHERE user_id = ? 
    ORDER BY created_at DESC
");
$stmt->execute([$_SESSION['user_id']]);
$coupons = $stmt->fetchAll();
?>

<h2>Panel główny</h2>

<div class="dashboard">

    <div class="left">
        <h3>Ostatni kupon</h3>

        <?php if ($last): ?>
            <p>Stawka: <?= $last['stake'] ?> zł</p>
            <p>Kurs: <?= $last['odds'] ?></p>
            <p>Mecze: <?= $last['matches'] ?></p>
            <p>Wygrana: <?= $last['potential_win'] ?> zł</p>
            <p>Ostatni mecz: <?= $last['last_match'] ?></p>
            <p>Status: <?= $last['status'] ?></p>
        <?php else: ?>
            <p>Brak kuponów</p>
        <?php endif; ?>
    </div>

    <div class="right">
        <h3>Historia kuponów</h3>

        <?php if ($coupons): ?>
        <table>
            <tr>
                <th>Data</th>
                <th>Stawka</th>
                <th>Kurs</th>
                <th>Wygrana</th>
                <th>Status</th>
            </tr>

            <?php foreach ($coupons as $c): ?>
            <tr>
                <td><?= $c['created_at'] ?></td>
                <td><?= $c['stake'] ?> zł</td>
                <td><?= $c['odds'] ?></td>
                <td><?= $c['potential_win'] ?> zł</td>
                <td>

                <?php if ($c['status'] === 'pending'): ?>
                    <form method="POST" action="index.php?page=update_coupon_status">
                        <input type="hidden" name="coupon_id" value="<?= $c['id'] ?>">
                        <select name="status" onchange="this.form.submit()">
                            <option value="">Oczekuje</option>
                            <option value="won">✅ Wygrany</option>
                            <option value="lost">❌ Przegrany</option>
                        </select>
                    </form>
                <?php else: ?>
                    <?= $c['status'] === 'won' ? '✅ Wygrany' : '❌ Przegrany' ?>
                <?php endif; ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php else: ?>
            <p>Brak historii</p>
        <?php endif; ?>
    </div>

</div>
