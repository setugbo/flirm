<?php require_once 'header.php'; ?>
<?php
$db = Database::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current_password'] ?? '';
    $new = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    $admin = $db->fetchOne("SELECT * FROM admin_users WHERE username = '" . $db->escape($_SESSION['admin_username']) . "' LIMIT 1");

    if (!$admin || !password_verify($current, $admin['password'])) {
        $error = 'Current password is incorrect.';
    } elseif (strlen($new) < 6) {
        $error = 'New password must be at least 6 characters.';
    } elseif ($new !== $confirm) {
        $error = 'New passwords do not match.';
    } else {
        $hash = password_hash($new, PASSWORD_DEFAULT);
        $db->query("UPDATE admin_users SET password = '$hash' WHERE id = " . $admin['id']);
        $success = 'Password changed successfully.';
    }
}
?>

<div class="admin-header">
    <h1>Change Password</h1>
    <a href="dashboard.php" class="btn btn-black btn-sm"><i class="fas fa-arrow-left"></i> Dashboard</a>
</div>

<?php if (isset($success)): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>
<?php if (isset($error)): ?><div class="alert alert-error"><?= $error ?></div><?php endif; ?>

<div class="card" style="max-width:500px;">
    <div class="card-header"><h3>Update Password</h3></div>
    <div class="card-body">
        <form method="POST">
            <div class="form-group">
                <label>Current Password</label>
                <input type="password" name="current_password" required>
            </div>
            <div class="form-group">
                <label>New Password (min 6 characters)</label>
                <input type="password" name="new_password" required minlength="6">
            </div>
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="confirm_password" required minlength="6">
            </div>
            <button type="submit" class="btn btn-black"><i class="fas fa-save"></i> Change Password</button>
        </form>
    </div>
</div>

<?php require_once 'footer.php'; ?>
