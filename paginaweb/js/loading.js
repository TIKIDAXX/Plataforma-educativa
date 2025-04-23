// Mostrar loading en formularios
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.innerHTML = '<span class="spinner"></span> Procesando...';
            submitBtn.disabled = true;
        }
    });
});

// Función para mostrar loading en toda la página
function showFullPageLoading() {
    const loader = document.createElement('div');
    loader.className = 'full-page-loader';
    loader.innerHTML = `
        <div class="spinner"></div>
        <p>Cargando...</p>
    `;
    document.body.appendChild(loader);
}

// Función para ocultar loading
function hideFullPageLoading() {
    const loader = document.querySelector('.full-page-loader');
    if (loader) {
        loader.remove();
    }
}