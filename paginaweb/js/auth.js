// Validación de registro
document.getElementById('registerForm')?.addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    
    if (password !== confirmPassword) {
        e.preventDefault();
        alert('Las contraseñas no coinciden');
    }
});

// Validación de login (puedes ampliarla)
document.getElementById('loginForm')?.addEventListener('submit', function(e) {
    const email = document.getElementById('email').value;
    
    if (!email.includes('@') || !email.includes('.')) {
        e.preventDefault();
        alert('Ingrese un correo válido');
    }
});