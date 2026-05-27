<?php require_once 'header.php'; ?>
<?php
$db = Database::getInstance();

// Mark as read
if (isset($_GET['read']) && $_GET['read']) {
    $db->query("UPDATE contact_messages SET is_read = 1 WHERE id = " . (int)$_GET['read']);
    header('Location: messages.php');
    exit;
}

// Delete
if (isset($_GET['delete']) && $_GET['delete']) {
    $db->query("DELETE FROM contact_messages WHERE id = " . (int)$_GET['delete']);
    header('Location: messages.php?deleted=1');
    exit;
}

$messages = $db->fetchAll("SELECT * FROM contact_messages ORDER BY created_at DESC");
?>

<div class="admin-header">
    <h1>Contact Messages</h1>
    <a href="dashboard.php" class="btn btn-black btn-sm"><i class="fas fa-arrow-left"></i> Dashboard</a>
</div>

<?php if (isset($_GET['deleted'])): ?><div class="alert alert-success">Message deleted.</div><?php endif; ?>

<div class="card">
    <div class="card-header"><h3>All Messages (<?= count($messages) ?>)</h3></div>
    <div class="card-body">
        <?php if (empty($messages)): ?>
        <p style="color:#888; text-align:center; padding:20px;">No messages yet.</p>
        <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Date</th><th>Name</th><th>Email</th><th>Phone</th><th>Subject</th><th>Message</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    <?php foreach ($messages as $msg): ?>
                    <tr style="<?= !$msg['is_read'] ? 'background:#fafafa;' : '' ?>">
                        <td style="white-space:nowrap;"><?= formatDate($msg['created_at']) ?></td>
                        <td><strong><?= htmlspecialchars($msg['name']) ?></strong></td>
                        <td><a href="mailto:<?= htmlspecialchars($msg['email']) ?>" style="color:#0066cc;"><?= htmlspecialchars($msg['email']) ?></a></td>
                        <td><?= htmlspecialchars($msg['phone'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($msg['subject'] ?: '-') ?></td>
                        <td style="max-width:250px;"><?= htmlspecialchars(mb_substr($msg['message'], 0, 100)) ?><?= strlen($msg['message']) > 100 ? '...' : '' ?></td>
                        <td><?= $msg['is_read'] ? '<span style="color:#888;">Read</span>' : '<strong style="color:#000;">New</strong>' ?></td>
                        <td>
                            <div class="actions" style="flex-wrap:nowrap;">
                                <?php if (!$msg['is_read']): ?>
                                <a href="?read=<?= $msg['id'] ?>" style="font-size:0.7rem;">Mark Read</a>
                                <?php endif; ?>
                                <a href="?delete=<?= $msg['id'] ?>" class="delete" onclick="return confirm('Delete this message?')" style="font-size:0.7rem;"><i class="fas fa-trash"></i></a>
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
