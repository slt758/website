<nav>
    <a href="index.php?page=dashboard">Panel</a>
    <a href="index.php?page=add_coupon">Dodaj kupon</a>
    <a href="index.php?page=stats">Statystyki</a>
    <a href="index.php?page=logout" id="wyloguj">Wyloguj</a>

    <?php 
    $allowed_roles = ['vip', 'admin', 'owner'];
    if (isset($_SESSION['role']) && in_array($_SESSION['role'], $allowed_roles)): 
    ?>
        <a href="pages/toggle_theme.php">
            <?= ($_SESSION['theme'] ?? 'light') === 'dark' ? '🌞 Jasny' : '🌙 Ciemny' ?>
        </a>
    <?php endif; ?>
</nav>
