# Módulo 2: Topologías de Red y Cableado Estructurado

## Contenido

Topologías de red:
- Estrella
- Malla
- Anillo

Comparación en tolerancia a fallos, coste y complejidad.

Medios de transmisión:
- UTP (Cat5e/6/6A)
- Fibra óptica (monomodo y multimodo)

Estándares de instalación:
- TIA/EIA-568-C
- Conectores RJ45: normas 568A y 568B

## Diagrama topología estrella

          [PC1]
            |
[PC2]---[SWITCH]---[PC3]
            |
          [PC4]

## Ejercicios

**1. ¿Cuál es la diferencia práctica entre la norma 568A y 568B?**  
<details>
<summary>Solucion</summary>
El orden de los cables en el conector RJ45. Funcionan igual pero deben coincidir en ambos extremos si no se quiere un cruce.
</details>

**2. En una topología malla completa con 4 equipos, ¿cuántos enlaces físicos se requieren?**  
<details>
<summary>Solucion</summary>
6 enlaces (n*(n-1)/2) → 4*(4-1)/2 = 6
</details>

**3. ¿Qué ventaja tiene la fibra óptica frente al UTP?**  
<details>
<summary>Solucion</summary>
Mayor velocidad, inmunidad a interferencias electromagnéticas y mayor alcance.
</detaisl>
