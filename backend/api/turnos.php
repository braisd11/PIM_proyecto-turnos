<?php
require_once __DIR__ . '/../config/db.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];

function ensureDescripcionColumn($db)
{
    $cols = $db->query("PRAGMA table_info('TURNO')")->fetchAll(PDO::FETCH_ASSOC);
    $has = false;
    foreach ($cols as $c) {
        if ($c['name'] === 'descripcion') {
            $has = true;
            break;
        }
    }
    if (!$has) {
        $db->exec("ALTER TABLE TURNO ADD COLUMN descripcion TEXT");
    }
}

try {
    $db = getDB();
    ensureDescripcionColumn($db);

    if ($method === 'OPTIONS') {
        http_response_code(200);
        exit;
    }

    if ($method === 'GET') {
        $stmt = $db->query('SELECT t.id_turno AS id, t.hora_inicio AS start, t.hora_fin AS end, t.id_empleado AS resource, IFNULL(t.descripcion, "") AS text FROM TURNO t');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rows);
        exit;
    }

    $data = json_decode(file_get_contents('php://input'), true);

    if ($method === 'POST') {
        // create cuadrante if needed (based on start date)
        $start = new DateTime($data['start']);
        $month = (int)$start->format('n');
        $year = (int)$start->format('Y');
        $dias = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $stmt = $db->prepare('SELECT id_cuadrante FROM CUADRANTE WHERE mes = ? AND anio = ? LIMIT 1');
        $stmt->execute([$month, $year]);
        $cuadr = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$cuadr) {
            $stmt = $db->prepare('INSERT INTO CUADRANTE (mes, anio, dias_mes) VALUES (?, ?, ?)');
            $stmt->execute([$month, $year, $dias]);
            $id_cuadrante = $db->lastInsertId();
        } else {
            $id_cuadrante = $cuadr['id_cuadrante'];
        }

        $dia_mes = (int)$start->format('j');
        $hora_inicio = $data['start'];
        $hora_fin = $data['end'];
        $id_empleado = $data['resource'];
        $descripcion = isset($data['text']) ? $data['text'] : '';

        $stmt = $db->prepare('INSERT INTO TURNO (hora_inicio, hora_fin, dia_mes, id_empleado, id_cuadrante, descripcion) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$hora_inicio, $hora_fin, $dia_mes, $id_empleado, $id_cuadrante, $descripcion]);
        $id = $db->lastInsertId();

        echo json_encode(['id' => $id]);
        exit;
    }

    if ($method === 'PUT') {
        $id = $data['id'];
        $start = $data['start'];
        $end = $data['end'];
        $resource = $data['resource'];
        $text = isset($data['text']) ? $data['text'] : '';

        $dia_mes = (new DateTime($start))->format('j');

        $stmt = $db->prepare('UPDATE TURNO SET hora_inicio = ?, hora_fin = ?, dia_mes = ?, id_empleado = ?, descripcion = ? WHERE id_turno = ?');
        $stmt->execute([$start, $end, $dia_mes, $resource, $text, $id]);

        echo json_encode(['ok' => true]);
        exit;
    }

    if ($method === 'DELETE') {
        // id can come from query param or request body
        parse_str(file_get_contents('php://input'), $deldata);
        $id = isset($deldata['id']) ? $deldata['id'] : ($_GET['id'] ?? null);
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing id']);
            exit;
        }
        $stmt = $db->prepare('DELETE FROM TURNO WHERE id_turno = ?');
        $stmt->execute([$id]);
        echo json_encode(['ok' => true]);
        exit;
    }

    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
