<?php
header('Content-Type: text/plain');

// Ruta base corregida para InfinityFree
$baseDir = __DIR__ . '/../cursos/';
$requestedFile = $_GET['file'] ?? '';

// Debug: Verificar parámetro
error_log("Archivo solicitado: " . $requestedFile);

// Validación de seguridad
if (empty($requestedFile)) {
    http_response_code(400);
    die("ERROR: No se especificó archivo");
}

// Construir ruta completa
$fullPath = realpath($baseDir . $requestedFile);
$baseDirReal = realpath($baseDir);

// Debug: Verificar rutas
error_log("Ruta base: " . $baseDirReal);
error_log("Ruta completa: " . $fullPath);

// Verificar que el archivo esté dentro del directorio permitido
if ($fullPath === false || strpos($fullPath, $baseDirReal) !== 0) {
    http_response_code(403);
    die("ERROR: Acceso no autorizado al archivo");
}

// Verificar que el archivo exista y sea .md
if (!file_exists($fullPath)) {
    http_response_code(404);
    die("ERROR: Archivo no encontrado");
}

if (pathinfo($fullPath, PATHINFO_EXTENSION) !== 'md') {
    http_response_code(400);
    die("ERROR: Solo se permiten archivos .md");
}

// Leer y mostrar el contenido
readfile($fullPath);
?>