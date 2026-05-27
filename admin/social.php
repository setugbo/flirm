<?php require_once 'header.php'; ?>
<?php
$db = Database::getInstance();
$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? 0;

if ($action === 'delete' && $id) {
    $db->query("DELETE FROM social_media WHERE id = $id");
    header('Location: social.php?deleted=1');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $platform = $db->escape($_POST['platform']);
    $url = $db->escape($_POST['url']);
    $icon_class = $db->escape($_POST['icon_class'] ?? 'fa-globe');
    $display_order = (int)($_POST['display_order'] ?? 0);

    if ($id) {
        $db->query("UPDATE social_media SET platform='$platform', url='$url', icon_class='$icon_class', display_order=$display_order WHERE id=$id");
    } else {
        $db->query("INSERT INTO social_media (platform, url, icon_class, display_order) VALUES ('$platform', '$url', '$icon_class', $display_order)");
    }
    header('Location: social.php?saved=1');
    exit;
}

$socials = $db->fetchAll("SELECT * FROM social_media ORDER BY display_order ASC");
$editSocial = $id ? $db->fetchOne("SELECT * FROM social_media WHERE id = $id") : null;
?>
<div class="admin-header">
    <h1>Social Media</h1>
    <a href="?action=add" class="btn btn-black btn-sm"><i class="fas fa-plus"></i> Add New</a>
</div>

<?php if (isset($_GET['saved'])): ?><div class="alert alert-success">Social media saved.</div><?php endif; ?>
<?php if (isset($_GET['deleted'])): ?><div class="alert alert-success">Social media deleted.</div><?php endif; ?>

<?php if ($action === 'add' || $editSocial): ?>
<div class="card">
    <div class="card-header">
        <h3><?= $editSocial ? 'Edit Social Media' : 'Add Social Media' ?></h3>
        <a href="social.php" class="btn btn-outline btn-sm"><i class="fas fa-times"></i> Cancel</a>
    </div>
    <div class="card-body">
        <form method="POST">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                <div class="form-group">
                    <label>Platform Name <span style="color:#cc0000;">*</span></label>
                    <input type="text" name="platform" required value="<?= htmlspecialchars($editSocial['platform'] ?? '') ?>" placeholder="e.g. Facebook">
                </div>
                <div class="form-group">
                    <label>Icon Class</label>
                    <input type="text" name="icon_class" value="<?= htmlspecialchars($editSocial['icon_class'] ?? 'fa-globe') ?>" placeholder="e.g. fa-facebook-f">
                </div>
                <div style="grid-column:1/-1;" class="form-group">
                    <label>Profile URL <span style="color:#cc0000;">*</span></label>
                    <input type="url" name="url" required value="<?= htmlspecialchars($editSocial['url'] ?? '') ?>" placeholder="https://">
                </div>
                <div class="form-group">
                    <label>Display Order</label>
                    <input type="number" name="display_order" value="<?= htmlspecialchars($editSocial['display_order'] ?? 0) ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-black" style="margin-top:16px;"><i class="fas fa-save"></i> Save</button>
        </form>
    </div>
</div>
<?php endif; ?>

<div class="card">
    <div class="card-header"><h3>All Social Links</h3></div>
    <div class="card-body">
        <?php if (empty($socials)): ?>
        <p style="color:#888; text-align:center; padding:20px;">No social media added.</p>
        <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Order</th><th>Platform</th><th>URL</th><th>Actions</th></tr></thead>
                <tbody>
                    <?php foreach ($socials as $s): ?>
                    <tr>
                        <td><?= $s['display_order'] ?></td>
                        <td><strong><i class="fab <?= htmlspecialchars($s['icon_class']) ?>"></i> <?= htmlspecialchars($s['platform']) ?></strong></td>
                        <td><a href="<?= htmlspecialchars($s['url']) ?>" target="_blank" style="color:#0066cc;"><?= htmlspecialchars($s['url']) ?></a></td>
                        <td>
                            <div class="actions">
                                <a href="?action=add&id=<?= $s['id'] ?>"><i class="fas fa-edit"></i> Edit</a>
                                <a href="?action=delete&id=<?= $s['id'] ?>" class="delete" onclick="return confirm('Delete?')"><i class="fas fa-trash"></i> Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once 'footer.php'; ?>
