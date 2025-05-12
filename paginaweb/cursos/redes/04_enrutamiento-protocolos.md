# Módulo 4: Enrutamiento y Protocolos Dinámicos (Capa 3)

## Contenido

Routers:
- Toman decisiones de ruta usando la tabla de enrutamiento.

NAT y PAT:
- NAT: Traducción 1:1 entre IP interna y externa.
- PAT: Traducción 1:N mediante puertos.

Protocolos dinámicos:
- RIP: hasta 15 saltos
- OSPF: métrica basada en costo
- BGP: protocolo usado entre proveedores de internet

ACLs:
- Control de tráfico entrante/saliente

QoS:
- Priorización de tráfico, útil para VoIP y video

## Diagrama de red con 3 routers

[PC1]---[R1]---[R2]---[R3]---[PC2]
\        /
[Switch VLAN]

## Ejercicios

**1. ¿Qué comando configura una red en OSPF?**  
<details>
<summary>Solucion</summary>
network 192.168.1.0 0.0.0.255 area 0</details>

**2. ¿Para qué se usa una ACL?**  
<details>
<summary>Solucion</summary>
Para permitir o denegar tráfico según IP, protocolo o puerto.</details>

**3. ¿Qué protocolo es más eficiente: RIP u OSPF? ¿Por qué?**  
<details>
<summary>Solucion</summary>
OSPF, porque usa el estado de enlace y calcula rutas más precisas y rápidas.</details>
