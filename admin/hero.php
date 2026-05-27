<?php require_once 'header.php'; ?>
<?php
$db = Database::getInstance();
$hero = $db->fetchOne("SELECT * FROM hero_section WHERE id = 1");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $background_image = $_POST['background_image'] ?? $hero['background_image'] ?? '';

    if (isset($_FILES['bg_image_file'])) {
        $upload = handleFileUpload($_FILES['bg_image_file']);
        if ($upload['success']) $background_image = $upload['path'];
    }

    $fields = ['title', 'subtitle', 'description', 'btn1_text', 'btn1_link', 'btn3_text', 'btn3_link'];
    $sets = ["background_image = '" . $db->escape($background_image) . "'"];
    foreach ($fields as $f) {
        $sets[] = "$f = '" . $db->escape($_POST[$f] ?? '') . "'";
    }
    $sql = "UPDATE hero_section SET " . implode(', ', $sets) . " WHERE id = 1";
    if ($db->query($sql)) {
        $success = 'Hero section updated successfully.';
        $hero = $db->fetchOne("SELECT * FROM hero_section WHERE id = 1");
    } else {
        $error = 'Error updating hero section.';
    }
}
?>

<div class="admin-header">
    <h1>Hero Section</h1>
    <a href="dashboard.php" class="btn btn-black btn-sm"><i class="fas fa-arrow-left"></i> Dashboard</a>
</div>

<?php if (isset($success)): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>
<?php if (isset($error)): ?><div class="alert alert-error"><?= $error ?></div><?php endif; ?>

<div class="card">
    <div class="card-header"><h3>Edit Hero Section</h3></div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                <div class="form-group">
                    <label>Badge Title</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($hero['title']) ?>">
                </div>
                <div class="form-group">
                    <label>Background Image</label>
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:8px;">
                        <div style="width:80px;height:50px;background:#f5f5f5;border:1px solid #e0e0e0;display:flex;align-items:center;justify-content:center;overflow:hidden;">
                            <?php if (imgExists($hero['background_image'] ?? '')): ?>
                            <img src="../<?= htmlspecialchars($hero['background_image']) ?>" style="width:100%;height:100%;object-fit:cover;">
                            <?php else: ?>
                            <i class="fas fa-image" style="color:#ccc;font-size:1rem;"></i>
                            <?php endif; ?>
                        </div>
                        <span style="font-size:0.8rem;color:#888;">Current background</span>
                    </div>
                    <input type="file" name="bg_image_file" accept="image/*" style="font-size:0.85rem;">
                    <input type="hidden" name="background_image" value="<?= htmlspecialchars($hero['background_image'] ?? '') ?>">
                </div>
                <div style="grid-column:1/-1;" class="form-group">
                    <label>Headline (appears in large text)</label>
                    <input type="text" name="subtitle" value="<?= htmlspecialchars($hero['subtitle']) ?>">
                </div>
                <div style="grid-column:1/-1;" class="form-group">
                    <label>Supporting Text</label>
                    <textarea name="description" style="height:80px;"><?= htmlspecialchars($hero['description']) ?></textarea>
                </div>
                <div class="form-group">
                    <label>Button 1 Text</label>
                    <input type="text" name="btn1_text" value="<?= htmlspecialchars($hero['btn1_text']) ?>">
                </div>
                <div class="form-group">
                    <label>Button 1 Link</label>
                    <input type="text" name="btn1_link" value="<?= htmlspecialchars($hero['btn1_link']) ?>">
                </div>
                <div class="form-group">
                    <label>Button 2 Text</label>
                    <input type="text" name="btn3_text" value="<?= htmlspecialchars($hero['btn3_text']) ?>">
                </div>
                <div class="form-group">
                    <label>Button 2 Link</label>
                    <input type="text" name="btn3_link" value="<?= htmlspecialchars($hero['btn3_link']) ?>">
                </div>
            </div>
            <div style="margin-top:16px; padding:12px; background:#f9f9f9; border:1px solid #eee; font-size:0.8rem; color:#888;">
                <strong>Note:</strong> Contact details (address, email, phone) are managed in the <a href="contact.php" style="color:#000;">Contact Info</a> section.
            </div>
            <button type="submit" class="btn btn-black" style="margin-top:16px;"><i class="fas fa-save"></i> Save Changes</button>
        </form>
    </div>
</div>

<?php require_once 'footer.php'; ?>
