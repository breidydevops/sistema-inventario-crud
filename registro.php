<?php
// Incluyo el archivo de conexión para poder usar el objeto PDO y comunicarme con la base de datos.
include 'conexion.php';

// Inicializo una variable vacía para guardar los mensajes de éxito o de error que se mostrarán en pantalla.
$mensaje = "";

// Verifico si el formulario fue enviado mediante el método HTTP POST (cuando la persona hace clic en registrarse).
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Recojo los datos enviados por el formulario y les quito los espacios vacíos sobrantes al inicio y al final con trim().
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Compruebo que ninguno de los campos obligatorios esté vacío antes de continuar.
    if (!empty($nombre) && !empty($email) && !empty($password)) {
        
        // Encripto la contraseña convirtiéndola en un hash seguro e irreversible antes de guardarla.
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        try {
            // Escribo mi consulta SQL de tipo INSERT usando marcadores seguros para evitar inyecciones SQL.
            $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)";
            
            // Preparo la consulta en la base de datos.
            $stmt = $pdo->prepare($sql);
            
            // Ejecuto la consulta pasando los valores limpios y la contraseña ya encriptada.
            $stmt->execute([
                'nombre' => $nombre,
                'email' => $email,
                'password' => $passwordHash
            ]);
            
            // Si todo sale bien, guardo un mensaje de éxito con un enlace directo para iniciar sesión.
            $mensaje = "¡Registro exitoso! <a href='login.php'>Inicia sesión aquí</a>";
            
        } catch (\PDOException $e) {
            // Si ocurre un error (por ejemplo, si el correo ya existe), lo atrapo aquí.
            $mensaje = "Error: El correo electrónico ya está registrado.";
        }
    } else {
        // Si algún campo venía vacío, aviso al usuario.
        $mensaje = "Por favor, completa todos los campos.";
    }
}
// Cierro las etiquetas de PHP para pasar a la estructura HTML visual.
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- Defino el título que aparecerá en la pestaña del navegador. -->
    <title>Registro de Usuario</title>
    <!-- Conecto mi hoja de estilos centralizada para darle el diseño minimalista y moderno. -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Creo el formulario envuelto en los estilos de tarjeta centralizada -->
    <form action="registro.php" method="POST">
        <h2>Registro de Usuario</h2>
        
        <!-- Muestro el mensaje de error o éxito solo si la variable tiene contenido -->
        <?php if (!empty($mensaje)): ?>
            <p style="color: #4f46e5; margin-bottom: 15px;"><?php echo $mensaje; ?></p>
        <?php endif; ?>
        
        <label>Nombre</label>
        <input type="text" name="nombre" required placeholder="Tu nombre completo" autocomplete="off">
        
        <label>Correo Electrónico</label>
        <input type="email" name="email" required placeholder="tu@correo.com" autocomplete="off">
        
        <label>Contraseña</label>
        <!-- Agregué autocomplete="new-password" para evitar que el navegador rellene los puntos automáticamente -->
        <input type="password" name="password" required placeholder="Mínimo 6 caracteres" autocomplete="new-password">
        
        <button type="submit">Registrarse</button>
        
        <p style="margin-top: 20px; text-align: center;">
            ¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a>
        </p>
    </form>
</body>
</html>