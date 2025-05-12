# Módulo 1: Fundamentos de Redes y Modelo OSI

## Contenido

Conceptos básicos de redes: conjunto de dispositivos interconectados que comparten recursos. Tipos según alcance, velocidad y tecnología.

Tipos de red:
- LAN
- WAN
- MAN
- PAN

Dispositivos de red:
- Hub
- Switch
- Router

Modelo OSI vs TCP/IP:
- OSI (7 capas)
- TCP/IP (4 capas)

Explicación del modelo OSI:

1. Física  
2. Enlace de Datos  
3. Red  
4. Transporte  
5. Sesión  
6. Presentación  
7. Aplicación

Ejemplo práctico: uso de traceroute para observar la capa 3 (direcciones IP) y 4 (puertos TCP).

Direccionamiento IP:
- IPv4 (32 bits) vs IPv6 (128 bits)
- Subnetting: técnica para dividir una red grande en varias pequeñas.

## Diagrama OSI vs TCP/IP

+--------------------+ +-----------------+

| OSI Model | | TCP/IP Model |

+--------------------+ +-----------------+

| 7. Aplicación | --> | Aplicación |

| 6. Presentación | | |

| 5. Sesión | | |

| 4. Transporte | --> | Transporte |

| 3. Red | --> | Internet |

| 2. Enlace de Datos | --> | Acceso a red |

| 1. Física | | |

+--------------------+ +-----------------+

## Ejercicios

**1. ¿Qué capas del modelo OSI están involucradas en una conexión HTTP?**  

<details>
  <summary>Solucion</summary>
  Capas 7 (Aplicación), 4 (Transporte), 3 (Red), 2 (Enlace de datos), 1 (Física).
</details>


**2. Divide la red 192.168.1.0/24 en 4 subredes. ¿Cuál es el rango de la segunda subred?**  
<solucion>Subred 2: 192.168.1.64/26 → Rango: 192.168.1.64 - 192.168.1.127</solucion>

**3. ¿Qué diferencia hay entre un switch y un hub?**  
<solucion>El switch reenvía tramas solo al puerto destino usando la MAC. El hub transmite por todos los puertos.</solucion>

