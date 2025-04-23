// Validación de registro
document.getElementById('registerForm')?.addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    
    if (password !== confirmPassword) {
        e.preventDefault();
        showAlert('Las contraseñas no coinciden', 'error');
        document.getElementById('confirm_password').focus();
    }
    
    if (password.length < 8) {
        e.preventDefault();
        showAlert('La contraseña debe tener al menos 8 caracteres', 'error');
    }
});

// Validación de login
document.getElementById('loginForm')?.addEventListener('submit', function(e) {
    const email = document.getElementById('email').value;
    
    if (!isValidEmail(email)) {
        e.preventDefault();
        showAlert('Por favor ingresa un email válido', 'error');
    }
});

// Función para validar email
function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}