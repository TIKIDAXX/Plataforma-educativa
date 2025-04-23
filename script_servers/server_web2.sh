#!/bin/bash
# =============================================
# CONFIGURACIÓN COMPLETA DEL SERVIDOR WEB
# Incluye: Apache, PHP, MySQL Client, Seguridad
# =============================================

# 1. Actualización inicial del sistema
echo "🔄 Actualizando el sistema..."
sudo apt update && sudo apt upgrade -y

# 2. Instalación de Apache y PHP
echo "📦 Instalando Apache y PHP..."
sudo apt install -y \
    apache2 \
    php \
    libapache2-mod-php \
    php-mysql \
    php-curl \
    php-mbstring \
    vsftpd \
    ufw \
    git \
    unzip

# 3. Configuración de firewall
echo "🔥 Configurando firewall..."
sudo ufw allow 22/tcp     # SSH
sudo ufw allow 80/tcp     # HTTP
sudo ufw allow 443/tcp    # HTTPS
sudo ufw allow 20:21/tcp  # FTP
sudo ufw --force enable

# 4. Configuración de Apache
echo "🛠️ Configurando Apache..."
sudo a2enmod rewrite
sudo systemctl restart apache2

# 5. Crear estructura de directorios
echo "📂 Creando estructura de directorios..."
sudo mkdir -p /var/www/html/cursos/{bd,redes}
sudo chown -R www-data:www-data /var/www
sudo chmod -R 750 /var/www/html/cursos

# 6. Configurar VirtualHost
echo "🌐 Configurando VirtualHost..."
sudo tee /etc/apache2/sites-available/plataforma.conf > /dev/null <<EOL
<VirtualHost *:80>
    ServerAdmin admin@iesvillena.edu
    ServerName plataforma.iesvillena.edu
    DocumentRoot /var/www/html

    <Directory /var/www/html>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOL

sudo a2dissite 000-default.conf
sudo a2ensite plataforma.conf
sudo systemctl restart apache2

# 7. Instalar Parsedown para Markdown
echo "📝 Instalando Parsedown..."
sudo wget https://github.com/erusev/parsedown/archive/refs/tags/1.7.4.zip -O /tmp/parsedown.zip
sudo unzip /tmp/parsedown.zip -d /usr/local/lib/
sudo ln -s /usr/local/lib/parsedown-1.7.4/Parsedown.php /usr/local/bin/

echo "✅ Configuración del servidor web completada con éxito!"
