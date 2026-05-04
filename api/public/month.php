<?php
require_once 'config.php';
echo json_encode(['month' => (int)date('m')]);
