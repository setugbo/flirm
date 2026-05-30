<?php require_once 'header.php'; ?>
<?php
$db = Database::getInstance();
$totalMessages = $db->fetchOne("SELECT COUNT(*) as count FROM contact_messages")['count'];
$unreadMessages = $db->fetchOne("SELECT COUNT(*) as count FROM contact_messages WHERE is_read = 0")['count'];
$totalAreas = $db->fetchOne("SELECT COUNT(*) as count FROM practice_areas")['count'];
$totalReasons = $db->fetchOne("SELECT COUNT(*) as count FROM why_choose_us")['count'];
$recentMessages = $db->fetchAll("SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 5");
?>

<div class="admin-header">
    <h1>Dashboard</h1>
    <div class="admin-user">
        <i class="fas fa-user-circle"></i>
        <span><?= htmlspecialchars($_SESSION['admin_username'] ?? 'Admin') ?></span>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="number"><?= $totalMessages ?></div>
        <div class="label">Total Messages</div>
    </div>
    <div class="stat-card">
        <div class="number"><?= $unreadMessages ?></div>
        <div class="label">Unread</div>
    </div>
    <div class="stat-card">
        <div class="number"><?= $totalAreas ?></div>
        <div class="label">Practice Areas</div>
    </div>
    <div class="stat-card">
        <div class="number"><?= $totalReasons ?></div>
        <div class="label">Why Choose Items</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Recent Messages</h3>
        <a href="messages.php" class="btn btn-black btn-sm">View All</a>
    </div>
    <div class="card-body">
        <?php if (empty($recentMessages)): ?>
        <p style="color:#888; text-align:center; padding:20px;">No messages yet.</p>
        <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentMessages as $msg): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($msg['name']) ?></strong></td>
                        <td><?= htmlspecialchars($msg['email']) ?></td>
                        <td><?= htmlspecialchars($msg['subject'] ?: 'No subject') ?></td>
                        <td><?= formatDate($msg['created_at']) ?></td>
                        <td><?= $msg['is_read'] ? 'Read' : '<strong style="color:#000;">Unread</strong>' ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Quick Links</h3>
    </div>
    <div class="card-body">
        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(200px, 1fr)); gap:12px;">
            <a href="hero.php" style="padding:16px; background:#fafafa; border:1px solid var(--admin-border); text-align:center; font-weight:500;">Hero Section</a>
            <a href="about.php" style="padding:16px; background:#fafafa; border:1px solid var(--admin-border); text-align:center; font-weight:500;">About Us</a>
            <a href="practice-areas.php" style="padding:16px; background:#fafafa; border:1px solid var(--admin-border); text-align:center; font-weight:500;">Practice Areas</a>
            <a href="attorneys.php" style="padding:16px; background:#fafafa; border:1px solid var(--admin-border); text-align:center; font-weight:500;">Our Attorneys</a>
            <a href="managing-partner.php" style="padding:16px; background:#fafafa; border:1px solid var(--admin-border); text-align:center; font-weight:500;">Managing Partner</a>
            <a href="mission.php" style="padding:16px; background:#fafafa; border:1px solid var(--admin-border); text-align:center; font-weight:500;">Mission & Vision</a>
            <a href="messages.php" style="padding:16px; background:#fafafa; border:1px solid var(--admin-border); text-align:center; font-weight:500;">View Messages</a>
            <a href="ndpr-compliance.php" style="padding:16px; background:#fafafa; border:1px solid var(--admin-border); text-align:center; font-weight:500;">NDPR Compliance</a>
            <a href="privacy-policy.php" style="padding:16px; background:#fafafa; border:1px solid var(--admin-border); text-align:center; font-weight:500;">Privacy Policy</a>
            <a href="whistleblowing.php" style="padding:16px; background:#fafafa; border:1px solid var(--admin-border); text-align:center; font-weight:500;">Whistleblowing</a>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>
