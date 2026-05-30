<?php require_once 'header.php'; ?>
<?php
$db = Database::getInstance();
$editId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$attorney = null;
if ($editId) {
    $attorney = $db->fetchOne("SELECT * FROM attorneys WHERE id = $editId");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $db->escape($_POST['name']);
    $title = $db->escape($_POST['title']);
    $short_bio = $db->escape($_POST['short_bio']);
    $bio = $db->escape($_POST['bio']);
    $display_order = (int)($_POST['display_order'] ?? 0);
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $image_url = $_POST['image_url'] ?? '';

    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $upload = handleFileUpload($_FILES['image_file']);
        if ($upload['success']) $image_url = $upload['path'];
    }

    if ($editId) {
        $db->query("UPDATE attorneys SET name = '$name', title = '$title', short_bio = '$short_bio', bio = '$bio', image_url = '" . $db->escape($image_url) . "', display_order = $display_order, is_active = $is_active WHERE id = $editId");
    } else {
        $db->query("INSERT INTO attorneys (name, title, short_bio, bio, image_url, display_order, is_active) VALUES ('$name', '$title', '$short_bio', '$bio', '" . $db->escape($image_url) . "', $display_order, $is_active)");
    }
    $_SESSION['flash'] = 'Attorney saved successfully.';
    header('Location: attorneys.php');
    exit;
}

$attorney = $attorney ?: ['name' => '', 'title' => '', 'short_bio' => '', 'bio' => '', 'image_url' => '', 'display_order' => 0, 'is_active' => 1];
?>

<div class="admin-header">
    <h1><?= $editId ? 'Edit Attorney' : 'Add Attorney' ?></h1>
    <a href="attorneys.php" class="btn btn-black btn-sm"><i class="fas fa-arrow-left"></i> Back to List</a>
</div>

<div class="card">
    <div class="card-header"><h3><?= $editId ? 'Edit Profile' : 'New Attorney Profile' ?></h3></div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($attorney['name']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Title / Position</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($attorney['title']) ?>" required>
                </div>
                <div class="form-group" style="grid-column:1/-1;">
                    <label>Photo</label>
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:8px;">
                        <div style="width:80px;height:80px;border-radius:50%;background:#f5f5f5;border:1px solid #e0e0e0;display:flex;align-items:center;justify-content:center;overflow:hidden;">
                            <?php if (!empty($attorney['image_url']) && file_exists(dirname(__DIR__) . '/' . $attorney['image_url'])): ?>
                            <img src="../<?= htmlspecialchars($attorney['image_url']) ?>" style="width:100%;height:100%;object-fit:cover;">
                            <?php else: ?>
                            <i class="fas fa-user" style="color:#ccc;font-size:1.5rem;"></i>
                            <?php endif; ?>
                        </div>
                        <span style="font-size:0.8rem;color:#888;">Current photo</span>
                    </div>
                    <input type="file" name="image_file" accept="image/*" style="font-size:0.85rem;">
                    <input type="hidden" name="image_url" value="<?= htmlspecialchars($attorney['image_url'] ?? '') ?>">
                </div>
                <div style="grid-column:1/-1;" class="form-group">
                    <label>Short Bio <small>(shown by default, with &quot;Read More&quot;)</small></label>
                    <textarea name="short_bio" style="height:80px;"><?= htmlspecialchars($attorney['short_bio']) ?></textarea>
                </div>
                <div style="grid-column:1/-1;" class="form-group">
                    <label>Full Biography</label>
                    <textarea name="bio" style="height:200px;"><?= htmlspecialchars($attorney['bio']) ?></textarea>
                </div>
                <div class="form-group">
                    <label>Display Order</label>
                    <input type="number" name="display_order" value="<?= $attorney['display_order'] ?>" min="0" style="width:80px;">
                </div>
                <div class="form-group" style="display:flex;align-items:center;gap:10px;padding-top:24px;">
                    <input type="checkbox" name="is_active" id="is_active" value="1" <?= $attorney['is_active'] ? 'checked' : '' ?>>
                    <label for="is_active" style="margin:0;">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-black" style="margin-top:16px;"><i class="fas fa-save"></i> Save Attorney</button>
        </form>
    </div>
</div>

<?php require_once 'footer.php'; ?>
