<?php 
// Abro las etiquetas de PHP para comenzar con la lógica del servidor en este archivo.

session_start(); 
// Reanudo o inicio la sesión actual para poder verificar si tengo permisos de usuario activo.

if (!isset($_SESSION['usuario_id'])) { 
    // Pregunto si NO existe la variable de sesión 'usuario_id' (es decir, si nadie ha iniciado sesión).

    header("Location: login.php"); 
    // Redirijo inmediatamente al usuario al archivo de inicio de sesión si no está autenticado.

    exit(); 
    // Detengo la ejecución del script para que no se siga cargando el resto de la página.
}

include 'conexion.php'; 
// Incluyo el archivo de conexión para poder usar el objeto PDO y hablar con la base de datos de la tienda.

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    // Verifico si el formulario fue enviado mediante el método HTTP POST (cuando el usuario le da al botón de guardar).

    $nombre = trim($_POST['nombre_producto']); 
    // Recojo el nombre del producto enviado desde el formulario y le quito los espacios vacíos de los extremos con trim().

    $precio = trim($_POST['precio']); 
    // Recojo el precio ingresado en el formulario y le limpio los espacios.

    $stock = trim($_POST['stock']); 
    // Recojo la cantidad de stock ingresada y le limpio los espacios.

    if (!empty($nombre) && !empty($precio) && !empty($stock)) { 
        // Verifico que ninguno de los tres campos esté vacío para asegurar que tengo los datos completos.

        $sql = "INSERT INTO productos (nombre_producto, precio, stock) VALUES (:nombre, :precio, :stock)"; 
        // Escribo mi consulta SQL de tipo INSERT utilizando marcadores seguros (:nombre, :precio, :stock) para evitar inyecciones SQL.

        $stmt = $pdo->prepare($sql); 
        // Preparo la consulta en la base de datos antes de ejecutarla.

        $stmt->execute([
            'nombre' => $nombre,
            'precio' => $precio,
            'stock' => $stock
        ]); 
        // Ejecuto la consulta pasando un arreglo asociativo que reemplaza los marcadores seguros con los valores reales que escribí.

        header("Location: dashboard.php"); 
        // Una vez guardado el producto con éxito en la base de datos, redirijo al usuario de vuelta al panel principal (dashboard).

        exit(); 
        // Detengo la ejecución para asegurarme de que la redirección se ejecute limpiamente.
    }
}
// Cierro las llaves de las condiciones.

?> 
<!-- Cierro la etiqueta de PHP porque a partir de aquí lo que sigue es estructura visual en HTML puro. -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- Defino la codificación de caracteres en UTF-8 para que se lean bien tildes y eñes. -->
    <title>Crear Producto</title>
    <!-- Establezco el título que aparecerá en la pestaña del navegador. -->
</head>
<body>
    <!-- Abro el cuerpo visible de la página web. -->

    <h2>Añadir Nuevo Producto</h2>
    <!-- Muestro un encabezado principal para indicar de qué trata esta pantalla. -->

    <form action="crear.php" method="POST">
    <!-- Creo un formulario que enviará los datos a este mismo archivo ('crear.php') utilizando el método seguro POST. -->

        <label>Nombre del Producto:</label><br>
        <!-- Etiqueta de texto descriptiva para el campo de nombre. -->
        <input type="text" name="nombre_producto" required><br><br>
        <!-- Campo de texto obligatorio para escribir el nombre del producto. -->

        <label>Precio:</label><br>
        <!-- Etiqueta descriptiva para el precio. -->
        <input type="number" step="0.01" name="precio" required><br><br>
        <!-- Campo numérico que acepta decimales (step="0.01") y es obligatorio. -->

        <label>Stock (Cantidad):</label><br>
        <!-- Etiqueta descriptiva para la cantidad en inventario. -->
        <input type="number" name="stock" required><br><br>
        <!-- Campo numérico obligatorio para el stock. -->

        <button type="submit">Guardar Producto</button>
        <!-- Botón que activa el envío del formulario mediante POST. -->
    </form>
    <br>
    <a href="dashboard.php">Volver al panel</a>
    <!-- Un enlace para regresar a la página principal del inventario si no quiero crear nada. -->

</body>
</html>
<!-- Cierro la estructura HTML de la página. -->