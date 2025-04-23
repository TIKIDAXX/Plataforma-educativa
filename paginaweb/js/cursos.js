// Función para alternar categorías
function toggleCategory(element) {
    const category = element.parentElement;
    const coursesList = category.querySelector('.courses-list');
    const icon = element.querySelector('i');
    
    // Alternar visualización
    if (coursesList.style.display === 'block') {
        coursesList.style.display = 'none';
        icon.style.transform = 'rotate(0deg)';
    } else {
        coursesList.style.display = 'block';
        icon.style.transform = 'rotate(180deg)';
    }
}

// Función para alternar cursos
function toggleCourse(element) {
    const courseItem = element.parentElement;
    const courseContent = courseItem.querySelector('.course-content');
    const icon = element.querySelector('i');
    
    // Alternar visualización
    if (courseContent.style.display === 'block') {
        courseContent.style.display = 'none';
        icon.style.transform = 'rotate(0deg)';
    } else {
        courseContent.style.display = 'block';
        icon.style.transform = 'rotate(90deg)';
        
        // Cargar contenido Markdown si no está cargado
        const mdContainer = courseContent.querySelector('.markdown-content');
        if (mdContainer.textContent.trim() === 'Cargando contenido...') {
            loadMarkdownContent(mdContainer);
        }
    }
}

// Función para cargar contenido Markdown
async function loadMarkdownContent(container) {
    const mdPath = container.getAttribute('data-md-path');
    
    try {
        const response = await fetch(`/api/markdown.php?file=${encodeURIComponent(mdPath)}`);
        if (!response.ok) throw new Error('Error al cargar el contenido');
        
        const mdText = await response.text();
        container.innerHTML = marked.parse(mdText);
        
        // Resaltar código (opcional)
        if (typeof hljs !== 'undefined') {
            document.querySelectorAll('pre code').forEach(hljs.highlightElement);
        }
    } catch (error) {
        container.innerHTML = `<p class="error">Error al cargar el contenido: ${error.message}</p>`;
    }
}

// Inicialización
document.addEventListener('DOMContentLoaded', function() {
    // Abrir primera categoría por defecto
    document.querySelector('.category-title')?.click();
});