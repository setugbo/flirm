<?php
require_once 'db.php';

function getSetting($key) {
    $db = Database::getInstance();
    $settings = $db->fetchOne("SELECT * FROM site_settings WHERE id = 1");
    return $settings[$key] ?? '';
}

function getHero() {
    return Database::getInstance()->fetchOne("SELECT * FROM hero_section WHERE is_active = 1 LIMIT 1");
}

function getAbout() {
    return Database::getInstance()->fetchOne("SELECT * FROM about_section WHERE is_active = 1 LIMIT 1");
}

function getPartner() {
    return Database::getInstance()->fetchOne("SELECT * FROM managing_partner WHERE is_active = 1 LIMIT 1");
}

function getPracticeAreas() {
    return Database::getInstance()->fetchAll("SELECT * FROM practice_areas WHERE is_active = 1 ORDER BY display_order ASC");
}

function getWhyChooseUs() {
    return Database::getInstance()->fetchAll("SELECT * FROM why_choose_us WHERE is_active = 1 ORDER BY display_order ASC");
}

function getMission() {
    return Database::getInstance()->fetchOne("SELECT * FROM mission_vision WHERE type = 'mission' AND is_active = 1 LIMIT 1");
}

function getVision() {
    return Database::getInstance()->fetchOne("SELECT * FROM mission_vision WHERE type = 'vision' AND is_active = 1 LIMIT 1");
}

function getContactInfo() {
    return Database::getInstance()->fetchOne("SELECT * FROM contact_info WHERE is_active = 1 LIMIT 1");
}

function getSocialMedia() {
    return Database::getInstance()->fetchAll("SELECT * FROM social_media WHERE is_active = 1 ORDER BY display_order ASC");
}

function getConsulting() {
    return Database::getInstance()->fetchOne("SELECT * FROM consulting_section WHERE is_active = 1 LIMIT 1");
}

function getFooterContent() {
    return Database::getInstance()->fetchOne("SELECT * FROM footer_content WHERE id = 1");
}

function getPageContent($key) {
    $db = Database::getInstance();
    return $db->fetchOne("SELECT * FROM page_content WHERE page_key = '" . $db->escape($key) . "' LIMIT 1");
}

function getPageTitle($page) {
    $titles = [
        'home' => 'FLIRM SOLICITORS | Professional Legal Services in Lagos, Nigeria',
        'about' => 'About Us | FLIRM SOLICITORS',
        'practice-areas' => 'Practice Areas | FLIRM SOLICITORS',
        'managing-partner' => 'Managing Partner | FLIRM SOLICITORS',
        'consulting' => 'FLIRM CONSULTING SERVICES LTD',
        'contact' => 'Contact Us | FLIRM SOLICITORS',
        'ndpr-compliance' => 'NDPR Compliance | FLIRM SOLICITORS',
        'privacy-policy' => 'Privacy Policy | FLIRM SOLICITORS',
        'whistleblowing' => 'Whistleblowing Policy | FLIRM SOLICITORS',
    ];
    return $titles[$page] ?? 'FLIRM SOLICITORS';
}

function isAdminLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function requireAdmin() {
    if (!isAdminLoggedIn()) {
        header('Location: ' . ADMIN_URL . 'index.php');
        exit;
    }
}

function truncate($text, $limit = 100) {
    if (strlen($text) <= $limit) return $text;
    return substr($text, 0, $limit) . '...';
}

function formatDate($date) {
    return date('F j, Y', strtotime($date));
}

function activeNav($page) {
    return '';
}

function imgExists($path) {
    return !empty($path) && file_exists(ROOT_PATH . $path);
}

function imgTag($path, $alt = '', $style = '') {
    if (imgExists($path)):
        ?><img src="<?= SITE_URL . htmlspecialchars($path) ?>" alt="<?= htmlspecialchars($alt) ?>" style="<?= $style ?>"><?php
    endif;
}

function handleFileUpload($file) {
    if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'No file uploaded.'];
    }
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'ico'];
    $maxSize = 5 * 1024 * 1024;
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed)) {
        return ['success' => false, 'message' => 'Invalid file type. Allowed: ' . implode(', ', $allowed)];
    }
    if ($file['size'] > $maxSize) {
        return ['success' => false, 'message' => 'File too large. Max 5MB.'];
    }
    $uploadDir = ROOT_PATH . 'uploads/';
    $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file['name']);
    if (move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
        return ['success' => true, 'path' => 'uploads/' . $filename, 'url' => SITE_URL . 'uploads/' . $filename];
    }
    return ['success' => false, 'message' => 'Failed to save file.'];
}
