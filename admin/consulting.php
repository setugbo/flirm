<?php require_once 'header.php'; ?>
<?php
$db = Database::getInstance();
$consulting = $db->fetchOne("SELECT * FROM consulting_section WHERE id = 1");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image_url = $_POST['image_url'] ?? $consulting['image_url'] ?? '';

    if (isset($_FILES['image_file'])) {
        $upload = handleFileUpload($_FILES['image_file']);
        if ($upload['success']) $image_url = $upload['path'];
    }

    $company_name = $db->escape($_POST['company_name']);
    $tagline = $db->escape($_POST['tagline'] ?? '');
    $content = $db->escape($_POST['content']);
    $db->query("UPDATE consulting_section SET company_name='$company_name', tagline='$tagline', content='$content', image_url='" . $db->escape($image_url) . "' WHERE id=1");
    $success = 'Consulting section updated.';
    $consulting = $db->fetchOne("SELECT * FROM consulting_section WHERE id = 1");
}
?>

<div class="admin-header">
    <h1>Consulting Section</h1>
    <a href="dashboard.php" class="btn btn-black btn-sm"><i class="fas fa-arrow-left"></i> Dashboard</a>
</div>

<?php if (isset($success)): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>

<div class="card">
    <div class="card-header"><h3>Edit Consulting Section</h3></div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                <div class="form-group">
                    <label>Company Name</label>
                    <input type="text" name="company_name" value="<?= htmlspecialchars($consulting['company_name']) ?>">
                </div>
                <div class="form-group">
                    <label>Tagline</label>
                    <input type="text" name="tagline" value="<?= htmlspecialchars($consulting['tagline'] ?? '') ?>">
                </div>
                <div style="grid-column:1/-1;" class="form-group">
                    <label>Featured Image</label>
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:8px;">
                        <div style="width:100px;height:70px;background:#f5f5f5;border:1px solid #e0e0e0;display:flex;align-items:center;justify-content:center;overflow:hidden;">
                            <?php if (!empty($consulting['image_url']) && file_exists(dirname(__DIR__) . '/' . $consulting['image_url'])): ?>
                            <img src="../<?= htmlspecialchars($consulting['image_url']) ?>" style="width:100%;height:100%;object-fit:cover;">
                            <?php else: ?>
                            <i class="fas fa-image" style="color:#ccc;font-size:1.5rem;"></i>
                            <?php endif; ?>
                        </div>
                        <span style="font-size:0.8rem;color:#888;">Current image</span>
                    </div>
                    <input type="file" name="image_file" accept="image/*" style="font-size:0.85rem;">
                    <input type="hidden" name="image_url" value="<?= htmlspecialchars($consulting['image_url'] ?? '') ?>">
                </div>
                <div style="grid-column:1/-1;" class="form-group">
                    <label>Content</label>
                    <textarea name="content" style="height:300px;"><?= htmlspecialchars($consulting['content']) ?></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-black"><i class="fas fa-save"></i> Save Changes</button>
        </form>
    </div>
</div>

<?php require_once 'footer.php'; ?>
