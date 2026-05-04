<?php
require_once 'config.php';
echo json_encode(['day' => (int)date('d')]);
