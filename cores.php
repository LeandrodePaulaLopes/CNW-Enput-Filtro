<?php
header('Content-Type: application/json');

// Conexão com o banco
$host = "localhost";
$dbname = "filtro_cores";
$user = "root";      // ajuste conforme seu usuário
$pass = "";          // ajuste conforme sua senha

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Selecionar todas as cores
    $stmt = $pdo->prepare("SELECT nome, hex FROM cores ORDER BY id ASC");
    $stmt->execute();
    $cores = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retornar JSON
    echo json_encode($cores);

} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
