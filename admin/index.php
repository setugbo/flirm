<?php
require_once dirname(__DIR__) . '/includes/config.php';
require_once dirname(__DIR__) . '/includes/db.php';

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'Please enter username and password.';
    } else {
        $db = Database::getInstance();
        $user = $db->fetchOne("SELECT * FROM admin_users WHERE username = '" . $db->escape($username) . "' LIMIT 1");

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $user['username'];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Invalid username or password.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - FLIRM SOLICITORS</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body class="login-page">
    <div class="login-box">
        <div class="login-logo">FLIRM <span>Admin</span></div>
        <div class="login-sub">FLIRM SOLICITORS Control Panel</div>
        <h2>Sign In</h2>

        <?php if ($error): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required placeholder="Enter username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="Enter password">
            </div>
            <button type="submit" class="btn btn-black btn-block">Sign In</button>
        </form>
    </div>
</body>
</html>
