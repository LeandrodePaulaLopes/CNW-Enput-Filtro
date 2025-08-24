<?php
// getColors.php
header('Content-Type: application/json; charset=utf-8');

/* --- REPLACE: coloque suas credenciais aqui --- */
$DB_HOST = 'db';       // nome do serviço MySQL no docker-compose
$DB_USER = 'user';     // definido em MYSQL_USER
$DB_PASS = '1234';     // definido em MYSQL_PASSWORD
$DB_NAME = 'filtro_cores';  // definido em MYSQL_DATABASE
$TABLE   = 'cores';    // continua sendo o nome da tabela que você criou
/* ----------------------------------------------- */

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Erro de conexão: " . $conn->connect_error]);
    exit;
}

$sql = "SELECT nome, hex FROM `$TABLE` ORDER BY nome ASC";
$result = $conn->query($sql);

$colors = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $colors[] = [
            "nome" => $row["nome"],
            "hex"  => $row["hex"]
        ];
    }
}

echo json_encode($colors, JSON_UNESCAPED_UNICODE);
$conn->close();
