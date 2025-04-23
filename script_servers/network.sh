#!/bin/bash
# =============================================
# CONFIGURACIÓN DE RED PARA AMBOS SERVIDORES
# =============================================

# 1. Determinar tipo de servidor
if [ -d "/var/www" ]; then
    IP="192.168.1.10"
    echo "🖥️ Configurando red para SERVIDOR WEB ($IP)"
else
    IP="192.168.1.20"
    echo "💾 Configurando red para SERVIDOR DB ($IP)"
fi

# 2. Configurar IP estática
echo "📡 Configurando IP estática..."
sudo tee /etc/netplan/01-netcfg.yaml > /dev/null <<EOL
network:
  version: 2
  ethernets:
    ens33:
      dhcp4: no
      addresses: [$IP/24]
      gateway4: 192.168.1.1
      nameservers:
        addresses: [8.8.8.8, 8.8.4.4]
EOL

# 3. Aplicar configuración
sudo netplan apply

# 4. Configurar reglas de firewall específicas
echo "🔥 Configurando reglas de firewall..."
if [ -d "/var/www" ]; then
    sudo ufw allow from 192.168.1.20 to any port 3306 comment "MySQL Access"
else
    sudo ufw allow from 192.168.1.10 to any port 3306 comment "MySQL Access"
fi

echo "✅ Configuración de red completada para IP $IP"
