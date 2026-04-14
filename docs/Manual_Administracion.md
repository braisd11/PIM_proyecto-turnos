# Manual de Administración - Sistema de Gestión de Turnos

## Introducción

Este manual está dirigido a administradores del Sistema de Gestión de Turnos. El sistema permite gestionar empleados, turnos, solicitudes y configuraciones del sistema. **Nota importante:** La funcionalidad de administración está parcialmente implementada. Este manual describe las características actuales y sugiere ampliaciones futuras para completar el sistema.

## Requisitos del Sistema

- Navegador web moderno
- Credenciales de administrador
- Conocimientos básicos de gestión de personal y horarios

## Inicio de Sesión como Administrador

1. Navegue a la página de login de administrador (admin.php).
2. Ingrese usuario "admin" y contraseña "1234".
3. Seleccione el rol "admin".
4. Haga clic en "Entrar".

**Nota:** Actualmente, el sistema usa credenciales hardcodeadas. En futuras versiones, se implementará un sistema de autenticación más robusto con base de datos.

## Funcionalidades Actuales

### Dashboard Administrativo

Después del login, accederá al menú principal con las mismas opciones que los empleados, pero con permisos adicionales. Actualmente, no hay diferenciación visual clara entre roles de empleado y administrador.

### Gestión de Calendario

Como administrador, puede:
- Ver el calendario completo de todos los empleados.
- Los turnos se muestran con empleados fijos (Juan, Carla, Luis).
- Funcionalidades del calendario:
  - Agregar turnos: Haga clic en un espacio vacío para crear un nuevo turno.
  - Eliminar turnos: Use el menú contextual (clic derecho) sobre un turno.
  - Cambiar colores: Opción en el menú contextual.

**Limitación actual:** Los empleados están hardcodeados en el código JavaScript. No se pueden agregar/eliminar empleados dinámicamente.

### Revisión de Solicitudes

Actualmente, las solicitudes de empleados (cambios de turno, vacaciones) se envían pero no hay interfaz para que el administrador las revise y apruebe/rechace.

**Estado:** Funcionalidad pendiente de implementación.

## Funcionalidades Pendientes de Implementación

Para completar el sistema de administración, se requieren las siguientes ampliaciones:

### 1. Gestión de Usuarios
- Crear, editar y eliminar cuentas de empleados.
- Asignar roles (empleado, administrador).
- Gestionar permisos de acceso.
- Integración con base de datos para almacenamiento persistente.

### 2. Gestión de Turnos
- Asignación automática de turnos.
- Plantillas de horarios recurrentes.
- Intercambio de turnos entre empleados.
- Notificaciones automáticas.

### 3. Sistema de Solicitudes
- Panel para revisar solicitudes pendientes.
- Aprobar/rechazar solicitudes con comentarios.
- Historial de solicitudes.
- Notificaciones a empleados sobre decisiones.

### 4. Reportes y Estadísticas
- Reportes de horas trabajadas.
- Estadísticas de solicitudes.
- Exportación de datos (PDF, Excel).
- Dashboard con métricas clave.

### 5. Configuración del Sistema
- Configuración de turnos disponibles (mañana, tarde, noche).
- Días festivos y excepciones.
- Reglas de negocio (máximo de turnos consecutivos, etc.).
- Backup y restauración de datos.

### 6. Seguridad y Auditoría
- Logs de actividades.
- Autenticación de dos factores.
- Encriptación de datos sensibles.
- Cumplimiento con normativas de privacidad (RGPD, etc.).

## Base de Datos

Actualmente, el sistema no utiliza una base de datos completa. Hay un archivo `init.sql` vacío y un script `temp.js` que crea una tabla básica de usuarios en SQLite.

**Recomendación:** Implementar una base de datos relacional (MySQL/PostgreSQL) con las siguientes tablas principales:
- `usuarios` (id, nombre, email, rol, contraseña_hash, fecha_creacion)
- `turnos` (id, empleado_id, fecha, tipo_turno, estado)
- `solicitudes` (id, empleado_id, tipo, fecha_solicitud, detalles, estado, admin_id, fecha_respuesta)

## API Backend

El archivo `backend/index.php` está vacío. Se requiere implementar una API REST para:
- Autenticación de usuarios.
- CRUD de empleados y turnos.
- Gestión de solicitudes.
- Integración con el frontend.

## Recomendaciones para Desarrollo Futuro

1. **Separación de Roles:** Implementar middleware para diferenciar claramente entre empleados y administradores.
2. **Validaciones:** Agregar validaciones del lado servidor para todos los formularios.
3. **UI/UX:** Mejorar la interfaz de administración con componentes específicos (tablas de datos, modales de confirmación).
4. **Testing:** Implementar pruebas unitarias y de integración.
5. **Documentación Técnica:** Crear documentación para desarrolladores.
6. **Despliegue:** Configurar entorno de producción con servidor web, base de datos y backups.

## Soporte y Mantenimiento

- Mantenga backups regulares de la base de datos.
- Monitoree logs de errores.
- Actualice dependencias regularmente.
- Realice pruebas antes de despliegues en producción.

## Contacto

Para soporte técnico o consultas sobre ampliaciones:
- Desarrollador del sistema
- Equipo de TI de la empresa

---

*Este manual refleja el estado actual del sistema. Se actualizará conforme se implementen nuevas funcionalidades.*</content>
<parameter name="filePath">c:\xampp\htdocs\proyecto-turnos\Manual_Administracion.md