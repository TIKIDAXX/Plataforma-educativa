#!/bin/bash
# =============================================
# INSTALACIÓN Y CONFIGURACIÓN DE MYSQL SERVER
# Para Ubuntu Server 22.04 LTS
# =============================================

set -e  # Salir si algo falla

# VARIABLES
DB_NAME="plataforma_educativa"
DB_USER="saidrais"
DB_PASS="saidrais"
DB_CLIENT_IP="192.168.1.10"
MYSQL_SERVER_IP="0.0.0.0"
MYSQL_CONFIG_FILE="/etc/mysql/mysql.conf.d/mysqld.cnf"

echo "🔄 Actualizando sistema..."
sudo apt update && sudo apt upgrade -y

echo "📦 Instalando MySQL Server..."
sudo apt install -y mysql-server

echo "🔒 Configurando seguridad de MySQL..."
sudo mysql_secure_installation <<EOF
n
y
y
y
y
y
EOF

echo "💾 Creando base de datos y usuario..."
sudo mysql -e "CREATE DATABASE IF NOT EXISTS $DB_NAME CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
sudo mysql -e "CREATE USER IF NOT EXISTS '$DB_USER'@'$DB_CLIENT_IP' IDENTIFIED BY '$DB_PASS';"
sudo mysql -e "GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'$DB_CLIENT_IP';"
sudo mysql -e "FLUSH PRIVILEGES;"

echo "📄 Verificando archivo de configuración de MySQL..."
if [ ! -s "$MYSQL_CONFIG_FILE" ]; then
    echo "⚠️ Archivo vacío o no encontrado, restaurando contenido por defecto..."
    sudo tee "$MYSQL_CONFIG_FILE" > /dev/null <<EOL
[mysqld]
user            = mysql
pid-file        = /run/mysqld/mysqld.pid
socket          = /run/mysqld/mysqld.sock
port            = 3306
basedir         = /usr
datadir         = /var/lib/mysql
tmpdir          = /tmp
lc-messages-dir = /usr/share/mysql
skip-external-locking

bind-address    = $MYSQL_SERVER_IP

log-error       = /var/log/mysql/error.log
slow_query_log  = 1
slow_query_log_file = /var/log/mysql/mysql-slow.log

sql_mode=STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION
EOL
else
    echo "✏️ Editando bind-address en $MYSQL_CONFIG_FILE..."
    sudo sed -i "s/^bind-address.*/bind-address = $MYSQL_SERVER_IP/" "$MYSQL_CONFIG_FILE"
fi

echo "🔥 Configurando firewall..."
sudo ufw allow from $DB_CLIENT_IP to any port 3306 comment 'Permitir acceso MySQL desde cliente autorizado'

echo "🔄 Reiniciando servicio MySQL..."
sudo systemctl restart mysql

echo "🔍 Verificando estado del servicio..."
sudo systemctl status mysql --no-pager

echo "✅ MySQL instalado y configurado correctamente. ¡Listo para usar!"
