<?php require_once 'header.php'; ?>
<?php
$db = Database::getInstance();
$attorneys = $db->fetchAll("SELECT * FROM attorneys ORDER BY display_order ASC");

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $db->query("DELETE FROM attorneys WHERE id = $id");
    header('Location: attorneys.php');
    exit;
}

if (isset($_GET['toggle'])) {
    $id = (int)$_GET['toggle'];
    $att = $db->fetchOne("SELECT is_active FROM attorneys WHERE id = $id");
    if ($att) {
        $new = $att['is_active'] ? 0 : 1;
        $db->query("UPDATE attorneys SET is_active = $new WHERE id = $id");
    }
    header('Location: attorneys.php');
    exit;
}
?>

<div class="admin-header">
    <h1>Our Attorneys</h1>
    <div>
        <a href="attorneys-form.php" class="btn btn-black btn-sm"><i class="fas fa-plus"></i> Add Attorney</a>
        <a href="dashboard.php" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Dashboard</a>
    </div>
</div>

<?php if (isset($_SESSION['flash'])): ?>
<div class="alert alert-success"><?= $_SESSION['flash']; unset($_SESSION['flash']); ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-header"><h3>All Attorneys</h3></div>
    <div class="card-body">
        <?php if (empty($attorneys)): ?>
        <p style="color:#888;text-align:center;padding:20px;">No attorneys yet. <a href="attorneys-form.php">Add one</a>.</p>
        <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($attorneys as $att): ?>
                    <tr>
                        <td>
                            <?php if (!empty($att['image_url']) && file_exists(dirname(__DIR__) . '/' . $att['image_url'])): ?>
                            <img src="../<?= htmlspecialchars($att['image_url']) ?>" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                            <?php else: ?>
                            <i class="fas fa-user-circle" style="font-size:1.5rem;color:#ccc;"></i>
                            <?php endif; ?>
                        </td>
                        <td><strong><?= htmlspecialchars($att['name']) ?></strong></td>
                        <td><?= htmlspecialchars($att['title']) ?></td>
                        <td><?= $att['display_order'] ?></td>
                        <td><?= $att['is_active'] ? '<span style="color:#090;font-weight:600;">Active</span>' : '<span style="color:#999;">Inactive</span>' ?></td>
                        <td>
                            <a href="attorneys-form.php?id=<?= $att['id'] ?>" class="btn btn-sm btn-outline" style="padding:4px 10px;font-size:0.75rem;">Edit</a>
                            <a href="attorneys.php?toggle=<?= $att['id'] ?>" class="btn btn-sm btn-outline" style="padding:4px 10px;font-size:0.75rem;"><?= $att['is_active'] ? 'Deactivate' : 'Activate' ?></a>
                            <a href="attorneys.php?delete=<?= $att['id'] ?>" class="btn btn-sm btn-outline" style="padding:4px 10px;font-size:0.75rem;border-color:#c00;color:#c00;" onclick="return confirm('Delete this attorney?')">Delete</a>
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
