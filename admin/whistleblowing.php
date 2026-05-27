<?php require_once 'header.php'; ?>
<?php
$db = Database::getInstance();
$page = getPageContent('whistleblowing');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db->query("UPDATE page_content SET title='" . $db->escape($_POST['title']) . "', content='" . $db->escape($_POST['content']) . "' WHERE page_key='whistleblowing'");
    $success = 'Whistleblowing page updated.';
    $page = getPageContent('whistleblowing');
}
?>

<div class="admin-header">
    <h1>Whistleblowing Policy</h1>
    <a href="dashboard.php" class="btn btn-black btn-sm"><i class="fas fa-arrow-left"></i> Dashboard</a>
</div>

<?php if (isset($success)): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>

<div class="card">
    <div class="card-header"><h3>Edit Whistleblowing Page</h3></div>
    <div class="card-body">
        <form method="POST">
            <div class="form-group">
                <label>Page Title</label>
                <input type="text" name="title" value="<?= htmlspecialchars($page['title']) ?>">
            </div>
            <div class="form-group" style="margin-top:16px;">
                <label>Content <small>(HTML allowed)</small></label>
                <textarea name="content" style="height:400px;font-family:monospace;font-size:0.9rem;"><?= htmlspecialchars($page['content']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-black" style="margin-top:16px;"><i class="fas fa-save"></i> Save Changes</button>
            <a href="../whistleblowing.php" class="btn btn-outline" style="margin-top:16px;display:inline-flex;align-items:center;gap:6px;" target="_blank"><i class="fas fa-external-link-alt"></i> View Page</a>
        </form>
    </div>
</div>

<?php require_once 'footer.php'; ?>
