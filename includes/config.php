<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'flirm_db');

define('SITE_URL', '/liam/');
define('ADMIN_URL', SITE_URL . 'admin/');
define('ASSETS_URL', SITE_URL . 'assets/');
define('ROOT_PATH', realpath(__DIR__ . '/..') . '/');

error_reporting(E_ALL);
ini_set('display_errors', 0);

session_start();
