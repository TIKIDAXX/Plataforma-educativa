<?php
session_start();
require 'config/db.php';

// Verificar si es admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] !== 3) {
    header("Location: login.php");
    exit();
}<?php
session_start();
require 'config/db.php';

// Verificar si es admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] !== 10) {
    header("Location: login.php");
    exit();
}

// Procesar formulario para añadir cursos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $categoria = $_POST['categoria'] ?? '';
    $ruta_md = $_POST['ruta_md'] ?? '';
    
    $stmt = $pdo->prepare("INSERT INTO cursos (titulo, categoria, ruta_md) VALUES (?, ?, ?)");
    $stmt->execute([$titulo, $categoria, $ruta_md]);
    
    $mensaje = "Curso añadido correctamente";
}

// Obtener todos los cursos
$stmt = $pdo->query("SELECT * FROM cursos");
$cursos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Cursos</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .form-container {
            margin-bottom: 30px;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="imagenes/logo_gva.png" alt="Generalitat Valenciana" class="logo">
            <img src="imagenes/logo_ministerio.png" alt="Ministerio de España" class="logo">
            <img src="imagenes/logo_instituto.png" alt="IES Isabel de Villena" class="logo">
        </div>
        <h1>Panel de Administración de Cursos</h1>
        <nav>
            <a href="logout.php">Cerrar Sesión</a>
        </nav>
    </header>

    <main>
        <section class="admin-panel">
            <?php if (isset($mensaje)): ?>
                <div class="alert success"><?= htmlspecialchars($mensaje) ?></div>
            <?php endif; ?>

            <div class="form-container">
                <h2>Añadir Nuevo Curso</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input type="text" id="titulo" name="titulo" required>
                    </div>
                    
                    
                
                    <div class="form-group">
                    <label for="categoria">Categoría:</label>
                    <select id="categoria" name="categoria" required>
                        <option value="">Seleccione...</option>
                        <option value="Database Management">Database Management</option>
                        <option value="Redes de Ordenadores">Redes de Ordenadores:</option>
                    </select>
                </div>
                    
                    <div class="form-group">
                        <label for="ruta_md">Ruta del archivo MD:</label>
                        <input type="text" id="ruta_md" name="ruta_md" required>
                    </div>
                    
                    <button type="submit" class="btn">Añadir Curso</button>
                </form>
            </div>

            <h2>Cursos Existentes</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Categoría</th>
                        <th>Ruta MD</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cursos as $curso): ?>
                        <tr>
                            <td><?= htmlspecialchars($curso['id']) ?></td>
                            <td><?= htmlspecialchars($curso['titulo']) ?></td>
                            <td><?= htmlspecialchars($curso['categoria']) ?></td>
                            <td><?= htmlspecialchars($curso['ruta_md']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <p>Plataforma desarrollada por <strong>Said Rais</strong> - 1ASIR</p>
            <p>IES Isabel de Villena - Curso 2023/2024</p>
        </div>
    </footer>
</body>
</html>

// Procesar formulario para añadir cursos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $categoria = $_POST['categoria'] ?? '';
    $ruta_md = $_POST['ruta_md'] ?? '';
    
    $stmt = $pdo->prepare("INSERT INTO cursos (titulo, categoria, ruta_md) VALUES (?, ?, ?)");
    $stmt->execute([$titulo, $categoria, $ruta_md]);
    
    $mensaje = "Curso añadido correctamente";
}

// Obtener todos los cursos
$stmt = $pdo->query("SELECT * FROM cursos");
$cursos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Cursos</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .form-container {
            margin-bottom: 30px;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="imagenes/logo_gva.png" alt="Generalitat Valenciana" class="logo">
            <img src="imagenes/logo_ministerio.png" alt="Ministerio de España" class="logo">
            <img src="imagenes/logo_instituto.png" alt="IES Isabel de Villena" class="logo">
        </div>
        <h1>Panel de Administración de Cursos</h1>
        <nav>
            <a href="logout.php">Cerrar Sesión</a>
        </nav>
    </header>

    <main>
        <section class="admin-panel">
            <?php if (isset($mensaje)): ?>
                <div class="alert success"><?= htmlspecialchars($mensaje) ?></div>
            <?php endif; ?>

            <div class="form-container">
                <h2>Añadir Nuevo Curso</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input type="text" id="titulo" name="titulo" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="categoria">Categoría:</label>
                        <input type="text" id="categoria" name="categoria" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="ruta_md">Ruta del archivo MD:</label>
                        <input type="text" id="ruta_md" name="ruta_md" required>
                    </div>
                    
                    <button type="submit" class="btn">Añadir Curso</button>
                </form>
            </div>

            <h2>Cursos Existentes</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Categoría</th>
                        <th>Ruta MD</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cursos as $curso): ?>
                        <tr>
                            <td><?= htmlspecialchars($curso['id']) ?></td>
                            <td><?= htmlspecialchars($curso['titulo']) ?></td>
                            <td><?= htmlspecialchars($curso['categoria']) ?></td>
                            <td><?= htmlspecialchars($curso['ruta_md']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <p>Plataforma desarrollada por <strong>Said Rais</strong> - 1ASIR</p>
            <p>IES Isabel de Villena - Curso 2023/2024</p>
        </div>
    </footer>
</body>
</html>
