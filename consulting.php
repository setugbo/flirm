<?php require_once 'includes/header.php'; ?>
<?php $consulting = getConsulting(); ?>

<section class="page-hero">
    <div class="container">
        <h1>FLIRM CONSULTING</h1>
        <p class="breadcrumb"><a href="<?= SITE_URL ?>">Home</a> / <span>Consulting</span></p>
    </div>
</section>

<section class="section section-white">
    <div class="container">
        <div class="consulting-grid">
            <div class="consulting-info animate-on-scroll">
                <span class="section-tag">Our Sister Company</span>
                <h2><?= htmlspecialchars($consulting['company_name'] ?? 'FLIRM CONSULTING SERVICES LTD') ?></h2>
                <p class="consulting-tagline"><?= htmlspecialchars($consulting['tagline'] ?? '') ?></p>
                <?php
                $consultingParagraphs = explode("\n", $consulting['content'] ?? '');
                foreach ($consultingParagraphs as $p):
                    $p = trim($p);
                    if (!empty($p)):
                ?>
                <p><?= htmlspecialchars($p) ?></p>
                <?php
                    endif;
                endforeach;
                ?>
                <h3 style="font-family:var(--font-serif); font-size:1.5rem; margin:32px 0 16px;">Our Services</h3>
                <ul class="consulting-services">
                    <li><i class="fas fa-check"></i> Legal Advisory & Property Acquisition</li>
                    <li><i class="fas fa-check"></i> Event Management Services</li>
                    <li><i class="fas fa-check"></i> Property Management Solutions</li>
                    <li><i class="fas fa-check"></i> Administrative Support</li>
                    <li><i class="fas fa-check"></i> Staff Recruitment Services</li>
                    <li><i class="fas fa-check"></i> Project Management Advisory & Execution</li>
                </ul>
                <a href="contact.php" class="btn btn-outline-light" style="margin-top:24px;">Contact Us Today <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="consulting-visual animate-on-scroll">
                <?php if (imgExists($consulting['image_url'] ?? '')): ?>
                <img src="<?= SITE_URL . htmlspecialchars($consulting['image_url']) ?>" alt="FLIRM CONSULTING" style="width:100%;height:auto;object-fit:cover;border:1px solid var(--light-gray);">
                <?php else: ?>
                <div class="consulting-badge" style="padding:50px 40px;">
                    <h3>FLIRM</h3>
                    <h3 style="font-size:1.1rem; font-weight:300; font-style:italic; color:#999;">CONSULTING</h3>
                    <div style="width:40px; height:2px; background:rgba(255,255,255,0.3); margin:16px auto;"></div>
                    <p style="margin-bottom:20px;">Professional Consulting & Support Services</p>
                    <div style="font-size:0.85rem; color:#666;">
                        <div style="margin-bottom:8px;"><i class="fas fa-phone" style="margin-right:8px; color:var(--white);"></i> 08037059291</div>
                        <div><i class="fas fa-envelope" style="margin-right:8px; color:var(--white);"></i> info@flirm.com.ng</div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
