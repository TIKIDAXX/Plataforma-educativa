<?php
// Conexión a la base de datos
require 'config/db.php';

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $tipo = $_POST['user_type'] === 'teacher' ? 'profesor' : 'estudiante';

    // Validar datos
    if (empty($nombre) || empty($apellidos) || empty($email) || empty($password)) {
        $error = "Todos los campos son obligatorios";
    } elseif ($_POST['password'] !== $_POST['confirm_password']) {
        $error = "Las contraseñas no coinciden";
    } else {
        // Hash de la contraseña
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        // Insertar en la base de datos
        try {
            $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, apellidos, email, password, tipo) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nombre, $apellidos, $email, $passwordHash, $tipo]);
            // Enviar notificación por correo
$to = 'hap.mestre77@gmail.com'; // Cambia esto a tu correo real
$subject = '📥 Nuevo registro en la plataforma';
$message = "Nuevo usuario registrado:\n\nNombre: $nombre $apellidos\nEmail: $email\nTipo: $tipo";
$headers = 'From: notificaciones@tusitio.com' . "\r\n" .
           'Reply-To: notificaciones@tusitio.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

            
            // Redirigir al login
            header("Location: login.php?registro=exito");
            exit();
        } catch (PDOException $e) {
            $error = "Error al registrar el usuario: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Plataforma Educativa</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="imagenes/logo_gva.png" alt="Generalitat Valenciana" class="logo">
            <img src="imagenes/logo_ministerio.png" alt="Ministerio de España" class="logo">
            <img src="imagenes/logo_instituto.png" alt="IES Isabel de Villena" class="logo">
        </div>
        <h1>Registro de Usuario</h1>
    </header>

    <main>
        <section class="auth-form">
            <?php if (isset($error)): ?>
                <div class="alert error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form id="registerForm" action="registro.php" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                
                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" minlength="8" required>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirmar Contraseña:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                
                <div class="form-group">
                    <label for="user_type">Tipo de Usuario:</label>
                    <select id="user_type" name="user_type" required>
                        <option value="">Seleccione...</option>
                        <option value="student">Estudiante</option>
                        <option value="teacher">Profesor</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-register">Crear Cuenta</button>
                
                <div class="auth-links">
                    <a href="login.php">¿Ya tienes cuenta? Inicia Sesión</a>
                </div>
            </form>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <p>Plataforma desarrollada por <strong>Said Rais</strong> - 1ASIR</p>
            <p>IES Isabel de Villena - Curso 2023/2024</p>
        </div>
    </footer>
    <script>
document.getElementById('registerForm').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    
    if (password !== confirmPassword) {
        e.preventDefault(); // Detiene el envío
        alert('⚠️ Las contraseñas no coinciden');
        document.getElementById('confirm_password').focus();
    }
});
const btn = this.querySelector('button[type="submit"]');
        btn.innerHTML = 'Registrando... <span class="spinner"></span>';
        btn.disabled = true;
    });
}
</script>
</body>
</html>
