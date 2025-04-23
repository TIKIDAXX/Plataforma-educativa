#!/bin/bash
# =============================================
# CONFIGURACIÓN DE SEGURIDAD PARA AMBOS SERVIDORES
# =============================================

# 1. Instalar herramientas de seguridad
echo "📦 Instalando herramientas de seguridad..."
sudo apt install -y \
    fail2ban \
    rkhunter \
    lynis \
    libpam-pwquality

# 2. Configurar políticas de contraseñas
echo "🔑 Configurando políticas de contraseñas..."
sudo tee /etc/security/pwquality.conf > /dev/null <<EOL
minlen = 12
minclass = 3
maxrepeat = 3
maxsequence = 4
EOL

# 3. Configurar Fail2Ban
echo "🛡️ Configurando Fail2Ban..."
sudo tee /etc/fail2ban/jail.local > /dev/null <<EOL
[sshd]
enabled = true
maxretry = 3
bantime = 1h
findtime = 1h

[sshd-ddos]
enabled = true
EOL

# 4. Configuración específica para servidor web
if [ -d "/var/www" ]; then
    echo "🌐 Añadiendo protección para Apache..."
    sudo tee -a /etc/fail2ban/jail.local > /dev/null <<EOL
[apache-botsearch]
enabled = true

[apache-auth]
enabled = true
EOL
fi

# 5. Hardening de SSH
echo "🔐 Asegurando SSH..."
sudo sed -i 's/#PasswordAuthentication yes/PasswordAuthentication no/' /etc/ssh/sshd_config
sudo sed -i 's/#PermitRootLogin prohibit-password/PermitRootLogin no/' /etc/ssh/sshd_config
sudo systemctl restart sshd

# 6. Reiniciar servicios
echo "🔄 Reiniciando servicios de seguridad..."
sudo systemctl restart fail2ban

echo "✅ Configuración de seguridad completada con éxito!"
