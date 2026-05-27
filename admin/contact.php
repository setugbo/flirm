<?php require_once 'header.php'; ?>
<?php
$db = Database::getInstance();
$contact = $db->fetchOne("SELECT * FROM contact_info WHERE id = 1");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = ['address', 'email', 'phone', 'office_hours_weekdays', 'office_hours_saturday', 'office_hours_sunday', 'map_embed'];
    $sets = [];
    foreach ($fields as $f) {
        $sets[] = "$f = '" . $db->escape($_POST[$f] ?? '') . "'";
    }
    $db->query("UPDATE contact_info SET " . implode(', ', $sets) . " WHERE id = 1");
    $success = 'Contact information updated successfully.';
    $contact = $db->fetchOne("SELECT * FROM contact_info WHERE id = 1");
}
?>

<div class="admin-header">
    <h1>Contact Information</h1>
    <a href="dashboard.php" class="btn btn-black btn-sm"><i class="fas fa-arrow-left"></i> Dashboard</a>
</div>

<?php if (isset($success)): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>

<div class="card">
    <div class="card-header"><h3>Edit Contact Info</h3></div>
    <div class="card-body">
        <form method="POST">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                <div style="grid-column:1/-1;" class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" value="<?= htmlspecialchars($contact['address']) ?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($contact['email']) ?>">
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" value="<?= htmlspecialchars($contact['phone']) ?>">
                </div>
                <div class="form-group">
                    <label>Office Hours (Weekdays)</label>
                    <input type="text" name="office_hours_weekdays" value="<?= htmlspecialchars($contact['office_hours_weekdays']) ?>">
                </div>
                <div class="form-group">
                    <label>Office Hours (Saturday)</label>
                    <input type="text" name="office_hours_saturday" value="<?= htmlspecialchars($contact['office_hours_saturday']) ?>">
                </div>
                <div class="form-group">
                    <label>Office Hours (Sunday)</label>
                    <input type="text" name="office_hours_sunday" value="<?= htmlspecialchars($contact['office_hours_sunday']) ?>">
                </div>
                <div style="grid-column:1/-1;" class="form-group">
                    <label>Google Maps Embed Code</label>
                    <textarea name="map_embed" style="height:100px; font-family:monospace; font-size:0.8rem;"><?= htmlspecialchars($contact['map_embed'] ?? '') ?></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-black"><i class="fas fa-save"></i> Save Changes</button>
        </form>
    </div>
</div>

<?php require_once 'footer.php'; ?>
