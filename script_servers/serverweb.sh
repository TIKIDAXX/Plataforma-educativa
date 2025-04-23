#!/bin/bash
# =============================================
# Configuración básica del servidor web (Apache/PHP)
# Para Ubuntu Server 22.04 LTS
# =============================================

# Actualizar sistema
sudo apt update && sudo apt upgrade -y

# Instalar paquetes esenciales
sudo apt install -y \
    apache2 \
    php8.1 \
    libapache2-mod-php8.1 \
    php8.1-mysql \
    php8.1-curl \
    php8.1-mbstring \
    vsftpd \
    ufw \
    git \
    unzip

# Configurar firewall (UFW)
sudo ufw allow 22/tcp     # SSH
sudo ufw allow 80/tcp     # HTTP
sudo ufw allow 443/tcp    # HTTPS
sudo ufw allow 20/tcp     # FTP
sudo ufw allow 21/tcp     # FTP
sudo ufw enable

# Configurar Apache
sudo a2enmod rewrite
sudo systemctl restart apache2

# Crear estructura de directorios
sudo mkdir -p /var/www/cursos/{bd,redes}
sudo chown -R www-data:www-data /var/www/cursos
sudo chmod -R 755 /var/www/cursos

# Configurar virtual host
sudo tee /etc/apache2/sites-available/plataforma.conf > /dev/null <<EOL
<VirtualHost *:80>
    ServerAdmin admin@iesvillena.edu
    ServerName plataforma.iesvillena.edu
    DocumentRoot /var/www/html

    <Directory /var/www/html>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOL

sudo a2ensite plataforma.conf
sudo systemctl restart apache2

# Instalar Parsedown (procesador Markdown)
sudo wget https://github.com/erusev/parsedown/archive/refs/tags/1.7.4.zip -O /tmp/parsedown.zip
sudo unzip /tmp/parsedown.zip -d /usr/local/lib/
sudo ln -s /usr/local/lib/parsedown-1.7.4/Parsedown.php /usr/local/bin/

echo "✅ Configuración del servidor web completada"
