<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $pass  = $_POST['password'];

    if ($login && $email && $pass) {
        $hash = password_hash($pass, PASSWORD_BCRYPT);

        $stmt = $pdo->prepare(
            "INSERT INTO users (login,email,password) VALUES (?,?,?)"
        );

        try {
            $stmt->execute([$login,$email,$hash]);
            header("Location: index.php?page=login");
            exit;
        } catch (PDOException $e) {
            $error = "Login lub email już istnieje";
        }
    }
}
?>

<h2>Rejestracja</h2>

<form method="POST">
    <input type="text" name="login" placeholder="Login" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Hasło" required>
    <button type="submit">Utwórz konto</button>
</form>

<a href="index.php?page=login">← Wróć do logowania</a>

<?php if (!empty($error)) echo "<p>$error</p>"; ?>
