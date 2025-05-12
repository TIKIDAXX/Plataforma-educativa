# Módulo 3: Switches y VLANs (Capa 2)

## Contenido

Switches:
- Conmutación basada en direcciones MAC
- Gestión de tráfico

VLANs:
- Segmentación lógica
- Puertos de acceso y trunk
- 802.1Q para etiquetado de tramas

Seguridad:
- Port Security
- STP (Spanning Tree Protocol)

## Diagrama de VLANs (simplificado)

          [PC1]---+
            | VLAN 10
[PC2]---+ [Switch]---Trunk---[Router-on-a-stick]
            | VLAN 20
         [PC3]---+

## Ejercicios

**1. ¿Qué comando se usa para crear una VLAN en Cisco?**  
<solucion>vlan 10 (dentro de modo de configuración global)</solucion>

**2. ¿Qué pasa si dos dispositivos están en VLANs distintas sin enrutamiento?**  
<solucion>No pueden comunicarse entre sí. Las VLANs están aisladas.</solucion>

**3. ¿Qué tipo de puerto se usa para conectar dos switches que comparten VLANs?**  
<solucion>Puerto trunk con protocolo 802.1Q</solucion>
