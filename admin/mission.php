<?php require_once 'header.php'; ?>
<?php
$db = Database::getInstance();
$mission = $db->fetchOne("SELECT * FROM mission_vision WHERE type = 'mission'");
$vision = $db->fetchOne("SELECT * FROM mission_vision WHERE type = 'vision'");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $missionContent = $db->escape($_POST['mission_content']);
    $missionTitle = $db->escape($_POST['mission_title']);
    $visionContent = $db->escape($_POST['vision_content']);
    $visionTitle = $db->escape($_POST['vision_title']);

    $db->query("UPDATE mission_vision SET title = '$missionTitle', content = '$missionContent' WHERE type = 'mission'");
    $db->query("UPDATE mission_vision SET title = '$visionTitle', content = '$visionContent' WHERE type = 'vision'");
    $success = 'Mission & Vision updated successfully.';
    $mission = $db->fetchOne("SELECT * FROM mission_vision WHERE type = 'mission'");
    $vision = $db->fetchOne("SELECT * FROM mission_vision WHERE type = 'vision'");
}
?>

<div class="admin-header">
    <h1>Mission & Vision</h1>
    <a href="dashboard.php" class="btn btn-black btn-sm"><i class="fas fa-arrow-left"></i> Dashboard</a>
</div>

<?php if (isset($success)): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:24px;">
    <div class="card">
        <div class="card-header"><h3>Mission</h3></div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="mission_title" value="<?= htmlspecialchars($mission['title'] ?? 'Our Mission') ?>">
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <textarea name="mission_content" style="height:120px;"><?= htmlspecialchars($mission['content'] ?? '') ?></textarea>
                </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><h3>Vision</h3></div>
        <div class="card-body">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="vision_title" value="<?= htmlspecialchars($vision['title'] ?? 'Our Vision') ?>">
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <textarea name="vision_content" style="height:120px;"><?= htmlspecialchars($vision['content'] ?? '') ?></textarea>
                </div>
        </div>
    </div>
</div>
<button type="submit" class="btn btn-black" style="margin-top:16px;"><i class="fas fa-save"></i> Save Both</button>
</form>

<?php require_once 'footer.php'; ?>
