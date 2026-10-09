<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

include 'conexion.php';

$stmt = $pdo->query("SELECT * FROM productos");
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Control - Inventario</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <div>
                <h2>Inventario General</h2>
                <p>Bienvenido, <strong><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></strong> 👋</p>
            </div>
            <a href="logout.php" class="btn btn-small btn-danger" style="width: auto;">Cerrar Sesión</a>
        </div>
        
        <hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <p>Lista de productos registrados en el sistema.</p>
            <a href="crear.php" class="btn" style="width: auto;">+ Nuevo Producto</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($productos) > 0): ?>
                    <?php foreach ($productos as $prod): ?>
                    <tr>
                        <td><?php echo $prod['id']; ?></td>
                        <td><?php echo htmlspecialchars($prod['nombre_producto']); ?></td>
                        <td>$<?php echo number_format($prod['precio'], 2); ?></td>
                        <td><?php echo $prod['stock']; ?></td>
                        <td>
                            <a href="editar.php?id=<?php echo $prod['id']; ?>">Editar</a> | 
                            <a href="eliminar.php?id=<?php echo $prod['id']; ?>" style="color: #ef4444;" onclick="return confirm('¿Estás segura de eliminar este producto?');">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center; color: #888;">No hay productos registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>