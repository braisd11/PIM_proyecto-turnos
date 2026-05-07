<?php

function getDB()
{
    static $db = null;

    if ($db === null) {
        $db = new PDO('sqlite:' . __DIR__ . '/../../database/database.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        ensureSolicitudColumns($db);
    }

    return $db;
}

function ensureSolicitudColumns(PDO $db)
{
    $columns = $db->query("PRAGMA table_info('SOLICITUD')")->fetchAll(PDO::FETCH_ASSOC);
    $existing = array_column($columns, 'name');

    $toAdd = [
        'fecha_inicio' => 'TEXT',
        'fecha_fin' => 'TEXT',
        'fecha_turno_actual' => 'TEXT',
        'turno_actual' => 'TEXT',
        'fecha_turno_nuevo' => 'TEXT',
        'turno_nuevo' => 'TEXT',
        'respuesta_admin' => 'TEXT'
    ];

    foreach ($toAdd as $name => $type) {
        if (!in_array($name, $existing, true)) {
            $db->exec("ALTER TABLE SOLICITUD ADD COLUMN $name $type");
        }
    }
}
