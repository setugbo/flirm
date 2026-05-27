<?php require_once 'header.php'; ?>
<?php
$db = Database::getInstance();
$settings = $db->fetchOne("SELECT * FROM site_settings WHERE id = 1");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $logo_url = $_POST['logo_url'] ?? $settings['logo_url'];
    $favicon_url = $_POST['favicon_url'] ?? $settings['favicon_url'];

    if (isset($_FILES['logo_file'])) {
        $upload = handleFileUpload($_FILES['logo_file']);
        if ($upload['success']) $logo_url = $upload['path'];
    }
    if (isset($_FILES['favicon_file'])) {
        $upload = handleFileUpload($_FILES['favicon_file']);
        if ($upload['success']) $favicon_url = $upload['path'];
    }

    $fields = ['site_name', 'site_tagline', 'site_description', 'footer_text', 'copyright_text'];
    $smtpFields = ['smtp_host', 'smtp_port', 'smtp_username', 'smtp_password', 'smtp_from_email', 'smtp_from_name'];
    $sets = ["logo_url = '" . $db->escape($logo_url) . "'", "favicon_url = '" . $db->escape($favicon_url) . "'"];
    foreach (array_merge($fields, $smtpFields) as $f) {
        $sets[] = "$f = '" . $db->escape($_POST[$f] ?? '') . "'";
    }
    $db->query("UPDATE site_settings SET " . implode(', ', $sets) . " WHERE id = 1");
    $success = 'Settings updated successfully.';
    $settings = $db->fetchOne("SELECT * FROM site_settings WHERE id = 1");
}
?>

<div class="admin-header">
    <h1>Site Settings</h1>
    <a href="dashboard.php" class="btn btn-black btn-sm"><i class="fas fa-arrow-left"></i> Dashboard</a>
</div>

<?php if (isset($success)): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>

<div class="card">
    <div class="card-header"><h3>General Settings</h3></div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                <div class="form-group">
                    <label>Site Name</label>
                    <input type="text" name="site_name" value="<?= htmlspecialchars($settings['site_name']) ?>">
                </div>
                <div class="form-group">
                    <label>Site Tagline</label>
                    <input type="text" name="site_tagline" value="<?= htmlspecialchars($settings['site_tagline']) ?>">
                </div>
                <div style="grid-column:1/-1;" class="form-group">
                    <label>Site Description</label>
                    <textarea name="site_description" style="height:80px;"><?= htmlspecialchars($settings['site_description'] ?? '') ?></textarea>
                </div>
                <div class="form-group">
                    <label>Logo</label>
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:8px;">
                        <div style="width:60px;height:60px;background:#f5f5f5;border:1px solid #e0e0e0;display:flex;align-items:center;justify-content:center;overflow:hidden;">
                            <?php if ($settings['logo_url'] && file_exists(dirname(__DIR__) . '/' . $settings['logo_url'])): ?>
                            <img src="../<?= htmlspecialchars($settings['logo_url']) ?>" style="max-width:100%;max-height:100%;">
                            <?php else: ?>
                            <i class="fas fa-image" style="color:#ccc;font-size:1.2rem;"></i>
                            <?php endif; ?>
                        </div>
                        <span style="font-size:0.8rem;color:#888;">Current logo</span>
                    </div>
                    <input type="file" name="logo_file" accept="image/*" style="font-size:0.85rem;">
                    <input type="hidden" name="logo_url" value="<?= htmlspecialchars($settings['logo_url']) ?>">
                </div>
                <div class="form-group">
                    <label>Favicon</label>
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:8px;">
                        <div style="width:32px;height:32px;background:#f5f5f5;border:1px solid #e0e0e0;display:flex;align-items:center;justify-content:center;overflow:hidden;">
                            <?php if ($settings['favicon_url'] && file_exists(dirname(__DIR__) . '/' . $settings['favicon_url'])): ?>
                            <img src="../<?= htmlspecialchars($settings['favicon_url']) ?>" style="max-width:100%;max-height:100%;">
                            <?php else: ?>
                            <i class="fas fa-image" style="color:#ccc;font-size:0.8rem;"></i>
                            <?php endif; ?>
                        </div>
                        <span style="font-size:0.8rem;color:#888;">Current favicon</span>
                    </div>
                    <input type="file" name="favicon_file" accept="image/*" style="font-size:0.85rem;">
                    <input type="hidden" name="favicon_url" value="<?= htmlspecialchars($settings['favicon_url']) ?>">
                </div>
                <div style="grid-column:1/-1;" class="form-group">
                    <label>Footer Text</label>
                    <textarea name="footer_text" style="height:60px;"><?= htmlspecialchars($settings['footer_text'] ?? '') ?></textarea>
                </div>
                <div class="form-group">
                    <label>Copyright Text</label>
                    <input type="text" name="copyright_text" value="<?= htmlspecialchars($settings['copyright_text']) ?>">
                </div>
            </div>
            <div style="grid-column:1/-1; border-top:1px solid #e0e0e0; padding-top:20px; margin-top:10px;">
                <h4 style="font-family:var(--font-serif); margin-bottom:16px;"><i class="fas fa-envelope"></i> SMTP / Email Settings</h4>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                    <div class="form-group">
                        <label>SMTP Host</label>
                        <input type="text" name="smtp_host" value="<?= htmlspecialchars($settings['smtp_host'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label>SMTP Port</label>
                        <input type="text" name="smtp_port" value="<?= htmlspecialchars($settings['smtp_port'] ?? '465') ?>">
                    </div>
                    <div class="form-group">
                        <label>SMTP Username</label>
                        <input type="text" name="smtp_username" value="<?= htmlspecialchars($settings['smtp_username'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label>SMTP Password</label>
                        <input type="password" name="smtp_password" value="<?= htmlspecialchars($settings['smtp_password'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label>From Email</label>
                        <input type="email" name="smtp_from_email" value="<?= htmlspecialchars($settings['smtp_from_email'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label>From Name</label>
                        <input type="text" name="smtp_from_name" value="<?= htmlspecialchars($settings['smtp_from_name'] ?? '') ?>">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-black" style="margin-top:16px;"><i class="fas fa-save"></i> Save All Settings</button>
        </form>
    </div>
</div>

<?php require_once 'footer.php'; ?>
