# Manual de Administración - Sistema de Gestión de Turnos

## Introducción

Este manual está dirigido a los administradores del Sistema de Gestión de Turnos. La aplicación permite iniciar sesión con usuarios registrados, consultar datos personales, solicitar vacaciones o cambios de turno, y gestionar las solicitudes enviadas por los empleados.

El rol de administrador dispone de permisos adicionales para revisar todas las solicitudes registradas en el sistema y aprobarlas o rechazarlas desde la propia aplicación.

## Requisitos del Sistema

- Servidor local XAMPP con Apache activo.
- Navegador web moderno: Chrome, Firefox, Edge o similar.
- Proyecto ubicado dentro de la carpeta `htdocs` de XAMPP.
- Base de datos SQLite incluida en `database/database.db`.
- Credenciales de un usuario con rol `admin`.

## Acceso a la Aplicación

Para abrir la aplicación en local, inicie Apache desde XAMPP y acceda a:

```text
http://localhost/PIM_proyecto-turnos/frontend/views/login.php
```

También existe una pantalla específica para acceso de administración:

```text
http://localhost/PIM_proyecto-turnos/frontend/views/admin.php
```

Ambas pantallas validan las credenciales contra la tabla `EMPLEADO` de la base de datos SQLite.

## Inicio de Sesión como Administrador

1. Abra la página de login.
2. Introduzca las credenciales de un usuario con rol `admin`.
3. Pulse el botón `Entrar`.
4. Si las credenciales son correctas, accederá al menú principal.

Actualmente, la base de datos incluye un usuario administrador:

```text
Usuario: pmartin
Contraseña: 1234
Rol: admin
```

Las contraseñas se validan mediante `password_verify()`, por lo que se comparan contra el hash almacenado en la base de datos.

## Roles del Sistema

La aplicación distingue entre dos roles principales:

- `empleado`: puede editar su perfil, crear solicitudes y consultar sus propias solicitudes.
- `admin`: puede realizar las mismas acciones que un empleado y, además, revisar todas las solicitudes del sistema.

El rol se guarda en sesión tras el login:

```php
$_SESSION['rol']
```

Las páginas administrativas comprueban este rol antes de permitir el acceso.

## Menú Principal

Después de iniciar sesión, el usuario accede a la pantalla principal.

El menú lateral incluye:

- Inicio.
- Calendario.
- Solicitudes empleados, visible para usuarios con rol `admin`.
- Solicitud de cambio.
- Solicitud de vacaciones.
- Mis solicitudes.
- Mi perfil.
- Cerrar sesión.

El panel de inicio muestra información real del usuario logeado, obtenida desde la tabla `EMPLEADO`:

- Nombre.
- Email.
- Teléfono.
- Usuario.
- Rol.

## Gestión del Perfil

Desde `Mi perfil`, el usuario puede modificar:

- Nombre.
- Email.
- Teléfono.

Al pulsar `Guardar cambios`, la aplicación actualiza directamente la tabla `EMPLEADO` de la base de datos.

La actualización se realiza usando el identificador del usuario guardado en sesión:

```php
$_SESSION['id_empleado']
```

Esto evita que un usuario pueda modificar datos de otro empleado desde el formulario.

## Solicitudes de Vacaciones

Los empleados y administradores pueden registrar solicitudes de vacaciones desde:

```text
Solicitudes > Solicitud de vacaciones
```

El formulario solicita:

- Fecha de inicio.
- Fecha de fin.
- Observaciones.

Al enviar la solicitud, se crea un registro en la tabla `SOLICITUD` con:

- `tipo`: `vacaciones`.
- `estado`: `pendiente`.
- `fecha_solicitud`: fecha actual.
- `fecha_inicio`: fecha inicial solicitada.
- `fecha_fin`: fecha final solicitada.
- `motivo`: observaciones del usuario.
- `id_empleado`: empleado logeado.

La aplicación valida que ambas fechas estén informadas y que la fecha de inicio no sea posterior a la fecha de fin.

## Solicitudes de Cambio de Turno

Los empleados y administradores pueden registrar solicitudes de cambio de turno desde:

```text
Solicitudes > Solicitud de cambio
```

El formulario solicita:

- Día del turno actual.
- Turno actual: mañana, tarde o noche.
- Nuevo día deseado.
- Turno deseado: mañana, tarde o noche.
- Observaciones.

Al enviar la solicitud, se crea un registro en la tabla `SOLICITUD` con:

- `tipo`: `cambio_turno`.
- `estado`: `pendiente`.
- `fecha_solicitud`: fecha actual.
- `fecha_turno_actual`.
- `turno_actual`.
- `fecha_turno_nuevo`.
- `turno_nuevo`.
- `motivo`: observaciones del usuario.
- `id_empleado`: empleado logeado.

La aplicación valida que el turno nuevo no sea exactamente igual al turno actual.

## Mis Solicitudes

La pantalla `Mis solicitudes` permite a cada usuario consultar únicamente sus propias solicitudes.

La consulta se filtra mediante:

```sql
WHERE id_empleado = :id_empleado
```

Cada solicitud muestra:

- Tipo.
- Estado.
- Fecha de solicitud.
- Fechas de vacaciones, si corresponde.
- Datos del cambio de turno, si corresponde.
- Motivo.
- Respuesta del administrador.

Los estados disponibles son:

- `pendiente`: solicitud creada, pendiente de revisión.
- `aprobada`: solicitud aprobada por un administrador.
- `rechazada`: solicitud rechazada por un administrador.

## Revisión de Solicitudes por el Administrador

Los usuarios con rol `admin` tienen acceso a:

```text
Solicitudes empleados
```

Esta pantalla muestra todas las solicitudes registradas por todos los empleados.

Para cada solicitud se muestra:

- Empleado.
- Usuario.
- Tipo de solicitud.
- Estado.
- Fecha de solicitud.
- Detalle de vacaciones o cambio de turno.
- Motivo.
- Respuesta administrativa.
- Acciones disponibles.

Si la solicitud está en estado `pendiente`, el administrador puede:

- Aprobar la solicitud.
- Rechazar la solicitud.
- Añadir una respuesta opcional.

Al aprobar o rechazar, la aplicación actualiza:

- `estado`.
- `respuesta_admin`.

El empleado podrá ver el nuevo estado y la respuesta desde su pantalla `Mis solicitudes`.

## Cierre de Sesión

La opción `Cerrar sesión` destruye la sesión actual y redirige al usuario a la pantalla de login.

El cierre de sesión realiza las siguientes acciones:

- Vacía `$_SESSION`.
- Elimina la cookie de sesión.
- Ejecuta `session_destroy()`.
- Redirige a `login.php`.

## Base de Datos

El sistema utiliza SQLite. La base de datos principal está en:

```text
database/database.db
```

El esquema de creación se documenta en:

```text
database/init.sql
```

### Tabla `EMPLEADO`

Almacena los usuarios del sistema:

- `id_empleado`.
- `nombre`.
- `email`.
- `dni`.
- `telefono`.
- `usuario`.
- `contrasena`.
- `rol`.

### Tabla `SOLICITUD`

Almacena las solicitudes de vacaciones y cambios de turno:

- `id_solicitud`.
- `tipo`.
- `motivo`.
- `estado`.
- `fecha_solicitud`.
- `fecha_inicio`.
- `fecha_fin`.
- `fecha_turno_actual`.
- `turno_actual`.
- `fecha_turno_nuevo`.
- `turno_nuevo`.
- `respuesta_admin`.
- `id_empleado`.

### Otras Tablas

El sistema también incluye:

- `VACACION`.
- `CUADRANTE`.
- `TURNO`.

Estas tablas forman parte del modelo de gestión de turnos y cuadrantes, aunque la integración principal actual se centra en empleados y solicitudes.

## Calendario

El calendario utiliza la librería DayPilot y permite visualizar una planificación de turnos.

Funcionalidades actuales:

- Visualización mensual.
- Navegación entre meses.
- Control de zoom.
- Creación visual de eventos en el calendario.
- Menú contextual para eliminar o modificar eventos visualmente.

Limitación actual:

- Los empleados y eventos del calendario no se cargan todavía dinámicamente desde la base de datos.

## Seguridad y Validaciones

El sistema incluye varias medidas básicas:

- Validación de login contra base de datos.
- Contraseñas verificadas mediante hash.
- Uso de sesiones PHP.
- Protección de páginas privadas.
- Comprobación de rol `admin` en páginas administrativas.
- Uso de consultas preparadas PDO para evitar inyección SQL.
- Validación básica de formularios en servidor.

## Funcionalidades Pendientes o Mejorables

Aunque el sistema ya permite un flujo completo de solicitudes, quedan posibles mejoras:

### Gestión de Usuarios

- Crear empleados desde interfaz administrativa.
- Editar empleados desde un panel admin.
- Eliminar o desactivar usuarios.
- Cambiar roles desde la aplicación.

### Gestión Real de Turnos

- Cargar empleados reales en el calendario.
- Cargar turnos desde la tabla `TURNO`.
- Actualizar turnos al aprobar solicitudes de cambio.
- Validar que el empleado tenga realmente el turno que desea cambiar.

### Solicitudes

- Añadir fecha de resolución.
- Guardar qué administrador resolvió cada solicitud.
- Añadir filtros por estado, empleado o tipo.
- Añadir buscador.

### Auditoría y Seguridad

- Registrar acciones administrativas.
- Añadir confirmaciones antes de aprobar o rechazar.
- Mejorar gestión de errores.
- Añadir recuperación o cambio de contraseña.

### Interfaz

- Mejorar responsive en tablas grandes.
- Añadir mensajes de confirmación más visibles.
- Unificar estilos de todas las pantallas.

## Soporte y Mantenimiento

Recomendaciones:

- Mantener copias de seguridad de `database/database.db`.
- No subir archivos temporales de migración o limpieza al repositorio.
- Actualizar `init.sql` cuando cambie la estructura de la base de datos.
- Probar los flujos principales antes de hacer push o entregar una versión.
- Revisar que la base de datos no contenga datos de prueba inadecuados antes de compartirla.

## Resumen del Flujo Administrativo

1. El empleado crea una solicitud de vacaciones o cambio de turno.
2. La solicitud queda guardada como `pendiente`.
3. El administrador entra en `Solicitudes empleados`.
4. El administrador revisa el detalle.
5. El administrador aprueba o rechaza la solicitud.
6. El empleado consulta el resultado en `Mis solicitudes`.

---

*Este manual refleja el estado actual del sistema tras la integración de perfiles, solicitudes y gestión administrativa con SQLite.*
