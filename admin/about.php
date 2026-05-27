<?php require_once 'header.php'; ?>
<?php
$db = Database::getInstance();
$about = $db->fetchOne("SELECT * FROM about_section WHERE id = 1");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image_url = $_POST['image_url'] ?? $about['image_url'] ?? '';

    if (isset($_FILES['image_file'])) {
        $upload = handleFileUpload($_FILES['image_file']);
        if ($upload['success']) $image_url = $upload['path'];
    }

    $heading = $db->escape($_POST['heading']);
    $content = $db->escape($_POST['content']);
    $db->query("UPDATE about_section SET heading = '$heading', content = '$content', image_url = '" . $db->escape($image_url) . "' WHERE id = 1");
    $success = 'About section updated successfully.';
    $about = $db->fetchOne("SELECT * FROM about_section WHERE id = 1");
}
?>

<div class="admin-header">
    <h1>About Us</h1>
    <a href="dashboard.php" class="btn btn-black btn-sm"><i class="fas fa-arrow-left"></i> Dashboard</a>
</div>

<?php if (isset($success)): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>

<div class="card">
    <div class="card-header"><h3>Edit About Section</h3></div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Heading</label>
                <input type="text" name="heading" value="<?= htmlspecialchars($about['heading']) ?>">
            </div>
            <div class="form-group">
                <label>Image</label>
                <div style="display:flex; align-items:center; gap:12px; margin-bottom:8px;">
                    <div style="width:100px;height:70px;background:#f5f5f5;border:1px solid #e0e0e0;display:flex;align-items:center;justify-content:center;overflow:hidden;">
                        <?php if (!empty($about['image_url']) && file_exists(dirname(__DIR__) . '/' . $about['image_url'])): ?>
                        <img src="../<?= htmlspecialchars($about['image_url']) ?>" style="width:100%;height:100%;object-fit:cover;">
                        <?php else: ?>
                        <i class="fas fa-image" style="color:#ccc;font-size:1.5rem;"></i>
                        <?php endif; ?>
                    </div>
                    <span style="font-size:0.8rem;color:#888;">Current image</span>
                </div>
                <input type="file" name="image_file" accept="image/*" style="font-size:0.85rem;">
                <input type="hidden" name="image_url" value="<?= htmlspecialchars($about['image_url'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea name="content" style="height:200px;"><?= htmlspecialchars($about['content']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-black"><i class="fas fa-save"></i> Save Changes</button>
        </form>
    </div>
</div>

<?php require_once 'footer.php'; ?>
