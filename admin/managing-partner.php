<?php require_once 'header.php'; ?>
<?php
$db = Database::getInstance();
$partner = $db->fetchOne("SELECT * FROM managing_partner WHERE id = 1");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image_url = $_POST['image_url'] ?? $partner['image_url'] ?? '';

    if (isset($_FILES['image_file'])) {
        $upload = handleFileUpload($_FILES['image_file']);
        if ($upload['success']) $image_url = $upload['path'];
    }

    $name = $db->escape($_POST['name']);
    $title = $db->escape($_POST['title']);
    $bio = $db->escape($_POST['bio']);
    $db->query("UPDATE managing_partner SET name = '$name', title = '$title', bio = '$bio', image_url = '" . $db->escape($image_url) . "' WHERE id = 1");
    $success = 'Partner information updated successfully.';
    $partner = $db->fetchOne("SELECT * FROM managing_partner WHERE id = 1");
}
?>

<div class="admin-header">
    <h1>Managing Partner</h1>
    <a href="dashboard.php" class="btn btn-black btn-sm"><i class="fas fa-arrow-left"></i> Dashboard</a>
</div>

<?php if (isset($success)): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>

<div class="card">
    <div class="card-header"><h3>Edit Managing Partner</h3></div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($partner['name']) ?>">
                </div>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($partner['title']) ?>">
                </div>
                <div style="grid-column:1/-1;" class="form-group">
                    <label>Photo</label>
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:8px;">
                        <div style="width:80px;height:80px;border-radius:50%;background:#f5f5f5;border:1px solid #e0e0e0;display:flex;align-items:center;justify-content:center;overflow:hidden;">
                            <?php if (!empty($partner['image_url']) && file_exists(dirname(__DIR__) . '/' . $partner['image_url'])): ?>
                            <img src="../<?= htmlspecialchars($partner['image_url']) ?>" style="width:100%;height:100%;object-fit:cover;">
                            <?php else: ?>
                            <i class="fas fa-user" style="color:#ccc;font-size:1.5rem;"></i>
                            <?php endif; ?>
                        </div>
                        <span style="font-size:0.8rem;color:#888;">Current photo</span>
                    </div>
                    <input type="file" name="image_file" accept="image/*" style="font-size:0.85rem;">
                    <input type="hidden" name="image_url" value="<?= htmlspecialchars($partner['image_url'] ?? '') ?>">
                </div>
                <div style="grid-column:1/-1;" class="form-group">
                    <label>Biography</label>
                    <textarea name="bio" style="height:200px;"><?= htmlspecialchars($partner['bio']) ?></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-black"><i class="fas fa-save"></i> Save Changes</button>
        </form>
    </div>
</div>

<?php require_once 'footer.php'; ?>
