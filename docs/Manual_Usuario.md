# Manual de Usuario - Sistema de Gestión de Turnos

## 1. Introducción

Bienvenido al **Sistema de Gestión de Turnos**, una aplicación web moderna diseñada para simplificar la gestión de tu horario laboral, solicitar cambios de turno, solicitar vacaciones y mantener tu información personal actualizada.

### 1.1 ¿Qué Es Este Sistema?

El Sistema de Gestión de Turnos es una plataforma centralizada que permite:
- **Visualizar tu calendario de turnos**: Ver todos tus turnos asignados
- **Solicitar cambios de turno**: Pedir intercambios o cambios de horario
- **Solicitar vacaciones**: Solicitar días libres o período de descanso
- **Gestionar tu perfil**: Mantener actualizados tus datos personales
- **Recibir notificaciones**: Estar informado sobre decisiones administrativas

### 1.2 Beneficios para el Empleado

- ⏰ **Acceso 24/7**: Accede desde cualquier dispositivo conectado a internet
- 📱 **Interfaz Intuitiva**: Diseño amigable y fácil de usar
- 🔔 **Notificaciones**: Recibe alertas sobre solicitudes aprobadas/rechazadas
- 📊 **Transparencia**: Conoce el estado de tus solicitudes en tiempo real
- 🔐 **Seguridad**: Tus datos están protegidos con autenticación

### 1.3 Nota Sobre el Desarrollo

Este sistema se encuentra en fase de desarrollo avanzado. Este manual describe tanto las funcionalidades actuales como las previstas para futuras versiones. Todas las funcionalidades descritas aquí estarán disponibles en el lanzamiento completo del sistema.

---

## 2. Requisitos

### 2.1 Requisitos Técnicos

**Navegadores Soportados:**
- ✓ Google Chrome 90+ (Recomendado)
- ✓ Mozilla Firefox 88+
- ✓ Microsoft Edge 90+
- ✓ Safari 14+

**Configuración Necesaria:**
- JavaScript habilitado
- Cookies habilitadas
- Conexión a internet estable
- Resolución mínima: 1024 x 768 píxeles (1280 x 720 recomendada)

### 2.2 Acceso y Credenciales

- **Nombre de usuario**: Proporcionado por tu administrador
- **Contraseña**: Proporcionada por tu administrador en el primer acceso
- **Rol**: Empleado (por defecto)

---

## 3. Primer Acceso

### 3.1 Inicio de Sesión

**Procedimiento:**

1. Abre tu navegador web preferido
2. Navega a la URL del sistema (proporcionada por tu administrador)
3. Serás redirigido automáticamente a la página de login si no tienes sesión activa
4. En el formulario de login, introduce:
   - **Usuario**: Tu nombre de usuario
   - **Contraseña**: Tu contraseña (proporcionada por admin)
   - **Rol**: Selecciona "Empleado" (normalmente preseleccionado)
5. Haz clic en el botón **"Entrar"**

**Ejemplo:**
```
Usuario: juan.perez
Contraseña: ••••••••
Rol: Empleado [v]
[Entrar]
```

### 3.2 Cambio de Contraseña en Primer Acceso

**Funcionalidad Prevista:**

La primera vez que inicies sesión, se te pedirá que cambies tu contraseña:

1. Se abrirá un formulario de cambio de contraseña obligatorio
2. Introduce tu contraseña temporal actual
3. Define una nueva contraseña (mínimo 8 caracteres, con mayúscula, minúscula y número)
4. Confirma la nueva contraseña
5. Haz clic en "Cambiar Contraseña"
6. Accede al sistema con tu nueva contraseña

**Consejos de Seguridad:**
- ✓ Usa una contraseña única, no reutilices contraseñas
- ✓ Combina mayúsculas, minúsculas y números
- ✓ Evita datos personales (nombre, fecha nacimiento, etc.)
- ✓ Guarda tu contraseña en un lugar seguro
- ✗ No compartas tu contraseña con nadie
- ✗ No escribas la contraseña en papeles públicos

### 3.3 Recuperación de Contraseña

**Procedimiento de Recuperación:**

1. En la página de login, haz clic en el enlace **"¿Olvidó su contraseña?"**
2. Introduce tu usuario o email
3. Haz clic en **"Enviar enlace de recuperación"**
4. Recibirás un email con un enlace de recuperación
5. Haz clic en el enlace del email
6. Define una nueva contraseña
7. Haz clic en **"Cambiar Contraseña"**

**Nota:** El enlace de recuperación es válido por 24 horas.

Si no recibes el email:
- Verifica la carpeta de spam/correo no deseado
- Espera 5 minutos y solicita un nuevo enlace
- Contacta al administrador del sistema

---

## 4. Interfaz Principal

### 4.1 Componentes de la Pantalla

Después de iniciar sesión, verás la interfaz principal dividida en:

**Menú Superior (Encabezado):**
- Logo del sistema
- Nombre de la aplicación
- Tu nombre de usuario (parte superior derecha)
- Botón de Cerrar Sesión

**Menú Lateral (Navegación):**
- **Inicio** 🏠: Dashboard personal
- **Calendario** 📅: Visualización de turnos
- **Mis Solicitudes** 📝: Gestión de solicitudes
- **Solicitudes de Cambio** 🔄: Solicitar cambio de turno
- **Solicitudes de Vacaciones** 🏖️: Solicitar vacaciones
- **Mi Perfil** 👤: Gestión de datos personales

**Área Principal (Contenido):**
- Contenido dinámico según la opción seleccionada

**Pie de Página (Footer):**
- Información de copyright
- Enlaces de ayuda
- Información de versión

### 4.2 Accesibilidad

El sistema está diseñado con accesibilidad en mente:
- ✓ Navegación por teclado (tecla Tab)
- ✓ Contraste de colores adecuado
- ✓ Textos descriptivos en botones
- ✓ Compatible con lectores de pantalla
- ✓ Responde a diferentes tamaños de pantalla

---

## 5. Dashboard (Inicio)

### 5.1 Información del Dashboard

Al hacer clic en **"Inicio"** en el menú lateral, accederás al dashboard personal que contiene:

**Sección Superior (Bienvenida):**
- Mensaje personalizado: "¡Hola, [Tu Nombre]!"
- Hora y fecha actual
- Resumen del día (turno de hoy si aplica)

**Información Personal:**
- Nombre completo
- Nombre de usuario
- Correo electrónico
- Teléfono
- Rol (Empleado)
- Última conexión

**Resumen de Turnos:**
- Turnos asignados este mes
- Horas totales previstas
- Días libres disponibles
- Próximo turno asignado

**Solicitudes Recientes:**
- Estado de últimas solicitudes enviadas
- Decisiones pendientes
- Historial reciente

**Acciones Rápidas:**
- Botón directo a "Ver Calendario"
- Botón directo a "Mis Solicitudes"
- Botón directo a "Editar Perfil"

### 5.2 Navegación del Dashboard

- **Scroll**: Desplázate hacia abajo para ver más información
- **Enlaces**: Haz clic en cualquier enlace para acceder directamente
- **Actualizar**: Usa F5 o el botón de actualizar del navegador para refrescar datos

---

## 6. Visualización del Calendario

### 6.1 Acceso al Calendario

1. Haz clic en **"Calendario"** en el menú lateral
2. Se cargará la vista de calendario con tus turnos asignados

### 6.2 Componentes del Calendario

**Encabezado del Calendario:**
- Mes y año actual: "Abril 2026"
- Botón ⬅️: Ir al mes anterior
- Botón "Hoy": Volver al mes actual
- Botón ➡️: Ir al mes siguiente
- Control de zoom (ajustar tamaño)

**Cuerpo del Calendario:**
- **Filas**: Empleados (uno por fila)
- **Columnas**: Días del mes (1 - 30/31)
- **Celdas**: Turnos asignados con colores

### 6.3 Codificación de Colores

El sistema utiliza colores distintos para cada tipo de turno:

| Color | Tipo de Turno | Horario | Descripción |
|-------|---------------|---------|-------------|
| 🔵 Azul | Turno de Mañana | 08:00 - 14:00 | Turno matutino |
| 🟢 Verde | Turno de Tarde | 14:00 - 22:00 | Turno vespertino |
| 🟣 Morado | Turno de Noche | 22:00 - 08:00 | Turno nocturno |
| ⚪ Gris | Día Libre | N/A | Descanso/Vacación |
| ⚫ Negro | Festivo | N/A | Día no laboral |

### 6.4 Interacción con el Calendario

**Ver Detalles de un Turno:**
1. Haz clic sobre el bloque de color que representa un turno
2. Se abrirá una ventana emergente con:
   - Tipo de turno
   - Hora de inicio y fin
   - Duración total
   - Notas adicionales (si las hay)
3. Haz clic fuera o en "Cerrar" para cerrar la ventana

**Navegar Entre Meses:**
- Haz clic en ⬅️ para ver el mes anterior
- Haz clic en ➡️ para ver el mes siguiente
- Haz clic en "Hoy" para volver al mes actual

**Ajustar Zoom:**
- Usa el control deslizante de zoom para agrandar/reducir celdas
- Permite adaptar la visualización a tu pantalla

**Imprimir Calendario:**
- Usa Ctrl+P (Windows) o Cmd+P (Mac) para imprimir
- El calendario se adaptará automáticamente al formato de papel

### 6.5 Información del Turno

Al hacer clic en un turno, verás:

```
┌─────────────────────┐
│ Turno de Mañana     │
│ ─────────────────── │
│ Fecha: 20 de abril  │
│ Hora: 08:00-14:00   │
│ Duración: 6 horas   │
│ Empleado: Juan Pérez│
│ ─────────────────── │
│ [Cerrar]            │
└─────────────────────┘
```

### 6.6 Exportación del Calendario

**Funcionalidad Prevista:**

Podrás descargar tu calendario en:
- **PDF**: Para impresión o archivo
- **ICS**: Para importar en Google Calendar, Outlook, etc.
- **PNG**: Como imagen para compartir

Pasos:
1. En la vista de Calendario, haz clic en el botón **"Descargar"**
2. Selecciona el formato deseado
3. Elige el rango de fechas si es necesario
4. El archivo se descargará automáticamente

---

## 7. Mis Solicitudes

### 7.1 Acceso a Solicitudes

Haz clic en **"Mis Solicitudes"** en el menú lateral para ver el estado de todas tus solicitudes.

### 7.2 Lista de Solicitudes

Se mostrará una tabla con:

| Columna | Descripción |
|---------|-------------|
| Tipo | Cambio de Turno / Vacaciones |
| Fecha Solicitud | Cuándo solicitaste |
| Detalles | Qué solicitaste |
| Fecha Decisión | Cuándo decidieron |
| Estado | Pendiente / Aprobada / Rechazada |
| Comentarios | Notas del administrador |

**Estados Posibles:**

- 🟡 **Pendiente**: Esperando revisión del administrador
- 🟢 **Aprobada**: Solicitud aceptada
- 🔴 **Rechazada**: Solicitud denegada

### 7.3 Filtrar Solicitudes

**Filtros Disponibles:**

- **Por Tipo**: Mostrar solo cambios, solo vacaciones, o todas
- **Por Estado**: Mostrar pendientes, aprobadas, rechazadas, o todas
- **Por Fecha**: Mostrar del último mes, trimestre, año, o rango personalizado

**Cómo Filtrar:**

1. Localiza los filtros en la parte superior de la tabla
2. Selecciona las opciones deseadas
3. Haz clic en **"Aplicar Filtros"**
4. La tabla se actualizará con los resultados

### 7.4 Ver Detalles de una Solicitud

1. Haz clic sobre una solicitud en la tabla
2. Se abrirá un panel lateral o ventana con detalles completos:
   - Información de la solicitud
   - Fecha exacta
   - Motivo/Descripción
   - Decisión (si la hay)
   - Comentarios del administrador
3. Haz clic fuera o en "Cerrar" para cerrar

### 7.5 Exportar Historial

**Funcionalidad Prevista:**

- Descargar historial de solicitudes en PDF
- Generar reporte de solicitudes por período
- Exportar como Excel para análisis personal

---

## 8. Solicitar Cambio de Turno

### 8.1 Acceso a la Solicitud

Haz clic en **"Solicitudes de Cambio"** en el menú lateral para solicitar un cambio de turno.

### 8.2 Formulario de Cambio de Turno

**Campos del Formulario:**

| Campo | Tipo | Requerido | Descripción |
|-------|------|-----------|-------------|
| Turno Actual | Selección | Sí | El turno que deseas cambiar |
| Turno Deseado | Selección | Sí | El nuevo turno que quieres |
| Fecha Actual | Calendario | Sí | Día del turno a cambiar |
| Fecha Deseada | Calendario | Sí | Día del nuevo turno |
| Motivo | Texto libre | Sí | Razón del cambio |
| Notas Adicionales | Texto libre | No | Información adicional |

### 8.3 Paso a Paso: Solicitar Cambio

**Ejemplo Práctico:**

Quieres cambiar tu turno de mañana del 20 de abril al turno de tarde del 21 de abril porque tienes que asistir a una cita médica.

**Pasos:**

1. Haz clic en **"Solicitudes de Cambio"**
2. En el campo **"Turno Actual"**, selecciona "Turno Mañana"
3. En el campo **"Turno Deseado"**, selecciona "Turno Tarde"
4. En el campo **"Fecha Actual"**, selecciona el 20 de abril
5. En el campo **"Fecha Deseada"**, selecciona el 21 de abril
6. En el campo **"Motivo"**, escribe: "Cita médica a las 9:00 AM"
7. En **"Notas Adicionales"**, puedes escribir: "Puedo trabajar la tarde del 21"
8. Haz clic en el botón **"Enviar Solicitud de Cambio"**
9. Verás un mensaje de confirmación: "Solicitud enviada correctamente"

### 8.4 Validaciones

El sistema verifica automáticamente:

✓ Que tengas un turno asignado en la fecha actual
✓ Que el turno deseado no esté ocupado
✓ Que no solicites cambios de fechas pasadas
✓ Que los campos obligatorios estén completos

**Mensajes de Error Comunes:**

- "No tienes un turno asignado en esa fecha"
- "El turno deseado ya está ocupado"
- "No puedes solicitar cambios de fechas pasadas"
- "Todos los campos son obligatorios"

### 8.5 Después de Enviar

Una vez enviada:

1. Recibirás una confirmación en pantalla
2. Se te mostrará un número de referencia (ejemplo: #SOL-2026-04-001)
3. Guardará tu solicitud automáticamente
4. Recibirás un email de confirmación (funcionalidad prevista)
5. Podrás seguir el estado en "Mis Solicitudes"

**Tiempo de Respuesta:**
- Típicamente se responden dentro de 24-48 horas hábiles
- El administrador revisará disponibilidad y cobertura

---

## 9. Solicitar Vacaciones

### 9.1 Acceso a la Solicitud

Haz clic en **"Solicitudes de Vacaciones"** en el menú lateral para solicitar días de vacaciones.

### 9.2 Formulario de Vacaciones

**Campos del Formulario:**

| Campo | Tipo | Requerido | Descripción |
|-------|------|-----------|-------------|
| Fecha Inicio | Calendario | Sí | Primer día de vacaciones |
| Fecha Fin | Calendario | Sí | Último día de vacaciones |
| Motivo | Texto libre | Sí | Razón de las vacaciones |
| Notas | Texto libre | No | Información adicional |
| Preferencias | Checkbox | No | Preferencias de fechas |

### 9.3 Paso a Paso: Solicitar Vacaciones

**Ejemplo Práctico:**

Deseas solicitar 5 días de vacaciones del 25 al 29 de abril para un viaje.

**Pasos:**

1. Haz clic en **"Solicitudes de Vacaciones"**
2. En el campo **"Fecha Inicio"**, selecciona el 25 de abril
3. En el campo **"Fecha Fin"**, selecciona el 29 de abril
4. En el campo **"Motivo"**, escribe: "Viaje familiar"
5. En **"Notas"**, puedes escribir: "Preferiblemente semana completa"
6. Si aplica, marca las preferencias de fecha
7. Haz clic en el botón **"Solicitar Vacaciones"**
8. Verás un mensaje: "Solicitud de vacaciones enviada correctamente"

### 9.4 Información de Disponibilidad

El sistema mostrará automáticamente:

- **Días de Vacaciones Disponibles**: Cuántos días tienes acumulados
- **Días Solicitados**: Cuántos días solicitas
- **Saldo Restante**: Cuántos días te quedarían si se aprueban
- **Conflictos**: Si hay conflictos de cobertura o restricciones

**Ejemplo:**
```
Disponibles: 22 días
Solicitados: 5 días
Saldo Restante: 17 días

✓ Se puede cubrir la ausencia
✓ Sin conflictos de fechas
```

### 9.5 Validaciones de Vacaciones

El sistema verifica:

✓ Que tengas suficientes días disponibles
✓ Que la fecha de fin sea posterior a la de inicio
✓ Que no solicites fechas ya aprobadas
✓ Que no haya restricciones por cobertura mínima

**Mensajes de Error:**

- "No tienes suficientes días disponibles"
- "La fecha de fin debe ser posterior a la de inicio"
- "Ya tienes vacaciones solicitadas en esas fechas"
- "No se puede garantizar cobertura en esas fechas"

### 9.6 Estado de Vacaciones

Los estados de una solicitud de vacaciones pueden ser:

- 🟡 **Pendiente**: Esperando decisión del administrador
- 🟢 **Aprobada**: Vacaciones confirmadas
- 🔴 **Rechazada**: Solicitud denegada (con motivo)
- 🟠 **Parcialmente Aprobada**: Aprobadas solo algunos días

---

## 10. Gestión del Perfil

### 10.1 Acceso al Perfil

Haz clic en **"Mi Perfil"** en el menú lateral para gestionar tu información personal.

### 10.2 Información del Perfil

Se mostrarán varios apartados:

**Datos Personales:**
- Nombre Completo
- Email
- Teléfono
- DNI/NIF
- Fecha de Nacimiento
- Género

**Información de Trabajo:**
- Usuario
- Rol
- Departamento/Equipo
- Fecha de Inicio
- Horario Base

**Foto de Perfil:**
- Foto actual (si la hay)
- Opción para cambiar foto

### 10.3 Editar Datos Personales

**Procedimiento:**

1. En "Mi Perfil", haz clic en el botón **"Editar Información"**
2. Se habilitarán los campos para edición
3. Modifica los campos que desees:
   - Teléfono
   - Email (si se permite)
   - Datos personales (si se permite)
4. Haz clic en **"Guardar Cambios"**
5. Verás un mensaje de confirmación

**Campos Editables:**
- ✓ Teléfono
- ✓ Email (si no está vinculado a otro usuario)
- ✓ Fecha de Nacimiento
- ✗ Nombre (requiere administrador)
- ✗ Usuario (requiere administrador)
- ✗ Rol (requiere administrador)

### 10.4 Cambio de Contraseña

**Procedimiento:**

1. En "Mi Perfil", busca la sección **"Seguridad"**
2. Haz clic en **"Cambiar Contraseña"**
3. Se abrirá un formulario con:
   - Contraseña Actual
   - Nueva Contraseña
   - Confirmar Nueva Contraseña
4. Introduce tu contraseña actual
5. Define una nueva contraseña:
   - Mínimo 8 caracteres
   - Debe incluir mayúscula
   - Debe incluir minúscula
   - Debe incluir número
6. Confirma la nueva contraseña
7. Haz clic en **"Cambiar Contraseña"**

**Indicador de Seguridad:**

El sistema mostrará una barra indicando la seguridad de tu contraseña:

```
Contraseña: ••••••••• [Seguridad: Fuerte ████████]
```

- Débil (rojo): Menos de 8 caracteres
- Normal (amarillo): Cumple requisitos mínimos
- Fuerte (verde): Buena combinación de caracteres

### 10.5 Foto de Perfil

**Cargar Foto:**

1. En "Mi Perfil", localiza la sección de Foto
2. Haz clic en **"Cambiar Foto"** o en la foto actual
3. Selecciona una imagen de tu dispositivo
4. Formatos aceptados: JPG, PNG, GIF
5. Tamaño máximo: 5 MB
6. Se mostrará una previsualización
7. Haz clic en **"Guardar Foto"**

**Recomendaciones:**
- Usa foto de rostro clara
- Fondo neutral
- Resolución mínima: 200x200 píxeles
- Formatos: JPG o PNG

**Eliminar Foto:**
1. Haz clic en **"Eliminar Foto"**
2. Confirma la acción
3. Se restaurará la foto predeterminada

### 10.6 Notificaciones

**Funcionalidad Prevista:**

Podras configurar las notificaciones que recibes:

- **Por Email**: Decisiones sobre solicitudes
- **Por SMS**: Cambios de turno importantes
- **En la App**: Alertas internas del sistema
- **Horario de Notificaciones**: Especificar horario

**Opciones de Notificación:**
- ☑ Notificar cuando se aprueba solicitud
- ☑ Notificar cuando se rechaza solicitud
- ☐ Notificar cambios en calendario
- ☑ Notificar próximo turno

---

## 11. Cierre de Sesión

### 11.1 Cerrar Sesión Correctamente

**Método 1: Mediante Menú**

1. Localiza tu nombre de usuario en la esquina superior derecha
2. Haz clic en el menú desplegable (▼)
3. Selecciona **"Cerrar Sesión"** o **"Logout"**
4. Serás redirigido a la página de login

**Método 2: Mediante Botón**

1. Busca el botón de "Cerrar Sesión" en el menú lateral
2. Haz clic en él
3. Confirma la acción si se te solicita

### 11.2 Cierre Automático de Sesión

**Funcionalidad Prevista:**

- Tu sesión se cerrará automáticamente después de **30 minutos de inactividad**
- Recibirás una advertencia 5 minutos antes del cierre
- Puedes extender tu sesión haciendo clic en "Continuar"

**Seguridad:**
- Al cerrar sesión, se eliminan todas las cookies de sesión
- No se puede acceder al sistema con el navegador hacia atrás
- Siempre cierra sesión en equipos compartidos

### 11.3 Advertencia de Inactividad

Verás una ventana 5 minutos antes del cierre:

```
┌────────────────────────────────┐
│ ⚠️ Sesión Expirará            │
│ ────────────────────────────── │
│ Tu sesión expirará en 5 min    │
│ por inactividad.              │
│                               │
│ [Continuar] [Cerrar Sesión]   │
└────────────────────────────────┘
```

---

## 12. Funcionalidades Avanzadas

### 12.1 Intercambio de Turnos

**Funcionalidad Prevista:**

Podrás solicitar intercambiar turnos directamente con otro compañero:

**Procedimiento:**
1. Ve a "Solicitudes de Cambio"
2. Selecciona "Intercambio de Turno"
3. Elige al compañero con quien quieres intercambiar
4. Selecciona los turnos a intercambiar
5. El compañero recibirá una notificación
6. Ambos deben confirmar
7. El administrador valida y aprueba

### 12.2 Búsqueda de Turnos Disponibles

**Funcionalidad Prevista:**

Cuando solicites un cambio, podrás ver:

- Turnos disponibles del compañero seleccionado
- Disponibilidad por turno
- Historial de cambios previos
- Sugerencias automáticas de cambios posibles

### 12.3 Reportes Personales

**Funcionalidad Prevista:**

Genera reportes de:
- Horas trabajadas (mensual, trimestral, anual)
- Solicitudes realizadas
- Historial de cambios
- Comparativa con años anteriores

---

## 13. Resolución de Problemas

### 13.1 Problemas de Acceso

**Problema: No puedo acceder al sistema**

**Soluciones:**
1. Verifica que el servidor está en línea (contacta al administrador)
2. Comprueba tu conexión a internet
3. Limpia el caché del navegador:
   - Chrome: Ctrl+Shift+Delete
   - Firefox: Ctrl+Shift+Delete
   - Safari: Cmd+Shift+Delete
4. Intenta con otro navegador
5. Desactiva temporalmente extensiones del navegador

**Problema: Olvidé mi contraseña**

**Soluciones:**
1. Haz clic en "¿Olvidó su contraseña?" en el login
2. Introduce tu usuario
3. Haz clic en "Enviar enlace de recuperación"
4. Revisa tu email (incluido spam)
5. Haz clic en el enlace
6. Define una nueva contraseña
7. Accede con la nueva contraseña

Si no recibes el email:
- Contacta al administrador
- Proporciona tu nombre de usuario

### 13.2 Problemas con Calendario

**Problema: No veo mis turnos en el calendario**

**Soluciones:**
1. Recarga la página (F5)
2. Verifica que estás en el mes correcto
3. Comprueba que te has logueado correctamente
4. Limpia caché del navegador
5. Prueba con otro navegador

**Problema: El calendario se muestra lentamente**

**Soluciones:**
1. Reduce el zoom (Ctrl+Menos)
2. Cierra otras pestañas del navegador
3. Reinicia el navegador
4. Comprueba tu conexión a internet

### 13.3 Problemas con Solicitudes

**Problema: No puedo enviar una solicitud**

**Soluciones:**
1. Verifica que todos los campos obligatorios están completos
2. Comprueba que las fechas son válidas
3. Asegúrate de no tener solicitudes pendientes similares
4. Recarga la página
5. Intenta con otro navegador

**Problema: Mi solicitud fue rechazada, ¿qué puedo hacer?**

**Soluciones:**
1. Lee el motivo del rechazo proporcionado
2. Intenta solicitar otras fechas
3. Solicita una reunión con el administrador
4. Contacta al administrador vía email

### 13.4 Problemas de Navegación

**Problema: Los enlaces no funcionan**

**Soluciones:**
1. Asegúrate de tener JavaScript habilitado
2. Recarga la página
3. Limpia caché
4. Intenta con otro navegador

**Problema: La interfaz se ve desorganizada**

**Soluciones:**
1. Aumenta la resolución de la pantalla
2. Reduce el zoom del navegador (Ctrl+Menos)
3. Amplía la ventana del navegador
4. Prueba con otro navegador

---

## 14. Consejos y Mejores Prácticas

### 14.1 Seguridad

✓ **Hacer:**
- ✓ Cambiar contraseña regularmente (cada 90 días)
- ✓ Cerrar sesión siempre antes de salir
- ✓ Usar navegador actualizado
- ✓ Informar de accesos no autorizados

✗ **No Hacer:**
- ✗ Compartir credenciales con compañeros
- ✗ Guardar contraseña en notas públicas
- ✗ Usar contraseña simple o predecible
- ✗ Acceder desde redes WiFi abiertas

### 14.2 Gestión de Solicitudes

**Recomendaciones:**
- Realiza solicitudes con tiempo de anticipación
- Sé claro en el motivo de tu solicitud
- Proporciona fechas alternativas si es posible
- Revisa regularmente el estado de tus solicitudes
- Comunica cambios al administrador lo antes posible

### 14.3 Uso del Calendario

- Consulta el calendario regularmente
- Prepárate para tus turnos con anticipación
- Avisa si hay cambios en tu disponibilidad
- Revisa notas y alertas en los turnos

### 14.4 Datos Personales

- Mantén tu email actualizado para recibir notificaciones
- Actualiza tu teléfono para emergencias
- Revisa tu perfil regularmente
- Notifica cambios al administrador

---

## 15. Soporte y Ayuda

### 15.1 Canales de Soporte

**Contacto Directo:**
- **Email**: soporte@sistema-turnos.local
- **Teléfono**: Contactar a Recursos Humanos
- **Presencial**: Oficina de RRHH

**Horas de Atención:**
- Lunes a Viernes: 08:00 - 17:00
- Sábados: Cerrado
- Domingos: Cerrado

### 15.2 Reportar un Problema

Cuando reportes un problema, incluye:
1. Descripción clara del problema
2. Pasos que realizaste antes del error
3. Mensaje de error completo (si lo hay)
4. Navegador y versión utilizada
5. Tu nombre de usuario
6. Captura de pantalla (si es posible)

**Correo de Reporte:**
```
Asunto: Problema en Sistema de Turnos - [Tu Nombre]
Cuerpo: [Descripción detallada del problema]
Adjuntos: [Capturas de pantalla si aplica]
```

### 15.3 Preguntas Frecuentes (FAQ)

**P: ¿Con cuánta anticipación debo solicitar un cambio?**
R: Se recomienda con al menos 48 horas de anticipación.

**P: ¿Puedo solicitar múltiples cambios a la vez?**
R: Sí, pero cada solicitud se revisa individualmente.

**P: ¿Cuántos días de vacaciones me corresponden?**
R: Depende de tu contrato. Consulta con RRHH.

**P: ¿Qué hago si me ponen un turno que no quería?**
R: Puedes solicitar un cambio. El administrador valorará la solicitud.

**P: ¿Se envían notificaciones por email?**
R: Sí, para decisiones sobre solicitudes (funcionalidad en desarrollo).

---

## 16. Glosario

- **Turno**: Período de trabajo asignado con horario específico
- **Cuadrante**: Calendario completo de turnos
- **Solicitud**: Petición de cambio o permiso
- **Vacaciones**: Días de descanso remunerados
- **Sesión**: Conexión activa al sistema
- **Rol**: Nivel de acceso y permisos
- **Contraseña**: Clave de acceso personal y segura
- **Perfil**: Información personal del usuario
- **Dashboard**: Panel de inicio con información resumida

---

## 17. Historial de Versiones

| Versión | Fecha | Cambios |
|---------|-------|---------|
| 0.1 | 2026-01-15 | Versión inicial |
| 0.2 | 2026-02-20 | Mejoras de UX |
| 0.3 | 2026-04-19 | Solicitudes en desarrollo |
| 1.0 | 2026-06-30 | Lanzamiento completo (prevista) |

---

## 18. Información Adicional

### 18.1 Política de Privacidad

Tus datos personales están protegidos conforme a la regulación RGPD. No se comparten con terceros sin consentimiento.

### 18.2 Accesibilidad

El sistema está diseñado para ser accesible a usuarios con discapacidades. Si experimentas problemas de accesibilidad, contacta al administrador.

### 18.3 Retroalimentación

Tu opinión es importante. Puedes enviar sugerencias para mejorar el sistema a través del correo de soporte.

---

**¡Gracias por usar el Sistema de Gestión de Turnos!**

Para más información, consulta el Manual de Administración o contacta al administrador del sistema.

**Última actualización:** Abril 2026

Toda la información personal proporcionada se utiliza únicamente para fines de gestión de turnos y se almacena de forma segura. No se comparte con terceros sin autorización.

---

*Este manual está sujeto a actualizaciones. Consulte con el administrador para la versión más reciente.*</content>
<parameter name="filePath">c:\xampp\htdocs\proyecto-turnos\Manual_Usuario.md