#!/bin/bash
# =============================================
# Configuración del servidor de base de datos
# Para Ubuntu Server 22.04 LTS
# =============================================

# Instalar MySQL Server
sudo apt update && sudo apt install -y mysql-server-8.0

# Configuración básica de seguridad
sudo mysql_secure_installation <<EOF
n
y
y
y
y
y
EOF

# Crear usuario y base de datos
sudo mysql -e "CREATE DATABASE plataforma_educativa CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
sudo mysql -e "CREATE USER 'saidrais'@'192.168.1.10' IDENTIFIED BY 'saidrais';"
sudo mysql -e "GRANT ALL PRIVILEGES ON plataforma_educativa.* TO 'saidrais'@'192.168.1.10';"
sudo mysql -e "FLUSH PRIVILEGES;"

# Configurar acceso remoto
sudo sed -i 's/bind-address.*/bind-address = 192.168.1.20/' /etc/mysql/mysql.conf.d/mysqld.cnf

# Configurar firewall
sudo ufw allow from 192.168.1.10 to any port 3306

# Reiniciar servicio
sudo systemctl restart mysql

echo "✅ Configuración del servidor MySQL completada"
