<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $pass  = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE login=?");
    $stmt->execute([$login]);
    $user = $stmt->fetch();

    if ($user && password_verify($pass, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['login']   = $user['login'];
        $_SESSION['role']    = $user['role'];
        $_SESSION['theme']   = $user['theme'];

        header("Location: index.php?page=dashboard");
        exit;
    } else {
        $error = "Błędny login lub hasło";
    }
}
?>

<h2>Logowanie</h2>

<form method="POST">
    <input type="text" name="login" placeholder="Login" required>
    <input type="password" name="password" placeholder="Hasło" required>
    <button type="submit">Zaloguj</button>
</form>

<p>Nie masz konta?</p>
<a href="index.php?page=register">
    <button>Zarejestruj</button>
</a>

<?php if (!empty($error)) echo "<p>$error</p>"; ?>
