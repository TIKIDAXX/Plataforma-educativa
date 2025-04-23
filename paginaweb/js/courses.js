// Cargar contenido Markdown
async function loadMarkdownContent(mdPath) {
    try {
        const response = await fetch(`/api/markdown.php?file=${encodeURIComponent(mdPath)}`);
        const mdText = await response.text();
        
        // Convertir MD a HTML
        document.getElementById('markdown-content').innerHTML = marked.parse(mdText);
        
        // Resaltar código
        document.querySelectorAll('pre code').forEach((block) => {
            hljs.highlightElement(block);
        });
        
    } catch (error) {
        console.error('Error al cargar el contenido:', error);
        document.getElementById('markdown-content').innerHTML = 
            '<p class="error">Error al cargar el contenido. Intente nuevamente.</p>';
    }
}

// Navegación entre lecciones
document.getElementById('next-lesson').addEventListener('click', () => {
    // Lógica para cargar siguiente lección
});

document.getElementById('prev-lesson').addEventListener('click', () => {
    // Lógica para cargar lección anterior
});

// Cargar lista de cursos recientes
async function loadRecentCourses() {
    const response = await fetch('/api/recent_courses.php');
    const courses = await response.json();
    
    const list = document.getElementById('recent-courses');
    courses.forEach(course => {
        const li = document.createElement('li');
        li.innerHTML = `<a href="#" data-md-path="${course.path}">${course.title}</a>`;
        li.addEventListener('click', () => loadMarkdownContent(course.path));
        list.appendChild(li);
    });
}