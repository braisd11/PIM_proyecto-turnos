<?php
$db = new PDO('sqlite:' . __DIR__ . '/database.db');
$stmt = $db->query("PRAGMA table_info('SOLICITUD')");
$cols = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($cols as $c) {
    echo $c['cid'] . ': ' . $c['name'] . ' ' . $c['type'] . "\n";
}
