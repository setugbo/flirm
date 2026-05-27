<?php require_once 'header.php'; ?>
<?php
$db = Database::getInstance();
$footer = $db->fetchOne("SELECT * FROM footer_content WHERE id = 1");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = ['about_text', 'address', 'email', 'phone', 'copyright_text'];
    $sets = [];
    foreach ($fields as $f) {
        $sets[] = "$f = '" . $db->escape($_POST[$f] ?? '') . "'";
    }
    $db->query("UPDATE footer_content SET " . implode(', ', $sets) . " WHERE id = 1");
    $success = 'Footer updated successfully.';
    $footer = $db->fetchOne("SELECT * FROM footer_content WHERE id = 1");
}
?>

<div class="admin-header">
    <h1>Footer Content</h1>
    <a href="dashboard.php" class="btn btn-black btn-sm"><i class="fas fa-arrow-left"></i> Dashboard</a>
</div>

<?php if (isset($success)): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>

<div class="card">
    <div class="card-header"><h3>Edit Footer</h3></div>
    <div class="card-body">
        <form method="POST">
            <div class="form-group">
                <label>About Text</label>
                <textarea name="about_text" style="height:80px;"><?= htmlspecialchars($footer['about_text'] ?? '') ?></textarea>
            </div>
            <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:20px;">
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" value="<?= htmlspecialchars($footer['address']) ?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($footer['email']) ?>">
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" value="<?= htmlspecialchars($footer['phone']) ?>">
                </div>
            </div>
            <div class="form-group">
                <label>Copyright Text</label>
                <input type="text" name="copyright_text" value="<?= htmlspecialchars($footer['copyright_text']) ?>">
            </div>
            <button type="submit" class="btn btn-black"><i class="fas fa-save"></i> Save Changes</button>
        </form>
    </div>
</div>

<?php require_once 'footer.php'; ?>
