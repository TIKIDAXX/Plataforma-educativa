#!/bin/bash
# =============================================
# CONFIGURACIÓN COMPLETA DEL SERVIDOR MYSQL
# Para Ubuntu Server 22.04 LTS
# =============================================

# 1. Actualizar sistema
echo "🔄 Actualizando el sistema..."
sudo apt update && sudo apt upgrade -y

# 2. Instalar MySQL Server
echo "📦 Instalando MySQL Server..."
sudo apt install -y mysql-server

# 3. Configuración básica de seguridad
echo "🔒 Configurando seguridad de MySQL..."
sudo mysql_secure_installation <<EOF
n
y
y
y
y
y
EOF

# 4. Crear usuario y base de datos
echo "💾 Creando base de datos y usuario..."
sudo mysql -e "CREATE DATABASE IF NOT EXISTS plataforma_educativa CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
sudo mysql -e "CREATE USER IF NOT EXISTS 'saidrais'@'192.168.1.10' IDENTIFIED BY 'saidrais';"
sudo mysql -e "GRANT ALL PRIVILEGES ON plataforma_educativa.* TO 'saidrais'@'192.168.1.10';"
sudo mysql -e "FLUSH PRIVILEGES;"

# 5. Configurar acceso remoto
echo "🌐 Configurando acceso remoto..."
sudo sed -i 's/bind-address.*/bind-address = 192.168.1.20/' /etc/mysql/mysql.conf.d/mysqld.cnf

# 6. Configurar firewall
echo "🔥 Configurando firewall..."
sudo ufw allow from 192.168.1.10 to any port 3306

# 7. Reiniciar servicio
echo "🔄 Reiniciando MySQL..."
sudo systemctl restart mysql

# 8. Verificar estado
echo "🔍 Verificando estado del servicio..."
sudo systemctl status mysql --no-pager

echo "✅ Configuración del servidor MySQL completada con éxito!"
