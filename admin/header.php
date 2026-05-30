<?php
require_once dirname(__DIR__) . '/includes/config.php';
require_once dirname(__DIR__) . '/includes/functions.php';
requireAdmin();
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - FLIRM SOLICITORS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<div class="admin-layout">
    <aside class="admin-sidebar">
        <div class="sidebar-brand">
            <a href="dashboard.php">FLIRM <span>Admin</span></a>
            <small>Control Panel</small>
        </div>
        <nav class="sidebar-nav">
            <a href="dashboard.php" class="<?= $current_page == 'dashboard' ? 'active' : '' ?>">
                <i class="fas fa-th-large"></i> <span>Dashboard</span>
            </a>
            <a href="hero.php" class="<?= $current_page == 'hero' ? 'active' : '' ?>">
                <i class="fas fa-image"></i> <span>Hero Section</span>
            </a>
            <a href="about.php" class="<?= $current_page == 'about' ? 'active' : '' ?>">
                <i class="fas fa-info-circle"></i> <span>About Us</span>
            </a>
            <a href="practice-areas.php" class="<?= $current_page == 'practice-areas' ? 'active' : '' ?>">
                <i class="fas fa-briefcase"></i> <span>Practice Areas</span>
            </a>
            <a href="attorneys.php" class="<?= $current_page == 'attorneys' || $current_page == 'attorneys-form' ? 'active' : '' ?>">
                <i class="fas fa-users"></i> <span>Our Attorneys</span>
            </a>
            <a href="managing-partner.php" class="<?= $current_page == 'managing-partner' ? 'active' : '' ?>">
                <i class="fas fa-user-tie"></i> <span>Managing Partner</span>
            </a>
            <a href="why-choose.php" class="<?= $current_page == 'why-choose' ? 'active' : '' ?>">
                <i class="fas fa-star"></i> <span>Why Choose Us</span>
            </a>
            <a href="mission.php" class="<?= $current_page == 'mission' ? 'active' : '' ?>">
                <i class="fas fa-bullseye"></i> <span>Mission & Vision</span>
            </a>
            <a href="consulting.php" class="<?= $current_page == 'consulting' ? 'active' : '' ?>">
                <i class="fas fa-building"></i> <span>Consulting</span>
            </a>
            <a href="contact.php" class="<?= $current_page == 'contact' ? 'active' : '' ?>">
                <i class="fas fa-address-card"></i> <span>Contact Info</span>
            </a>
            <a href="social.php" class="<?= $current_page == 'social' ? 'active' : '' ?>">
                <i class="fas fa-share-alt"></i> <span>Social Media</span>
            </a>
            <a href="footer-content.php" class="<?= $current_page == 'footer-content' ? 'active' : '' ?>">
                <i class="fas fa-window-maximize"></i> <span>Footer</span>
            </a>
            <a href="ndpr-compliance.php" class="<?= $current_page == 'ndpr-compliance' ? 'active' : '' ?>">
                <i class="fas fa-shield-alt"></i> <span>NDPR Compliance</span>
            </a>
            <a href="privacy-policy.php" class="<?= $current_page == 'privacy-policy' ? 'active' : '' ?>">
                <i class="fas fa-file-alt"></i> <span>Privacy Policy</span>
            </a>
            <a href="whistleblowing.php" class="<?= $current_page == 'whistleblowing' ? 'active' : '' ?>">
                <i class="fas fa-exclamation-triangle"></i> <span>Whistleblowing</span>
            </a>
            <a href="settings.php" class="<?= $current_page == 'settings' ? 'active' : '' ?>">
                <i class="fas fa-cog"></i> <span>Site Settings</span>
            </a>
            <a href="messages.php" class="<?= $current_page == 'messages' ? 'active' : '' ?>">
                <i class="fas fa-envelope"></i> <span>Messages</span>
            </a>
        </nav>
        <div class="sidebar-footer">
            <a href="change-password.php"><i class="fas fa-key"></i> <span>Change Password</span></a>
            <a href="logout.php" style="margin-top:8px;"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
        </div>
    </aside>
    <main class="admin-main">
