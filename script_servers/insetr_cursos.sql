-- Versión con manejo explícito de ID (si no es autoincremental)
SET @next_id = (SELECT IFNULL(MAX(id), 0) + 1 FROM cursos);

INSERT INTO `cursos` (`id`, `titulo`, `ruta_md`, `categoria`) VALUES
(@next_id, 'Fundamentos de Redes', 'redes/01_fundamentos-redes.md', 'Redes de Ordenadores'),
(@next_id+1, 'Topologías y Cableado', 'redes/02_topologias-cableado.md', 'Redes de Ordenadores'),
(@next_id+2, 'Switches y VLANs', 'redes/03_switches-vlans.md', 'Redes de Ordenadores'),
(@next_id+3, 'Enrutamiento y Protocolos', 'redes/04_enrutamiento-protocolos.md', 'Redes de Ordenadores'),
(@next_id+4, 'Seguridad y Wireless', 'redes/05_seguridad-wireless.md', 'Redes de Ordenadores');
