<?php
require_once dirname(__DIR__) . '/includes/config.php';
require_once dirname(__DIR__) . '/includes/functions.php';
requireAdmin();

$result = handleFileUpload($_FILES['file'] ?? null);
header('Content-Type: application/json');
echo json_encode($result);
