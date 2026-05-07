<?php
require_once __DIR__ . '/../backend/config/db.php';
$db = getDB();
$stmt = $db->query("PRAGMA table_info('SOLICITUD')");
foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $c) {
    echo $c['name'] . "\n";
}
