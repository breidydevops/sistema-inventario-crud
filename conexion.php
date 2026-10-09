<?php
$host = 'sql210.infinityfree.com'; 
$db   = 'if0_43127194_mi_tienda_db'; // (Asegúrate de cambiar "XXX" por el nombre completo exacto que te muestra el panel de tu base de datos)
$user = 'if0_43127194'; 
$pass = 'WKanRlWloaTVX'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}
?>