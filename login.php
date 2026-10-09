<?php
session_start();
include 'conexion.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['password'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Correo o contraseña incorrectos.";
        }
    } else {
        $error = "Por favor, llena todos los campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="login.php" method="POST">
        <h2>Iniciar Sesión</h2>
        <?php if (!empty($error)): ?>
            <p style="color: #ef4444; margin-bottom: 15px;"><?php echo $error; ?></p>
        <?php endif; ?>
        
        <label>Correo Electrónico</label>
        <input type="email" name="email" required placeholder="tu@correo.com">
        
        <label>Contraseña</label>
        <input type="password" name="password" required placeholder="••••••••">
        
        <button type="submit">Entrar</button>
        
        <p style="margin-top: 20px; text-align: center;">
            ¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a>
        </p>
    </form>
</body>
</html>