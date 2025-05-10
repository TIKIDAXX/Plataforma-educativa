<?php
session_start();
require 'config/db.php';

// Verificar sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Obtener cursos de la base de datos
$stmt = $pdo->query("SELECT * FROM cursos ORDER BY categoria, titulo");
$cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Organizar por categoría
$cursosPorCategoria = [
    'Database Management' => [],
    'Redes de Ordenadores' => []
];

foreach ($cursos as $curso) {
    $cursosPorCategoria[$curso['categoria']][] = $curso;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos - Plataforma Educativa</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/cursos.css">
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="imagenes/logo_gva.png" alt="Generalitat Valenciana" class="logo">
            <img src="imagenes/logo_ministerio.png" alt="Ministerio de España" class="logo">
            <img src="imagenes/logo_instituto.png" alt="IES Isabel de Villena" class="logo">
        </div>
        <h1>Bienvenido, <?= htmlspecialchars($_SESSION['user_name']) ?></h1>
        <a href="logout.php" class="btn-logout">Cerrar sesión</a>
    </header>

    <main class="courses-container">
        <!-- Sección Database Management -->
        <section class="course-category">
            <h2 class="category-title" onclick="toggleCategory(this)">
                <span>Database Management</span>
                <i class="fas fa-chevron-down"></i>
            </h2>
            
            <div class="courses-list">
                <?php foreach ($cursosPorCategoria['Database Management'] as $curso): ?>
                <div class="course-item">
                    <h3 class="course-title" onclick="toggleCourse(this)">
                        <?= htmlspecialchars($curso['titulo']) ?>
                        <i class="fas fa-chevron-right"></i>
                    </h3>
                    <div class="course-content">
                        <div class="markdown-content" data-md-path="<?= htmlspecialchars($curso['ruta_md']) ?>">
                            Cargando contenido...
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Sección Redes -->
        <section class="course-category">
            <h2 class="category-title" onclick="toggleCategory(this)">
                <span>Planificación y Administración de Redes</span>
                <i class="fas fa-chevron-down"></i>
            </h2>
            
            <div class="courses-list">
                <?php foreach ($cursosPorCategoria['Redes de Ordenadores'] as $curso): ?>
                <div class="course-item">
                    <h3 class="course-title" onclick="toggleCourse(this)">
                        <?= htmlspecialchars($curso['titulo']) ?>
                        <i class="fas fa-chevron-right"></i>
                    </h3>
                    <div class="course-content">
                        <div class="markdown-content" data-md-path="<?= htmlspecialchars($curso['ruta_md']) ?>">
                            Cargando contenido...
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <p>Plataforma desarrollada por <strong>Said Rais</strong> - 1ASIR</p>
            <p>IES Isabel de Villena - Curso 2023/2024</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script src="js/cursos.js"></script>
</body>
</html>
