<?php
session_start();
require 'config/db.php';

// Procesar login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Buscar usuario
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Login exitoso
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_type'] = $user['tipo'];
        $_SESSION['user_name'] = $user['nombre'];
        
        // Redirigir a la página de cursos
        header("Location: cursos.php");
        exit();
    } else {
        $error = "Email o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Plataforma Educativa</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="imagenes/logo_gva.png" alt="Generalitat Valenciana" class="logo">
            <img src="imagenes/logo_ministerio.png" alt="Ministerio de España" class="logo">
            <img src="imagenes/logo_instituto.png" alt="IES Isabel de Villena" class="logo">
        </div>
        <h1>Inicio de Sesión</h1>
    </header>

    <main>
        <section class="auth-form">
            <?php if (isset($_GET['registro']) && $_GET['registro'] === 'exito'): ?>
                <div class="alert success">Registro completado. Por favor inicia sesión.</div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="alert error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form id="loginForm" action="login.php" method="POST">
                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn btn-login">Acceder</button>
                
                <div class="auth-links">
                    <a href="registro.php">¿No tienes cuenta? Regístrate</a>
                    <a href="#">¿Olvidaste tu contraseña?</a>
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
document.getElementById('loginForm').addEventListener('submit', function(e) {
    const email = document.getElementById('email').value;
    
    if (!email.includes('@') || !email.includes('.')) {
        e.preventDefault();
        alert('✉️ Ingresa un email válido');
        document.getElementById('email').focus();
    }
});
</script>
<!-- Al final del archivo -->
<script>
// Validación básica
document.getElementById('loginForm')?.addEventListener('submit', function() {
    const btn = this.querySelector('button[type="submit"]');
    btn.innerHTML = 'Iniciando sesión... <span class="spinner"></span>';
    btn.disabled = true;
});
</script>
</body>
</html>