-- ====================================================================
-- SCRIPT DE ROLES Y PERMISOS - PROJECT DEMO
-- ====================================================================
-- Este script crea las tablas y configura los roles y permisos
-- Ejecutar DESPUÉS de init.sql
-- ====================================================================

-- ====================================================================
-- 0. LIMPIAR TABLAS EXISTENTES
-- ====================================================================
-- ADVERTENCIA: Esto eliminará todas las tablas de roles y permisos
-- Si deseas preservar datos, comenta esta sección

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `RolVistaPermiso`;
DROP TABLE IF EXISTS `Vista`;
DROP TABLE IF EXISTS `Modulo`;
DROP TABLE IF EXISTS `Permiso`;
DROP TABLE IF EXISTS `Rol`;

SET FOREIGN_KEY_CHECKS=1;

SELECT '✓ Tablas eliminadas exitosamente' AS resultado;

-- ====================================================================
-- 1. CREAR TABLAS DE ROLES Y PERMISOS
-- ====================================================================

--
-- Tabla: Rol
-- Roles del sistema con control de acceso
--
CREATE TABLE IF NOT EXISTS `Rol` (
  `id_rol` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` TEXT DEFAULT NULL,
  `tipo_legacy` INT(11) DEFAULT NULL COMMENT 'Mapeo con campo tipo de Administrador/Usuario',
  `activo` TINYINT(1) NOT NULL DEFAULT 1,
  `fecha_registro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_rol`),
  UNIQUE KEY `nombre` (`nombre`),
  KEY `idx_tipo_legacy` (`tipo_legacy`),
  KEY `idx_activo` (`activo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tabla: Modulo
-- Módulos principales del sistema
--
CREATE TABLE IF NOT EXISTS `Modulo` (
  `id_modulo` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL COMMENT 'Nombre interno del módulo',
  `titulo` VARCHAR(100) NOT NULL COMMENT 'Título visible del módulo',
  `descripcion` TEXT DEFAULT NULL,
  `ruta` VARCHAR(250) NOT NULL COMMENT 'Ruta de acceso al módulo',
  `icono` VARCHAR(50) DEFAULT NULL COMMENT 'Icono Bootstrap Icons',
  `color` VARCHAR(100) DEFAULT NULL COMMENT 'Color o gradiente del módulo',
  `mostrar_en_dashboard` TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Mostrar card en dashboard',
  `tipo` ENUM('modulo_padre', 'modulo_hijo') DEFAULT 'modulo_hijo' COMMENT 'Tipo de módulo en el menú',
  `id_modulo_padre` INT(11) NULL COMMENT 'ID del módulo padre (para módulos hijos)',
  `orden` INT(11) NOT NULL DEFAULT 0 COMMENT 'Orden de aparición',
  `activo` TINYINT(1) NOT NULL DEFAULT 1,
  `exclusivo_dev` TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Solo visible para Dev',
  `fecha_registro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_modulo`),
  UNIQUE KEY `nombre` (`nombre`),
  KEY `idx_activo` (`activo`),
  KEY `idx_orden` (`orden`),
  KEY `idx_mostrar_dashboard` (`mostrar_en_dashboard`),
  KEY `idx_exclusivo_dev` (`exclusivo_dev`),
  KEY `idx_modulo_padre` (`id_modulo_padre`),
  KEY `idx_tipo` (`tipo`),
  CONSTRAINT `fk_modulo_padre` FOREIGN KEY (`id_modulo_padre`) REFERENCES `Modulo` (`id_modulo`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tabla: Vista
-- Vistas/páginas específicas dentro de cada módulo (sin jerarquía, solo orden)
--
CREATE TABLE IF NOT EXISTS `Vista` (
  `id_vista` INT(11) NOT NULL AUTO_INCREMENT,
  `id_modulo` INT(11) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL COMMENT 'Nombre interno de la vista',
  `ruta` VARCHAR(250) NOT NULL COMMENT 'Ruta del archivo PHP',
  `descripcion` TEXT DEFAULT NULL,
  `orden` INT(11) DEFAULT 0 COMMENT 'Orden de aparición',
  `activo` TINYINT(1) NOT NULL DEFAULT 1,
  `fecha_registro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_vista`),
  KEY `idx_modulo` (`id_modulo`),
  KEY `idx_activo` (`activo`),
  KEY `idx_orden` (`orden`),
  CONSTRAINT `fk_vista_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `Modulo` (`id_modulo`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tabla: Permiso
-- Tipos de permisos disponibles (access, create, read, update, delete)
--
CREATE TABLE IF NOT EXISTS `Permiso` (
  `id_permiso` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL COMMENT 'access, create, read, update, delete',
  `descripcion` TEXT DEFAULT NULL,
  `fecha_registro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_permiso`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tabla: RolVistaPermiso
-- Relación entre roles, vistas y permisos
--
CREATE TABLE IF NOT EXISTS `RolVistaPermiso` (
  `id_rol_vista_permiso` INT(11) NOT NULL AUTO_INCREMENT,
  `id_rol` INT(11) NOT NULL,
  `id_vista` INT(11) NOT NULL,
  `id_permiso` INT(11) NOT NULL,
  `asignado_por` INT(11) DEFAULT NULL COMMENT 'ID del administrador que asignó',
  `fecha_asignacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_rol_vista_permiso`),
  UNIQUE KEY `unique_rol_vista_permiso` (`id_rol`, `id_vista`, `id_permiso`),
  KEY `idx_rol` (`id_rol`),
  KEY `idx_vista` (`id_vista`),
  KEY `idx_permiso` (`id_permiso`),
  CONSTRAINT `fk_rvp_rol` FOREIGN KEY (`id_rol`) REFERENCES `Rol` (`id_rol`) ON DELETE CASCADE,
  CONSTRAINT `fk_rvp_vista` FOREIGN KEY (`id_vista`) REFERENCES `Vista` (`id_vista`) ON DELETE CASCADE,
  CONSTRAINT `fk_rvp_permiso` FOREIGN KEY (`id_permiso`) REFERENCES `Permiso` (`id_permiso`) ON DELETE CASCADE,
  CONSTRAINT `fk_rvp_asignado_por` FOREIGN KEY (`asignado_por`) REFERENCES `Administrador` (`id_administrador`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ====================================================================
-- 2. LIMPIAR DATOS PREVIOS (si existen)
-- ====================================================================

DELETE FROM RolVistaPermiso;
DELETE FROM Permiso;
DELETE FROM Vista;
DELETE FROM Modulo;
DELETE FROM Rol;

-- Resetear auto increment
ALTER TABLE Rol AUTO_INCREMENT = 1;
ALTER TABLE Modulo AUTO_INCREMENT = 1;
ALTER TABLE Vista AUTO_INCREMENT = 1;
ALTER TABLE Permiso AUTO_INCREMENT = 1;

-- ====================================================================
-- 3. CREAR ROLES
-- ====================================================================
-- ID=1: Dev (acceso total, incluye módulos exclusivos)
-- ID=2: Administrador (acceso total, excepto módulos exclusivos)
-- ID=3: Usuario (permisos limitados configurables desde matriz)
-- ====================================================================

INSERT INTO Rol (id_rol, nombre, descripcion, tipo_legacy, activo, fecha_registro) VALUES
(1, 'Dev', 'Desarrollador con acceso total al sistema y gestión de módulos/vistas', 0, 1, NOW()),
(2, 'Administrador', 'Administrador del sistema con acceso completo excepto configuración avanzada', 5, 1, NOW()),
(3, 'Usuario', 'Usuario del sistema con permisos limitados (legacy)', 1, 1, NOW()),
(4, 'Operativo', 'Coordinador operativo / jefe de bodega', 1, 1, NOW()),
(5, 'Mensajero', 'Personal de campo para entregas y recaudos', 2, 1, NOW());

-- ====================================================================
-- 4. CREAR PERMISO ÚNICO: ACCESS
-- ====================================================================

INSERT INTO Permiso (id_permiso, nombre, descripcion, fecha_registro) VALUES
(1, 'access', 'Acceso a la vista', NOW());

-- ====================================================================
-- 5. CREAR MÓDULOS DEL SISTEMA
-- ====================================================================

-- Paso 1: Insertar módulos independientes y módulos padre
INSERT INTO Modulo (nombre, titulo, descripcion, ruta, icono, color, mostrar_en_dashboard, tipo, id_modulo_padre, orden, activo, exclusivo_dev, fecha_registro) VALUES
-- Módulos independientes (sin padre)
('dashboard', 'Dashboard', 'Panel principal del sistema', 'index', 'bi-speedometer2', '#0d6efd', 0, 'modulo_hijo', NULL, 1, 1, 0, NOW()),
('administrators', 'Administradores', 'Gestión de administradores del sistema', 'administrators', 'bi-person-gear', '#6c757d', 1, 'modulo_hijo', NULL, 2, 1, 0, NOW()),
('users', 'Usuarios', 'Gestión de usuarios del sistema', 'users', 'bi-people', '#0dcaf0', 1, 'modulo_hijo', NULL, 3, 1, 0, NOW()),
('profile', 'Perfil', 'Perfil del usuario', 'users-profile', 'bi-person-circle', '#198754', 0, 'modulo_hijo', NULL, 4, 1, 0, NOW()),
('messages', 'Mensajes', 'Gestión de mensajes', 'messages', 'bi-envelope', '#ffc107', 1, 'modulo_hijo', NULL, 5, 1, 0, NOW()),
('clients', 'Clientes', 'Gestión de clientes', 'clients', 'bi-people-fill', '#dc3545', 1, 'modulo_hijo', NULL, 6, 1, 0, NOW()),
('testimonials', 'Testimonios', 'Gestión de testimonios', 'testimonial', 'bi-chat-quote', '#20c997', 1, 'modulo_hijo', NULL, 7, 1, 0, NOW()),
('information', 'Información', 'Información de la empresa', 'information', 'bi-building', '#6610f2', 0, 'modulo_hijo', NULL, 8, 1, 0, NOW()),

-- Módulos padre
('configuracion', 'Configuración', 'Configuración del sistema', 'configuracion', 'bi-gear-fill', 'linear-gradient(135deg, #6c757d, #495057)', 0, 'modulo_padre', NULL, 100, 1, 0, NOW());

SELECT '✓ Módulos independientes y padres creados' AS resultado;

-- Paso 2: Obtener ID del módulo padre Configuración
SET @id_config = (SELECT id_modulo FROM Modulo WHERE nombre = 'configuracion');

-- Paso 3: Insertar módulos hijos de Configuración
INSERT INTO Modulo (nombre, titulo, descripcion, ruta, icono, color, mostrar_en_dashboard, tipo, id_modulo_padre, orden, activo, exclusivo_dev, fecha_registro) VALUES
-- Módulos hijos de Configuración
('report', 'Reportes', 'Reportes del sistema', 'report', 'bi-file-earmark-bar-graph', '#6c757d', 0, 'modulo_hijo', @id_config, 11, 1, 0, NOW()),
('roles', 'Roles', 'Gestión de roles del sistema', 'roles', 'bi-shield-check', '#0dcaf0', 0, 'modulo_hijo', @id_config, 12, 1, 0, NOW()),
('modules', 'Módulos', 'Gestión de módulos del sistema', 'modules', 'bi-box-seam', '#198754', 0, 'modulo_hijo', @id_config, 13, 1, 1, NOW()),
('views', 'Vistas', 'Gestión de vistas del sistema', 'views', 'bi-file-earmark-code', '#dc3545', 0, 'modulo_hijo', @id_config, 14, 1, 1, NOW());

SELECT '✓ Módulos hijos creados exitosamente' AS resultado;

-- ====================================================================
-- 6. CREAR VISTAS POR MÓDULO
-- ====================================================================

-- Vistas del módulo Dashboard
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'dashboard'), 'index-admin', 'system/views/admin/index.php', 'Dashboard del administrador', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'dashboard'), 'index-user', 'system/views/user/index.php', 'Dashboard del usuario', 1, NOW());

-- Vistas del módulo Administrators
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'administrators'), 'listar', 'system/views/admin/administrators.php', 'Listado de administradores', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'administrators'), 'editar', 'system/views/admin/administrator.php', 'Editar administrador', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'administrators'), 'crear', 'new-administrator', 'Crear nuevo administrador', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'administrators'), 'eliminar', 'delete-administrator', 'Eliminar administrador', 1, NOW());

-- Vistas del módulo Users
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'users'), 'listar', 'system/views/admin/users.php', 'Listado de usuarios', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'users'), 'editar', 'system/views/admin/user.php', 'Editar usuario', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'users'), 'crear', 'new-user', 'Crear nuevo usuario', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'users'), 'eliminar', 'delete-user', 'Eliminar usuario', 1, NOW());

-- Vistas del módulo Profile
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'profile'), 'editar-admin', 'system/views/admin/users-profile.php', 'Editar perfil admin', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'profile'), 'editar-user', 'system/views/user/users-profile.php', 'Editar perfil usuario', 1, NOW());

-- Vistas del módulo Messages
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'messages'), 'listar', 'system/views/admin/messages.php', 'Listado de mensajes', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'messages'), 'eliminar', 'delete-message', 'Eliminar mensaje', 1, NOW());

-- Vistas del módulo Clients
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'clients'), 'listar', 'system/views/admin/clients.php', 'Listado de clientes', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'clients'), 'crear', 'new-client', 'Crear nuevo cliente', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'clients'), 'editar', 'edit-client', 'Editar cliente', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'clients'), 'eliminar', 'delete-client', 'Eliminar cliente', 1, NOW());

-- Vistas del módulo Testimonials
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'testimonials'), 'listar', 'system/views/admin/testimonial.php', 'Listado de testimonios', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'testimonials'), 'crear', 'new-testimonial', 'Crear nuevo testimonio', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'testimonials'), 'editar', 'edit-testimonial', 'Editar testimonio', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'testimonials'), 'eliminar', 'delete-testimonial', 'Eliminar testimonio', 1, NOW());

-- Vistas del módulo Information
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'information'), 'ver', 'system/views/admin/information.php', 'Ver información', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'information'), 'editar', 'update-information', 'Editar información', 1, NOW());

-- Vistas del módulo Report
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'report'), 'ver', 'system/views/admin/report.php', 'Ver reportes', 1, NOW());

-- Vistas del módulo Roles
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'roles'), 'listar', 'system/views/admin/roles.php', 'Listado de roles', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'roles'), 'editar', 'system/views/admin/roles-edit.php', 'Editar rol', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'roles'), 'matriz-permisos', 'system/views/admin/permissions-matrix.php', 'Matriz de permisos', 1, NOW());

-- Vistas del módulo Modules (exclusivo Dev)
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'modules'), 'listar', 'system/views/admin/modules.php', 'Listado de módulos', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'modules'), 'crear', 'system/views/admin/modules-new.php', 'Crear nuevo módulo', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'modules'), 'editar', 'system/views/admin/modules-edit.php', 'Editar módulo', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'modules'), 'eliminar', 'delete-module', 'Eliminar módulo', 1, NOW());

-- Vistas del módulo Views (exclusivo Dev)
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'views'), 'listar', 'system/views/admin/views.php', 'Listado de vistas', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'views'), 'crear', 'system/views/admin/views-new.php', 'Crear nueva vista', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'views'), 'editar', 'system/views/admin/views-edit.php', 'Editar vista', 1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'views'), 'eliminar', 'delete-view', 'Eliminar vista', 1, NOW());

-- ====================================================================
-- 6b. MÓDULOS Y VISTAS OPERATIVAS RODAMEL
-- ====================================================================

-- Módulos padre de Rodamel
INSERT INTO Modulo (nombre, titulo, descripcion, ruta, icono, color, mostrar_en_dashboard, tipo, id_modulo_padre, orden, activo, exclusivo_dev, fecha_registro) VALUES
('rodamel_operacion',  'Operación',  'Módulos operativos de última milla', 'rodamel/operacion',  'bi-boxes',          'linear-gradient(135deg, #E94E1B, #c43910)', 0, 'modulo_padre', NULL, 20, 1, 0, NOW()),
('rodamel_financiero', 'Financiero', 'Módulos financieros y de conciliación', 'rodamel/financiero', 'bi-cash-coin',      'linear-gradient(135deg, #490102, #7a0103)', 0, 'modulo_padre', NULL, 21, 1, 0, NOW());

SET @id_op  = (SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_operacion');
SET @id_fin = (SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_financiero');

INSERT INTO Modulo (nombre, titulo, descripcion, ruta, icono, color, mostrar_en_dashboard, tipo, id_modulo_padre, orden, activo, exclusivo_dev, fecha_registro) VALUES
-- Hijos de Operación
('rodamel_carriers',    'Carriers',           'Transportadoras aliadas',           'rodamel/carriers',    'bi-truck',             '#E94E1B', 1, 'modulo_hijo', @id_op,  22, 1, 0, NOW()),
('rodamel_planillas',   'Planillas',          'Planillas de importación de lotes', 'rodamel/planillas',   'bi-file-earmark-text', '#E94E1B', 1, 'modulo_hijo', @id_op,  23, 1, 0, NOW()),
('rodamel_guias',       'Guías',              'Gestión y consulta de guías',       'rodamel/guias',       'bi-upc-scan',          '#E94E1B', 1, 'modulo_hijo', @id_op,  24, 1, 0, NOW()),
('rodamel_bodega',      'Bodega',             'Inventario y ubicación en bodega',  'rodamel/bodega',      'bi-archive',           '#E94E1B', 1, 'modulo_hijo', @id_op,  25, 1, 0, NOW()),
('rodamel_mensajeros',  'Mensajeros',         'Gestión de mensajeros',             'rodamel/mensajeros',  'bi-person-badge',      '#E94E1B', 1, 'modulo_hijo', @id_op,  26, 1, 0, NOW()),
('rodamel_vehiculos',   'Vehículos',          'Gestión de vehículos',              'rodamel/vehiculos',   'bi-car-front',         '#E94E1B', 1, 'modulo_hijo', @id_op,  27, 1, 0, NOW()),
('rodamel_despacho',    'Despacho',           'Planillas de salida y rutas',       'rodamel/despacho',    'bi-geo-alt',           '#E94E1B', 1, 'modulo_hijo', @id_op,  28, 1, 0, NOW()),
('rodamel_entregas',    'Entregas',           'Registro de entregas y evidencia',  'rodamel/entregas',    'bi-check-circle',      '#E94E1B', 1, 'modulo_hijo', @id_op,  29, 1, 0, NOW()),
-- Hijos de Financiero
('rodamel_recaudos',    'Recaudos',           'Recaudo en campo (contraentrega)',  'rodamel/recaudos',    'bi-cash',              '#490102', 1, 'modulo_hijo', @id_fin, 30, 1, 0, NOW()),
('rodamel_conciliacion','Conciliación',       'Conciliación interna y externa',   'rodamel/conciliacion','bi-clipboard-data',    '#490102', 1, 'modulo_hijo', @id_fin, 31, 1, 0, NOW()),
('rodamel_prefacturas', 'Prefacturas',        'Prefacturas del carrier',           'rodamel/prefacturas', 'bi-receipt',           '#490102', 1, 'modulo_hijo', @id_fin, 32, 1, 0, NOW()),
-- Rastreo administrativo (independiente)
('rodamel_rastreo',     'Rastreo Admin',      'Consulta de guías desde el panel',  'rodamel/rastreo',     'bi-search',            '#E94E1B', 1, 'modulo_hijo', NULL,    33, 1, 0, NOW());

-- Vistas de Carriers
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_carriers'), 'listar',  'system/views/admin/rodamel/carriers.php',        'Listado de carriers',    1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_carriers'), 'crear',   'system/views/admin/rodamel/carrier-new.php',     'Crear carrier',          1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_carriers'), 'editar',  'system/views/admin/rodamel/carrier-edit.php',    'Editar carrier',         1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_carriers'), 'eliminar','delete-carrier',                                  'Eliminar carrier',       1, NOW());

-- Vistas de Planillas
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_planillas'), 'listar',  'system/views/admin/rodamel/planillas.php',       'Listado de planillas',   1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_planillas'), 'importar','system/views/admin/rodamel/planilla-import.php', 'Importar planilla',      1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_planillas'), 'ver',     'system/views/admin/rodamel/planilla-view.php',   'Ver detalle planilla',   1, NOW());

-- Vistas de Guías
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_guias'), 'listar',  'system/views/admin/rodamel/guias.php',           'Listado de guías',       1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_guias'), 'ver',     'system/views/admin/rodamel/guia-view.php',       'Ver detalle de guía',    1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_guias'), 'editar',  'system/views/admin/rodamel/guia-edit.php',       'Editar estado de guía',  1, NOW());

-- Vistas de Bodega
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_bodega'), 'listar',  'system/views/admin/rodamel/bodega.php',          'Inventario en bodega',   1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_bodega'), 'mover',   'system/views/admin/rodamel/bodega-mover.php',    'Mover paquete',          1, NOW());

-- Vistas de Mensajeros
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_mensajeros'), 'listar',  'system/views/admin/rodamel/mensajeros.php',   'Listado de mensajeros',  1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_mensajeros'), 'crear',   'system/views/admin/rodamel/mensajero-new.php','Crear mensajero',        1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_mensajeros'), 'editar',  'system/views/admin/rodamel/mensajero-edit.php','Editar mensajero',      1, NOW());

-- Vistas de Vehículos
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_vehiculos'), 'listar',  'system/views/admin/rodamel/vehiculos.php',    'Listado de vehículos',   1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_vehiculos'), 'crear',   'system/views/admin/rodamel/vehiculo-new.php', 'Crear vehículo',         1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_vehiculos'), 'editar',  'system/views/admin/rodamel/vehiculo-edit.php','Editar vehículo',        1, NOW());

-- Vistas de Despacho
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_despacho'), 'listar',  'system/views/admin/rodamel/despacho.php',        'Planillas de salida',    1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_despacho'), 'crear',   'system/views/admin/rodamel/despacho-new.php',    'Crear planilla salida',  1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_despacho'), 'ver',     'system/views/admin/rodamel/despacho-view.php',   'Ver detalle despacho',   1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_despacho'), 'cerrar',  'system/views/admin/rodamel/despacho-close.php',  'Cerrar planilla salida', 1, NOW());

-- Vistas de Entregas
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_entregas'), 'listar',  'system/views/admin/rodamel/entregas.php',        'Listado de entregas',    1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_entregas'), 'ver',     'system/views/admin/rodamel/entrega-view.php',    'Ver detalle entrega',    1, NOW());

-- Vistas de Recaudos
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_recaudos'), 'listar',  'system/views/admin/rodamel/recaudos.php',        'Listado de recaudos',    1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_recaudos'), 'ver',     'system/views/admin/rodamel/recaudo-view.php',    'Ver detalle recaudo',    1, NOW());

-- Vistas de Conciliación
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_conciliacion'), 'listar',  'system/views/admin/rodamel/conciliacion.php',    'Listado de conciliaciones',  1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_conciliacion'), 'crear',   'system/views/admin/rodamel/conciliacion-new.php','Crear conciliación',         1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_conciliacion'), 'ver',     'system/views/admin/rodamel/conciliacion-view.php','Ver conciliación',          1, NOW());

-- Vistas de Prefacturas
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_prefacturas'), 'listar',   'system/views/admin/rodamel/prefacturas.php',      'Listado de prefacturas',   1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_prefacturas'), 'importar', 'system/views/admin/rodamel/prefactura-import.php','Importar prefactura',      1, NOW()),
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_prefacturas'), 'ver',      'system/views/admin/rodamel/prefactura-view.php',  'Ver prefactura',           1, NOW());

-- Vistas de Rastreo Admin
INSERT INTO Vista (id_modulo, nombre, ruta, descripcion, activo, fecha_registro) VALUES
((SELECT id_modulo FROM Modulo WHERE nombre = 'rodamel_rastreo'), 'buscar', 'system/views/admin/rodamel/rastreo.php', 'Rastreo de guías (admin)', 1, NOW());

SELECT '✓ Módulos y vistas Rodamel registrados en RBAC' AS resultado;

-- ====================================================================
-- 7. ASIGNAR PERMISOS A ROL DEV (ID=1)
-- ====================================================================
-- Dev tiene acceso a TODO el sistema incluyendo módulos exclusivos

INSERT IGNORE INTO RolVistaPermiso (id_rol, id_vista, id_permiso)
SELECT 1, v.id_vista, 1
FROM Vista v
WHERE v.activo = 1;

-- ====================================================================
-- 8. ASIGNAR PERMISOS A ROL ADMINISTRADOR (ID=2)
-- ====================================================================
-- Administrador tiene acceso a TODO excepto módulos exclusivos de Dev

INSERT IGNORE INTO RolVistaPermiso (id_rol, id_vista, id_permiso)
SELECT 2, v.id_vista, 1
FROM Vista v
INNER JOIN Modulo m ON v.id_modulo = m.id_modulo
WHERE v.activo = 1
AND m.activo = 1
AND (m.exclusivo_dev = 0 OR m.exclusivo_dev IS NULL);

-- ====================================================================
-- 9. PERMISOS BÁSICOS PARA ROL USUARIO LEGACY (ID=3)
-- ====================================================================
-- Usuario legacy tiene acceso básico a:
-- - Dashboard (usuario)
-- - Perfil propio
-- - Mensajes (lectura)
-- - Clientes (lectura)

INSERT IGNORE INTO RolVistaPermiso (id_rol, id_vista, id_permiso)
SELECT 3, v.id_vista, 1
FROM Vista v
INNER JOIN Modulo m ON v.id_modulo = m.id_modulo
WHERE v.activo = 1
AND m.nombre IN ('dashboard', 'profile', 'messages', 'clients')
AND v.nombre IN ('index-user', 'editar-user', 'listar');

-- ====================================================================
-- 10. PERMISOS PARA ROL OPERATIVO (ID=4)
-- ====================================================================
-- Operativo tiene acceso a:
-- - Dashboard
-- - Perfil propio
-- - Clientes
-- - Todos los módulos Rodamel de Operación
-- - Módulos financieros: Recaudos (lectura)
-- - Rastreo admin

INSERT IGNORE INTO RolVistaPermiso (id_rol, id_vista, id_permiso)
SELECT 4, v.id_vista, 1
FROM Vista v
INNER JOIN Modulo m ON v.id_modulo = m.id_modulo
WHERE v.activo = 1
AND m.nombre IN (
    'dashboard', 'profile', 'clients',
    'rodamel_carriers', 'rodamel_planillas', 'rodamel_guias',
    'rodamel_bodega', 'rodamel_mensajeros', 'rodamel_vehiculos',
    'rodamel_despacho', 'rodamel_entregas',
    'rodamel_recaudos', 'rodamel_rastreo'
);

-- ====================================================================
-- 11. PERMISOS PARA ROL MENSAJERO (ID=5)
-- ====================================================================
-- Mensajero tiene acceso limitado a:
-- - Dashboard
-- - Perfil propio
-- - Entregas (ver asignadas, registrar resultado)
-- - Recaudos (registrar recaudos propios)
-- - Rastreo admin

INSERT IGNORE INTO RolVistaPermiso (id_rol, id_vista, id_permiso)
SELECT 5, v.id_vista, 1
FROM Vista v
INNER JOIN Modulo m ON v.id_modulo = m.id_modulo
WHERE v.activo = 1
AND m.nombre IN (
    'dashboard', 'profile',
    'rodamel_entregas', 'rodamel_recaudos', 'rodamel_rastreo'
);

-- ====================================================================
-- RESUMEN DE LA CONFIGURACIÓN
-- ====================================================================
-- Tablas creadas:
--   - Rol (roles del sistema)
--   - Modulo (módulos principales)
--   - Vista (vistas/páginas por módulo)
--   - Permiso (tipos de permisos)
--   - RolVistaPermiso (relación roles-vistas-permisos)
--
-- Roles creados:
--   ID=1: Dev (acceso total, incluye módulos exclusivos)
--   ID=2: Administrador (acceso total, excepto módulos exclusivos)
--   ID=3: Usuario legacy (dashboard + perfil + permisos básicos)
--   ID=4: Operativo (módulos operativos Rodamel + clientes + recaudos)
--   ID=5: Mensajero (entregas + recaudos + rastreo)
--
-- Módulos exclusivos de Dev (exclusivo_dev=1):
--   - Módulos (gestión de módulos)
--   - Vistas (gestión de vistas)
--
-- Módulos eliminados (no requeridos por Rodamel):
--   - Blog
--   - Mail
--
-- Los permisos específicos se pueden asignar desde la
-- interfaz de Matriz de Permisos según las necesidades
-- ====================================================================

SELECT 'Roles y permisos configurados exitosamente.' AS Resultado;
