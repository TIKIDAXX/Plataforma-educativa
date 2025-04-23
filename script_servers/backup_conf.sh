#!/bin/bash
# =============================================
# CONFIGURACIÓN DE BACKUPS AUTOMATIZADOS
# =============================================

# 1. Crear estructura de directorios
sudo mkdir -p /backups/{diarios,semanales,logs}
sudo chmod -R 700 /backups

# 2. Script de backup para MySQL (solo en servidor DB)
if which mysql >/dev/null; then
    sudo tee /usr/local/bin/backup_db.sh > /dev/null <<'EOL'
#!/bin/bash
DATE=$(date +%Y%m%d)
BACKUP_FILE="/backups/diarios/db_$DATE.sql.gz"
mysqldump -u saidrais -p'saidrais' --all-databases | gzip > $BACKUP_FILE
find /backups/diarios/ -name "*.sql.gz" -mtime +7 -delete
EOL
    sudo chmod +x /usr/local/bin/backup_db.sh
fi

# 3. Script de backup para contenidos (solo en servidor web)
if [ -d "/var/www" ]; then
    sudo tee /usr/local/bin/backup_web.sh > /dev/null <<'EOL'
#!/bin/bash
DATE=$(date +%Y%m%d)
BACKUP_FILE="/backups/diarios/web_$DATE.tar.gz"
tar -czf $BACKUP_FILE /var/www /etc/apache2
find /backups/diarios/ -name "*.tar.gz" -mtime +7 -delete
EOL
    sudo chmod +x /usr/local/bin/backup_web.sh
fi

# 4. Configurar cron jobs
sudo tee /etc/cron.d/plataforma_backups > /dev/null <<EOL
# Backup diario de DB (2 AM)
0 2 * * * root /usr/local/bin/backup_db.sh >> /backups/logs/db_$(date +\%Y\%m\%d).log 2>&1

# Backup diario de web (3 AM)
0 3 * * * root /usr/local/bin/backup_web.sh >> /backups/logs/web_$(date +\%Y\%m\%d).log 2>&1

# Backup semanal completo (Domingos a 4 AM)
0 4 * * 0 root tar -czf /backups/semanales/full_$(date +\%Y\%m\%d).tar.gz /backups/diarios
EOL

echo "✅ Sistema de backups configurado"
