<?php require_once 'header.php'; ?>
<?php
$db = Database::getInstance();
$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? 0;

if ($action === 'delete' && $id) {
    $db->query("DELETE FROM why_choose_us WHERE id = $id");
    header('Location: why-choose.php?deleted=1');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $db->escape($_POST['title']);
    $description = $db->escape($_POST['description'] ?? '');
    $icon_class = $db->escape($_POST['icon_class'] ?? 'fa-star');
    $display_order = (int)($_POST['display_order'] ?? 0);

    if ($id) {
        $db->query("UPDATE why_choose_us SET title='$title', description='$description', icon_class='$icon_class', display_order=$display_order WHERE id=$id");
    } else {
        $db->query("INSERT INTO why_choose_us (title, description, icon_class, display_order) VALUES ('$title', '$description', '$icon_class', $display_order)");
    }
    header('Location: why-choose.php?saved=1');
    exit;
}

$items = $db->fetchAll("SELECT * FROM why_choose_us ORDER BY display_order ASC");
$editItem = $id ? $db->fetchOne("SELECT * FROM why_choose_us WHERE id = $id") : null;
?>
<div class="admin-header">
    <h1>Why Choose Us</h1>
    <a href="?action=add" class="btn btn-black btn-sm"><i class="fas fa-plus"></i> Add New</a>
</div>

<?php if (isset($_GET['saved'])): ?><div class="alert alert-success">Item saved successfully.</div><?php endif; ?>
<?php if (isset($_GET['deleted'])): ?><div class="alert alert-success">Item deleted.</div><?php endif; ?>

<?php if ($action === 'add' || $editItem): ?>
<div class="card">
    <div class="card-header">
        <h3><?= $editItem ? 'Edit Item' : 'Add Item' ?></h3>
        <a href="why-choose.php" class="btn btn-outline btn-sm"><i class="fas fa-times"></i> Cancel</a>
    </div>
    <div class="card-body">
        <form method="POST">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                <div class="form-group">
                    <label>Title <span style="color:#cc0000;">*</span></label>
                    <input type="text" name="title" required value="<?= htmlspecialchars($editItem['title'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Icon Class</label>
                    <input type="text" name="icon_class" value="<?= htmlspecialchars($editItem['icon_class'] ?? 'fa-star') ?>" placeholder="e.g. fa-shield-alt">
                </div>
                <div style="grid-column:1/-1;" class="form-group">
                    <label>Description</label>
                    <textarea name="description" style="height:100px;"><?= htmlspecialchars($editItem['description'] ?? '') ?></textarea>
                </div>
                <div class="form-group">
                    <label>Display Order</label>
                    <input type="number" name="display_order" value="<?= htmlspecialchars($editItem['display_order'] ?? 0) ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-black" style="margin-top:16px;"><i class="fas fa-save"></i> Save</button>
        </form>
    </div>
</div>
<?php endif; ?>

<div class="card">
    <div class="card-header"><h3>All Items</h3></div>
    <div class="card-body">
        <?php if (empty($items)): ?>
        <p style="color:#888; text-align:center; padding:20px;">No items added yet.</p>
        <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Order</th><th>Title</th><th>Icon</th><th>Actions</th></tr></thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= $item['display_order'] ?></td>
                        <td><strong><?= htmlspecialchars($item['title']) ?></strong></td>
                        <td><i class="fas <?= htmlspecialchars($item['icon_class']) ?>"></i></td>
                        <td>
                            <div class="actions">
                                <a href="?action=add&id=<?= $item['id'] ?>"><i class="fas fa-edit"></i> Edit</a>
                                <a href="?action=delete&id=<?= $item['id'] ?>" class="delete" onclick="return confirm('Delete this item?')"><i class="fas fa-trash"></i> Delete</a>
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
