<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

include 'conexion.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM productos WHERE id = :id");
    $stmt->execute(['id' => $id]);
}

header("Location: dashboard.php");
exit();
?>