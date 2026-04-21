# Manual de Administración - Sistema de Gestión de Turnos

## 1. Introducción

Este manual está destinado a los administradores del **Sistema de Gestión de Turnos**, una aplicación web integral diseñada para la administración eficiente de horarios laborales, solicitudes de empleados y gestión de recursos humanos en empresas de cualquier tamaño.

### 1.1 Propósito del Sistema

El Sistema de Gestión de Turnos es una solución centralizada que permite:
- Administrar empleados y sus perfiles
- Crear y mantener cuadrantes de turnos
- Gestionar solicitudes de cambio de turno y vacaciones
- Generar reportes de horas y disponibilidad
- Controlar accesos mediante autenticación de roles

### 1.2 Público Objetivo

- Administradores del sistema
- Responsables de recursos humanos
- Jefes de equipo con permisos de administración
- Gerentes de operaciones

### 1.3 Nota Sobre el Desarrollo

Este sistema se encuentra en fase de desarrollo avanzado. Este manual describe tanto las funcionalidades implementadas como las previstas para su implementación futura. La arquitectura está diseñada para facilitar la expansión progresiva del sistema manteniendo estabilidad y seguridad.

---

## 2. Requisitos del Sistema

### 2.1 Requisitos de Hardware
- Servidor web con capacidad de procesamiento mínima (1 GHz)
- Memoria RAM: 2 GB mínimo (4 GB recomendado)
- Espacio en disco: 500 MB mínimo

### 2.2 Requisitos de Software
- Servidor web Apache/Nginx con PHP 7.4 o superior
- Base de datos SQLite 3.x o MySQL/PostgreSQL
- Soporte para sesiones PHP

### 2.3 Requisitos del Cliente
- Navegador web moderno (Chrome 90+, Firefox 88+, Safari 14+, Edge 90+)
- JavaScript habilitado
- Cookies habilitadas
- Conexión a internet estable
- Resolución mínima de pantalla: 1024x768 píxeles

---

## 3. Acceso al Sistema

### 3.1 Inicio de Sesión como Administrador

**Procedimiento:**

1. Abra su navegador web y navegue a la URL del sistema: `http://localhost/PIM_proyecto-turnos/frontend/views/login.php`
2. En el formulario de login, ingrese:
   - **Usuario**: `admin`
   - **Contraseña**: `1234`
   - **Rol**: Seleccione "Administrador" del menú desplegable
3. Haga clic en el botón "Entrar"
4. Si las credenciales son correctas, será redirigido al panel de administración

**Nota Actual:** El sistema utiliza credenciales hardcodeadas para autenticación. La seguridad en producción requerirá:
- Autenticación mediante base de datos con contraseñas hasheadas (bcrypt)
- Implementación de CSRF tokens
- Logs de intentos de acceso fallidos
- Sistema de bloqueo tras múltiples intentos fallidos

### 3.2 Recuperación de Contraseña

**Funcionalidad Prevista:**
Cuando se implemente el sistema de autenticación completo, estará disponible:
- Enlace "¿Olvidó su contraseña?" en la página de login
- Envío de enlace de recuperación al correo electrónico
- Token de reseteo temporal con validez limitada
- Confirmación vía email antes de cambiar contraseña

---

## 4. Interfaz de Administración

### 4.1 Menú Principal

Tras iniciar sesión, el administrador accede a un menú lateral con las siguientes opciones:

- **Inicio/Dashboard**: Panel principal con resumen de información
- **Gestión de Empleados**: Crear, editar, eliminar empleados
- **Calendario/Cuadrante**: Visualización y gestión de turnos
- **Solicitudes**: Revisión y aprobación de solicitudes
- **Reportes**: Generación de reportes y estadísticas
- **Configuración**: Ajustes del sistema
- **Perfil**: Gestión de la cuenta de administrador
- **Logout**: Cerrar sesión

### 4.2 Dashboard Administrativo

**Funcionalidades Implementadas:**

El dashboard proporciona una vista general del estado del sistema con:
- Contador de empleados activos
- Solicitudes pendientes de revisión
- Turnos asignados en el mes actual
- Resumen de vacaciones programadas
- Información del administrador conectado

**Funcionalidades Previstas:**

- Gráficos de tendencias (solicitudes por mes, disponibilidad por turno)
- Alertas automáticas para situaciones críticas (falta de cobertura, límites de horas)
- Widget de calendario mini para visualización rápida
- Tareas pendientes y actividades recientes

---

## 5. Gestión de Empleados

### 5.1 Crear Nuevo Empleado

**Acceso:** Menú principal → Gestión de Empleados → Crear Empleado

**Campos del Formulario:**

| Campo | Tipo | Requerido | Descripción |
|-------|------|-----------|-------------|
| Nombre | Texto | Sí | Nombre completo del empleado |
| Email | Email | Sí | Correo electrónico único |
| DNI/NIF | Texto | Sí | Identificación fiscal única |
| Teléfono | Teléfono | No | Número de contacto |
| Usuario | Texto | Sí | Nombre de usuario único para login |
| Contraseña | Contraseña | Sí | Mínimo 8 caracteres |
| Confirmar Contraseña | Contraseña | Sí | Debe coincidir con contraseña |
| Rol | Desplegable | Sí | Empleado, Supervisor o Administrador |
| Activo | Checkbox | No | Marca si el empleado está activo |

**Validaciones Aplicadas:**
- Email debe tener formato válido
- DNI no puede estar duplicado
- Usuario no puede estar duplicado
- Contraseña debe tener mínimo 8 caracteres con mayúscula, minúscula y número
- Teléfono debe tener formato válido

**Procedimiento:**

1. Complete todos los campos requeridos
2. Asigne el rol correspondiente
3. Haga clic en "Crear Empleado"
4. El sistema mostrará confirmación de creación exitosa
5. El nuevo empleado podrá acceder inmediatamente al sistema

### 5.2 Editar Empleado

**Acceso:** Menú principal → Gestión de Empleados → Listar Empleados → Editar

**Opciones de Edición:**

- Datos personales (nombre, email, teléfono)
- Información de contacto
- Estado del empleado (activo/inactivo)
- Cambio de rol
- Reseteo de contraseña

**Procedimiento:**

1. Localice el empleado en la lista
2. Haga clic en el icono de editar o en el nombre del empleado
3. Modifique los campos deseados
4. Haga clic en "Guardar Cambios"
5. El sistema confirmará los cambios realizados

**Nota Importante:** Los cambios en rol toman efecto inmediatamente en la próxima sesión del empleado.

### 5.3 Eliminar Empleado

**Acceso:** Menú principal → Gestión de Empleados → Listar Empleados → Eliminar

**Consideraciones Importantes:**

- **Eliminación Lógica**: Se recomienda marcar empleados como "inactivos" en lugar de eliminar para mantener historial de turnos
- **Validación**: El sistema impide eliminar empleados con turnos activos o solicitudes pendientes
- **Historial**: Se conservan registros de turnos pasados y solicitudes archivadas

**Procedimiento de Eliminación (Física):**

1. Localize el empleado en la lista
2. Haga clic en el icono de eliminar
3. Confirme la eliminación en el diálogo de confirmación
4. El empleado será eliminado del sistema permanentemente

**Procedimiento Recomendado (Marcar Inactivo):**

1. Edite el empleado
2. Desmarque la opción "Activo"
3. Haga clic en "Guardar Cambios"
4. El empleado no podrá acceder pero los datos permanecen en el sistema

### 5.4 Listar Empleados

**Acceso:** Menú principal → Gestión de Empleados → Listar Empleados

**Información Mostrada:**

- Nombre del empleado
- Usuario de login
- Email
- Rol asignado
- Estado (Activo/Inactivo)
- Fecha de creación
- Opciones de acción (Editar, Eliminar, Ver Turnos)

**Filtros Disponibles:**

- **Por Rol**: Filtrar empleados administrativos, supervisores o estándar
- **Por Estado**: Mostrar solo activos, inactivos o todos
- **Por Búsqueda**: Buscar por nombre, usuario o email

**Exportación:**

Funcionalidad prevista para exportar la lista en formatos:
- CSV (para importación en Excel)
- PDF (para impresión y archivado)
- Excel con formato personalizado

---

## 6. Gestión de Calendario y Turnos

### 6.1 Visualización del Cuadrante

**Acceso:** Menú principal → Calendario

**Componentes:**

- **Empleados**: Listado vertical con todos los empleados activos
- **Días del Mes**: Visualización horizontal de los días del mes actual
- **Turnos**: Bloques de colores que representan turnos asignados
- **Controles de Navegación**:
  - ⬅️ Mes anterior
  - Hoy (regresa al mes actual)
  - ➡️ Mes siguiente

**Codificación de Colores:**

| Color | Tipo de Turno | Horario |
|-------|---------------|---------|
| 🔵 Azul | Turno de Mañana | 08:00 - 14:00 |
| 🟢 Verde | Turno de Tarde | 14:00 - 22:00 |
| 🟣 Morado | Turno de Noche | 22:00 - 08:00 |
| ⚪ Gris | Día Libre/Vacaciones | N/A |

### 6.2 Crear Nuevo Turno

**Procedimiento:**

1. Navegue a la vista de Calendario
2. Ubique el empleado y el día deseado
3. Haga clic en la celda correspondiente
4. Seleccione el tipo de turno en el menú emergente:
   - Turno de Mañana
   - Turno de Tarde
   - Turno de Noche
5. Opcionalmente, agregue notas o comentarios
6. Haga clic en "Crear Turno"

**Validaciones:**

- Un empleado no puede tener más de un turno por día
- No se pueden crear turnos en fechas pasadas (excepto ajustes)
- El sistema verifica conflictos de horarios

**Asignación Avanzada (Funcionalidad Prevista):**

- Asignación por plantillas recurrentes (ejemplo: semana de trabajo estándar)
- Asignación automática balanceada
- Importación desde archivos CSV
- Copiar turnos del mes anterior con ajustes

### 6.3 Editar Turno

**Procedimiento:**

1. Haga clic sobre el turno a modificar en el calendario
2. Se abrirá un panel de edición con opciones:
   - Cambiar tipo de turno
   - Cambiar empleado asignado
   - Agregar comentarios
   - Cambiar color de visualización
3. Realice los cambios necesarios
4. Haga clic en "Guardar Cambios"

### 6.4 Eliminar Turno

**Procedimiento:**

1. Haga clic derecho sobre el turno (o menú de contexto)
2. Seleccione "Eliminar Turno"
3. Confirme la eliminación
4. El sistema mostrará confirmación de eliminación exitosa

**Historial:** Los turnos eliminados se archivan automáticamente para auditoría.

### 6.5 Gestión de Plantillas de Turnos

**Funcionalidad Prevista:**

- Crear plantillas estándar de horarios (ejemplo: "Semana A", "Semana B")
- Aplicar plantillas a múltiples empleados simultáneamente
- Guardar configuraciones recurrentes
- Generar horarios automáticamente para períodos extensos

**Beneficios Esperados:**

- Reduce tiempo de planificación de turnos
- Asegura equidad en distribución de horarios
- Facilita cambios masivos

---

## 7. Gestión de Solicitudes

### 7.1 Panel de Solicitudes Pendientes

**Acceso:** Menú principal → Solicitudes

**Información Mostrada:**

| Columna | Descripción |
|---------|-------------|
| Empleado | Nombre de quien realiza la solicitud |
| Tipo | Cambio de Turno o Solicitud de Vacaciones |
| Fecha Solicitud | Cuándo se realizó la solicitud |
| Detalles | Descripción de la solicitud |
| Estado | Pendiente, Aprobada, Rechazada |
| Acciones | Aprobar, Rechazar, Ver Detalles |

**Filtros:**

- Por estado (Pendiente, Aprobada, Rechazada, Todas)
- Por tipo (Cambios, Vacaciones)
- Por empleado
- Por rango de fechas

### 7.2 Revisar Solicitud de Cambio de Turno

**Procedimiento:**

1. Localice la solicitud en el panel
2. Haga clic en "Ver Detalles" o sobre la solicitud
3. Se abrirá una ventana con:
   - Datos del empleado solicitante
   - Turno actual (Fecha, Horario)
   - Turno solicitado (Fecha, Horario)
   - Motivo/Observaciones del empleado
   - Disponibilidad del turno solicitado
   - Posibles conflictos
4. Analice la información

**Opciones de Decisión:**

- **Aprobar**: Confirma el cambio de turno
  - El sistema actualiza automáticamente el calendario
  - Se notifica al empleado vía email
  - Se registra en el historial de auditoría
  
- **Rechazar**: Deniega la solicitud
  - Requiere comentario explicativo
  - Se notifica al empleado con motivo del rechazo
  - Queda registrado para futuras referencias

- **Solicitar Más Información**: Pausa la solicitud
  - Permite comunicarse con el empleado
  - La solicitud se mantiene en estado "En Revisión"

### 7.3 Revisar Solicitud de Vacaciones

**Procedimiento:**

1. Localice la solicitud en el panel
2. Haga clic en "Ver Detalles"
3. Se mostrará:
   - Fechas solicitadas (Inicio y Fin)
   - Número de días solicitados
   - Saldo de días disponibles del empleado
   - Turnos que se verían afectados
   - Motivo de la solicitud
   - Notas adicionales

**Consideraciones al Revisar:**

- Verificar que el empleado tiene días disponibles
- Verificar que la cobertura del equipo es suficiente
- Revisar vacaciones de otros empleados en el mismo período
- Consultar calendario de festivos

**Opciones de Decisión:**

- **Aprobar**: Marca vacaciones como aprobadas
  - Reserva los días en el calendario
  - Desactiva turnos durante ese período
  - Notifica al empleado

- **Rechazar**: Deniega las vacaciones
  - Requiere motivo del rechazo
  - Sugiere alternativas de fechas si es posible

- **Aprobar Parcialmente**: Aprueba solo algunos días
  - Permite flexibilidad en casos especiales

### 7.4 Historial de Solicitudes

**Acceso:** Menú principal → Solicitudes → Historial

**Información Disponible:**

- Todas las solicitudes realizadas (históricamente)
- Decisiones tomadas (Aprobadas/Rechazadas)
- Fechas de aprobación/rechazo
- Motivos del rechazo
- Cambios realizados por el administrador

**Uso:**

- Análisis de tendencias de solicitudes
- Justificación de decisiones
- Auditoría de decisiones administrativas

---

## 8. Reportes y Estadísticas

### 8.1 Funcionalidades Previstas

El módulo de reportes proporcionará análisis integral del sistema:

#### Reportes de Horas

- **Horas por Empleado**: Desglose de horas trabajadas por mes, trimestre, año
- **Horas por Turno**: Análisis de distribución de cobertura
- **Variación Horaria**: Comparación con objetivos preestablecidos
- **Sobrecarga**: Identificación de empleados con exceso de horas

#### Reportes de Solicitudes

- **Solicitudes por Empleado**: Frecuencia de solicitudes
- **Tasa de Aprobación/Rechazo**: Análisis de decisiones
- **Tiempo de Respuesta**: Promedio de días para responder solicitudes
- **Patrones de Solicitud**: Épocas con más demanda

#### Reportes de Cobertura

- **Análisis de Turnos**: Cobertura por turno (mañana, tarde, noche)
- **Días Críticos**: Días con insuficiente personal
- **Disponibilidad**: Matriz de disponibilidad por empleado
- **Predicción**: Proyección de cobertura futura

#### Reportes de Auditoria

- **Cambios del Sistema**: Log de todas las modificaciones
- **Acceso de Usuarios**: Registro de logins y acciones
- **Cambios de Datos**: Quién cambió qué y cuándo
- **Intentos de Acceso Fallidos**: Seguridad y vigilancia

### 8.2 Formatos de Exportación

Funcionalidad prevista para exportar reportes en:

- **PDF**: Formatos profesionales para impresión/archivado
- **Excel (.xlsx)**: Para análisis adicional en hojas de cálculo
- **CSV**: Para importación en otros sistemas
- **JSON**: Para integración con aplicaciones externas

---

## 9. Configuración del Sistema

### 9.1 Configuración de Turnos

**Funcionalidad Prevista:**

En el menú de Configuración, el administrador podrá definir:

**Tipos de Turnos:**
- Nombre del turno
- Hora de inicio
- Hora de fin
- Duración del descanso
- Color de visualización
- Disponibilidad (días laborales, fines de semana, festivos)

**Ejemplo de Configuración Estándar:**
```
Turno Mañana: 08:00-14:00 (6 horas)
Turno Tarde: 14:00-22:00 (8 horas)
Turno Noche: 22:00-08:00 (8 horas) + 1 hora descanso
```

### 9.2 Calendario de Festivos

**Funcionalidad Prevista:**

- Definir días festivos nacionales
- Agregar festivos regionales personalizados
- Especificar días de descanso local/regional
- Indicar cambios de festivo (días compensatorios)

**Impacto:**
- El sistema excluirá festivos de cálculos de cobertura
- No asignará turnos automáticos en festivos
- Facilitará análisis de horas reales trabajadas

### 9.3 Reglas de Negocio

**Funcionalidad Prevista:**

Configurar límites y restricciones:

- **Máximo de Turnos Consecutivos**: Evitar sobrecarga (ej: máximo 5 turnos seguidos)
- **Mínimos de Descanso**: Horas mínimas entre turnos (ej: 12 horas)
- **Máximo de Horas Mensuales**: Límite de horas por mes (ej: 180 horas)
- **Mínimo de Personal por Turno**: Cobertura mínima requerida
- **Equidad de Turnos**: Asegurar distribución justa de turnos nocturnos, etc.

### 9.4 Gestión de Permisos

**Funcionalidad Prevista:**

Definir permisos granulares por rol:

| Permiso | Administrador | Supervisor | Empleado |
|---------|---------------|-----------|----------|
| Ver Calendario | Sí | Sí | Solo propio |
| Crear Turnos | Sí | Sí | No |
| Editar Turnos | Sí | Sí | No |
| Eliminar Turnos | Sí | No | No |
| Aprobar Solicitudes | Sí | Sí | No |
| Ver Reportes | Sí | Sí | No |
| Acceso Configuración | Sí | No | No |

### 9.5 Configuración de Email

**Funcionalidad Prevista:**

- Configurar servidor SMTP para notificaciones
- Plantillas de email personalizables
- Horarios de envío de notificaciones
- Preferencias de notificación por rol

### 9.6 Backup y Recuperación

**Funcionalidad Prevista:**

- Realizar backups automáticos diarios/semanales
- Descargar backups manual mente
- Restaurar desde punto de backup específico
- Verificación de integridad de backups
- Planificación de backup automatizada

---

## 10. Seguridad y Auditoría

### 10.1 Niveles de Acceso

**Roles Implementados:**

1. **Administrador**
   - Acceso completo al sistema
   - Gestión de otros usuarios
   - Configuración del sistema
   - Acceso a reportes completos
   - Gestión de permisos

2. **Supervisor**
   - Gestión de empleados bajo su supervisión
   - Aprobación de solicitudes
   - Visualización de calendario completo
   - Reportes de equipo
   - Sin acceso a configuración global

3. **Empleado**
   - Visualización de su propio calendario
   - Creación de solicitudes
   - Gestión de perfil personal
   - Visualización de mis solicitudes
   - Sin acceso a gestión de otros empleados

### 10.2 Auditoría y Logs

**Funcionalidad Prevista:**

El sistema mantendrá registro de:

- **Acciones de Usuario**: Login, logout, cambios de datos
- **Modificaciones de Turnos**: Quién cambió qué, cuándo, motivo
- **Decisiones de Solicitudes**: Quién aprobó/rechazó, cuándo, motivo
- **Cambios de Configuración**: Modificaciones al sistema
- **Intentos Fallidos**: Intentos de acceso no autorizados
- **Exportaciones**: Qué reportes se descargaron y cuándo

**Retención de Logs:**
- Mínimo 1 año para datos sensibles
- 6 meses para acciones de rutina
- Indefinido para cambios de datos críticos

### 10.3 Medidas de Seguridad Implementadas

- **Autenticación de Sesión**: Validación de usuario en cada acción
- **Control de Entrada**: Validación de todos los formularios
- **Escapado de Datos**: Prevención de inyección SQL
- **Protección CSRF**: Tokens únicos por sesión
- **Encriptación**: Contraseñas almacenadas con hash

### 10.4 Medidas de Seguridad Previstas

- **HTTPS**: Encriptación de comunicaciones en tránsito
- **Autenticación de Dos Factores (2FA)**: Verificación adicional por SMS/Email
- **Gestión de Sesiones**: Timeout automático de sesiones inactivas
- **Rate Limiting**: Limitación de intentos de login
- **Cumplimiento RGPD**: Gestión de datos personales según normativa
- **Antivirus**: Escaneo de archivos subidos
- **Certificados SSL/TLS**: Validación de servidor

---

## 11. Mantenimiento del Sistema

### 11.1 Tareas Diarias

- Verificación de disponibilidad del sistema
- Revisión de errores en logs
- Verificación de solicitudes pendientes
- Confirmación de cobertura de turnos

### 11.2 Tareas Semanales

- Backup manual de base de datos
- Revisión de reportes de auditoría
- Actualización de configuración de festivos si es necesario
- Verificación de integridad del sistema

### 11.3 Tareas Mensuales

- Análisis de reportes de cobertura
- Evaluación de patrones de solicitudes
- Revisión de permisos de usuarios
- Limpieza de logs archivados

### 11.4 Tareas Anuales

- Auditoría de seguridad
- Revisión de cumplimiento normativo
- Evaluación de mejoras del sistema
- Planificación de actualizaciones

### 11.5 Resolución de Problemas Comunes

#### Problema: Empleado No Puede Acceder

**Causas Posibles:**
- Cuenta inactiva
- Contraseña olvidada
- Sesión bloqueada por intentos fallidos
- Navegador con caché obsoleto

**Soluciones:**
1. Verificar que la cuenta está marcada como "Activa"
2. Resetear contraseña
3. Limpiar caché del navegador
4. Probar con otro navegador

#### Problema: Conflicto de Turnos

**Causas Posibles:**
- Dos turnos asignados al mismo empleado en el mismo día
- Error en asignación automática
- Cambio manual no validado

**Soluciones:**
1. Revisar calendario del empleado
2. Eliminar turno duplicado
3. Verificar validaciones del sistema
4. Ejecutar revisión de integridad

#### Problema: Base de Datos Corrupta

**Causas Posibles:**
- Fallo de energía durante operación
- Error del servidor
- Corrupción de archivos

**Soluciones:**
1. Restaurar desde backup anterior
2. Ejecutar verificación de integridad de BD
3. Contactar al equipo de soporte técnico

---

## 12. Especificaciones Técnicas

### 12.1 Estructura de Base de Datos

```sql
-- Tabla de Empleados
CREATE TABLE EMPLEADO (
    id_empleado INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    dni TEXT NOT NULL UNIQUE,
    telefono TEXT,
    usuario TEXT NOT NULL UNIQUE,
    contrasena TEXT NOT NULL,
    rol TEXT NOT NULL (empleado|supervisor|admin),
    activo INTEGER DEFAULT 1,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de Solicitudes
CREATE TABLE SOLICITUD (
    id_solicitud INTEGER PRIMARY KEY AUTOINCREMENT,
    tipo TEXT NOT NULL (cambio_turno|vacaciones),
    motivo TEXT,
    estado TEXT NOT NULL (pendiente|aprobada|rechazada),
    fecha_solicitud DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_empleado INTEGER NOT NULL,
    FOREIGN KEY (id_empleado) REFERENCES EMPLEADO(id_empleado)
);

-- Tabla de Vacaciones
CREATE TABLE VACACION (
    id_vacacion INTEGER PRIMARY KEY AUTOINCREMENT,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    id_empleado INTEGER NOT NULL,
    estado TEXT DEFAULT 'pendiente',
    FOREIGN KEY (id_empleado) REFERENCES EMPLEADO(id_empleado)
);

-- Tabla de Cuadrantes
CREATE TABLE CUADRANTE (
    id_cuadrante INTEGER PRIMARY KEY AUTOINCREMENT,
    mes INTEGER NOT NULL,
    anio INTEGER NOT NULL,
    dias_mes INTEGER NOT NULL,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de Turnos
CREATE TABLE TURNO (
    id_turno INTEGER PRIMARY KEY AUTOINCREMENT,
    hora_inicio TEXT NOT NULL,
    hora_fin TEXT NOT NULL,
    dia_mes INTEGER NOT NULL,
    id_empleado INTEGER NOT NULL,
    id_cuadrante INTEGER NOT NULL,
    tipo TEXT NOT NULL (manana|tarde|noche),
    notas TEXT,
    FOREIGN KEY (id_empleado) REFERENCES EMPLEADO(id_empleado),
    FOREIGN KEY (id_cuadrante) REFERENCES CUADRANTE(id_cuadrante)
);
```

### 12.2 Stack Tecnológico

**Backend:**
- PHP 7.4+
- SQLite/MySQL/PostgreSQL
- PDO para acceso a base de datos

**Frontend:**
- HTML5
- CSS3 (Flexbox, Grid)
- JavaScript ES6+
- DayPilot (calendario interactivo)

**Servidor:**
- Apache/Nginx
- Sistema de archivos local

### 12.3 Arquitectura del Sistema

```
frontend/ (Interfaz de Usuario)
├── views/ (Páginas PHP)
├── js/ (JavaScript)
├── css/ (Estilos)
└── components/ (Componentes reutilizables)

backend/ (Lógica del Servidor)
├── index.php (API endpoints)
└── config/ (Configuración)

database/ (Persistencia de Datos)
├── init.sql (Estructura)
└── database.db (Datos SQLite)

docs/ (Documentación)
```

---

## 13. Soporte y Contacto

### 13.1 Canales de Soporte

- **Email**: admin@sistema-turnos.local
- **Teléfono**: Contactar al equipo de TI
- **Ticket de Soporte**: Sistema interno de tickets
- **Documentación**: Manuales PDF y online

### 13.2 Reporte de Problemas

Al reportar un problema, incluya:
- Descripción detallada del problema
- Pasos para reproducir
- Capturas de pantalla si es aplicable
- Navegador y versión utilizada
- Logs del sistema si están disponibles

---

## 14. Anexos

### 14.1 Glosario de Términos

- **Cuadrante**: Calendario de turnos asignados
- **Turno**: Período de trabajo asignado a un empleado
- **Solicitud**: Petición de cambio de turno o vacaciones
- **Rol**: Nivel de acceso y permisos del usuario
- **Auditoria**: Registro de acciones y cambios del sistema
- **Backup**: Copia de seguridad de datos
- **Hash**: Encriptación unidireccional de contraseña

### 14.2 Historial de Versiones

| Versión | Fecha | Cambios |
|---------|-------|---------|
| 0.1 | 2026-01-15 | Versión inicial - Funcionalidades básicas |
| 0.2 | 2026-02-20 | Mejoras de UI/UX |
| 0.3 | 2026-04-19 | Implementación de solicitudes (prevista) |
| 1.0 | 2026-06-30 | Lanzamiento completo (prevista) |

---

**Nota:** Este manual se actualizará conforme se implemente la funcionalidad del sistema. Última actualización: abril 2026
- Integración con el frontend.

## Recomendaciones para Desarrollo Futuro

1. **Separación de Roles:** Implementar middleware para diferenciar claramente entre empleados y administradores.
2. **Validaciones:** Agregar validaciones del lado servidor para todos los formularios.
3. **UI/UX:** Mejorar la interfaz de administración con componentes específicos (tablas de datos, modales de confirmación).
4. **Testing:** Implementar pruebas unitarias y de integración.
5. **Documentación Técnica:** Crear documentación para desarrolladores.
6. **Despliegue:** Configurar entorno de producción con servidor web, base de datos y backups.

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
