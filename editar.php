<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

include 'conexion.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: dashboard.php");
    exit();
}

// Si se envió el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre_producto']);
    $precio = trim($_POST['precio']);
    $stock = trim($_POST['stock']);

    if (!empty($nombre) && !empty($precio) && !empty($stock)) {
        $sql = "UPDATE productos SET nombre_producto = :nombre, precio = :precio, stock = :stock WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nombre' => $nombre,
            'precio' => $precio,
            'stock' => $stock,
            'id' => $id
        ]);
        header("Location: dashboard.php");
        exit();
    }
}

// Buscar los datos actuales del producto
$stmt = $pdo->prepare("SELECT * FROM productos WHERE id = :id");
$stmt->execute(['id' => $id]);
$producto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
</head>
<body>
    <h2>Editar Producto</h2>
    <form action="editar.php?id=<?php echo $producto['id']; ?>" method="POST">
        <label>Nombre del Producto:</label><br>
        <input type="text" name="nombre_producto" value="<?php echo htmlspecialchars($producto['nombre_producto']); ?>" required><br><br>

        <label>Precio:</label><br>
        <input type="number" step="0.01" name="precio" value="<?php echo $producto['precio']; ?>" required><br><br>

        <label>Stock (Cantidad):</label><br>
        <input type="number" name="stock" value="<?php echo $producto['stock']; ?>" required><br><br>

        <button type="submit">Actualizar Producto</button>
    </form>
    <br>
    <a href="dashboard.php">Volver al panel</a>
</body>
</html>