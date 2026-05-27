<?php require_once 'header.php'; ?>
<?php
$db = Database::getInstance();
$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? 0;

// Handle delete
if ($action === 'delete' && $id) {
    $db->query("DELETE FROM practice_areas WHERE id = $id");
    header('Location: practice-areas.php?deleted=1');
    exit;
}

// Handle add/edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $db->escape($_POST['title']);
    $short_description = $db->escape($_POST['short_description'] ?? '');
    $services = $db->escape($_POST['services'] ?? '');
    $icon_class = $db->escape($_POST['icon_class'] ?? 'fa-gavel');
    $display_order = (int)($_POST['display_order'] ?? 0);

    if ($id) {
        $db->query("UPDATE practice_areas SET title='$title', short_description='$short_description', services='$services', icon_class='$icon_class', display_order=$display_order WHERE id=$id");
    } else {
        $db->query("INSERT INTO practice_areas (title, short_description, services, icon_class, display_order) VALUES ('$title', '$short_description', '$services', '$icon_class', $display_order)");
    }
    header('Location: practice-areas.php?saved=1');
    exit;
}

$areas = $db->fetchAll("SELECT * FROM practice_areas ORDER BY display_order ASC");
$editArea = $id ? $db->fetchOne("SELECT * FROM practice_areas WHERE id = $id") : null;
?>
<div class="admin-header">
    <h1>Practice Areas</h1>
    <a href="?action=add" class="btn btn-black btn-sm"><i class="fas fa-plus"></i> Add New</a>
</div>

<?php if (isset($_GET['saved'])): ?><div class="alert alert-success">Practice area saved successfully.</div><?php endif; ?>
<?php if (isset($_GET['deleted'])): ?><div class="alert alert-success">Practice area deleted.</div><?php endif; ?>

<?php if ($action === 'add' || $editArea): ?>
<div class="card">
    <div class="card-header">
        <h3><?= $editArea ? 'Edit Practice Area' : 'Add Practice Area' ?></h3>
        <a href="practice-areas.php" class="btn btn-outline btn-sm"><i class="fas fa-times"></i> Cancel</a>
    </div>
    <div class="card-body">
        <form method="POST">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                <div class="form-group">
                    <label>Title <span style="color:#cc0000;">*</span></label>
                    <input type="text" name="title" required value="<?= htmlspecialchars($editArea['title'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Icon Class (Font Awesome)</label>
                    <input type="text" name="icon_class" value="<?= htmlspecialchars($editArea['icon_class'] ?? 'fa-gavel') ?>" placeholder="e.g. fa-briefcase">
                </div>
                <div style="grid-column:1/-1;" class="form-group">
                    <label>Short Description</label>
                    <textarea name="short_description" style="height:80px;"><?= htmlspecialchars($editArea['short_description'] ?? '') ?></textarea>
                </div>
                <div style="grid-column:1/-1;" class="form-group">
                    <label>Services (separate each service with | pipe character)</label>
                    <textarea name="services" style="height:100px;"><?= htmlspecialchars($editArea['services'] ?? '') ?></textarea>
                    <small style="color:#888; margin-top:4px; display:block;">Example: Company registration|Corporate governance|Contract drafting</small>
                </div>
                <div class="form-group">
                    <label>Display Order</label>
                    <input type="number" name="display_order" value="<?= htmlspecialchars($editArea['display_order'] ?? 0) ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-black" style="margin-top:16px;"><i class="fas fa-save"></i> Save</button>
        </form>
    </div>
</div>
<?php endif; ?>

<div class="card">
    <div class="card-header"><h3>All Practice Areas</h3></div>
    <div class="card-body">
        <?php if (empty($areas)): ?>
        <p style="color:#888; text-align:center; padding:20px;">No practice areas added yet.</p>
        <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Order</th><th>Title</th><th>Icon</th><th>Services</th><th>Actions</th></tr></thead>
                <tbody>
                    <?php foreach ($areas as $a): ?>
                    <tr>
                        <td><?= $a['display_order'] ?></td>
                        <td><strong><?= htmlspecialchars($a['title']) ?></strong></td>
                        <td><i class="fas <?= htmlspecialchars($a['icon_class']) ?>"></i></td>
                        <td><?= str_replace('|', ', ', htmlspecialchars($a['services'] ?? '')) ?></td>
                        <td>
                            <div class="actions">
                                <a href="?action=add&id=<?= $a['id'] ?>"><i class="fas fa-edit"></i> Edit</a>
                                <a href="?action=delete&id=<?= $a['id'] ?>" class="delete" onclick="return confirm('Delete this practice area?')"><i class="fas fa-trash"></i> Delete</a>
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
