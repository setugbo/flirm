<?php require_once 'includes/header.php'; ?>
<?php $partner = getPartner(); ?>
<?php $attorneys = getAttorneys(); ?>

<section class="page-hero">
    <div class="container">
        <h1>Our Attorneys</h1>
        <p class="breadcrumb"><a href="<?= SITE_URL ?>">Home</a> / <span>Our Attorneys</span></p>
    </div>
</section>

<section class="section section-white">
    <div class="container">
        <div class="text-center animate-on-scroll">
            <span class="section-tag">Legal Team</span>
            <h2 class="section-title">Meet Our Attorneys</h2>
            <div class="title-line center"></div>
            <p class="section-subtitle">Experienced legal professionals dedicated to protecting your interests.</p>
        </div>

        <?php if ($partner): ?>
        <div class="partner-spotlight animate-on-scroll" style="margin-top:60px;">
            <h3 style="font-family:var(--font-serif);font-size:1.4rem;margin-bottom:4px;">Managing Partner</h3>
            <div class="title-line" style="margin-bottom:32px;"></div>
            <div class="attorney-card attorney-card-featured" data-attorney="<?= htmlspecialchars($partner['name']) ?>">
                <div class="attorney-img">
                    <?php if (imgExists($partner['image_url'] ?? '')): ?>
                    <img src="<?= SITE_URL . htmlspecialchars($partner['image_url']) ?>" alt="<?= htmlspecialchars($partner['name'] ?? '') ?>">
                    <?php else: ?>
                    <div class="attorney-img-placeholder"><?= htmlspecialchars(($partner['name'] ?? 'O')[0]) ?></div>
                    <?php endif; ?>
                </div>
                <div class="attorney-info">
                    <h3 class="attorney-name"><?= htmlspecialchars($partner['name'] ?? '') ?></h3>
                    <div class="attorney-title"><?= htmlspecialchars($partner['title'] ?? 'Managing Partner') ?></div>
                    <div class="attorney-badge">Managing Partner</div>
                    <div class="attorney-bio-full"><?= nl2br(htmlspecialchars($partner['bio'] ?? '')) ?></div>
                    <a href="<?= SITE_URL ?>managing-partner.php" class="attorney-readmore" style="display:inline-block;margin-top:12px;">View Full Profile →</a>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($attorneys)): ?>
        <div class="attorneys-grid" style="margin-top:60px;">
            <h3 style="font-family:var(--font-serif);font-size:1.4rem;margin-bottom:4px;">Our Team</h3>
            <div class="title-line" style="margin-bottom:32px;"></div>
            <?php foreach ($attorneys as $att): ?>
            <div class="attorney-card" data-attorney="<?= htmlspecialchars($att['name']) ?>">
                <div class="attorney-img">
                    <?php if (imgExists($att['image_url'] ?? '')): ?>
                    <img src="<?= SITE_URL . htmlspecialchars($att['image_url']) ?>" alt="<?= htmlspecialchars($att['name']) ?>">
                    <?php else: ?>
                    <div class="attorney-img-placeholder"><?= htmlspecialchars($att['name'][0]) ?></div>
                    <?php endif; ?>
                </div>
                <div class="attorney-info">
                    <h3 class="attorney-name"><?= htmlspecialchars($att['name']) ?></h3>
                    <div class="attorney-title"><?= htmlspecialchars($att['title']) ?></div>
                    <div class="attorney-bio-short"><?= htmlspecialchars($att['short_bio']) ?></div>
                    <?php if (!empty($att['bio'])): ?>
                    <div class="attorney-bio-full"><?= nl2br(htmlspecialchars($att['bio'])) ?></div>
                    <button class="attorney-readmore" onclick="toggleBio(this)">Read More</button>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<script>
function toggleBio(btn) {
    var card = btn.closest('.attorney-card');
    var full = card.querySelector('.attorney-bio-full');
    var short = card.querySelector('.attorney-bio-short');
    if (full.style.display === 'block') {
        full.style.display = 'none';
        if (short) short.style.display = 'block';
        btn.textContent = 'Read More';
    } else {
        full.style.display = 'block';
        if (short) short.style.display = 'none';
        btn.textContent = 'Show Less';
    }
}
</script>

<?php require_once 'includes/footer.php'; ?>
