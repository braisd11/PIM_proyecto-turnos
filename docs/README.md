# Sistema de Gestión de Turnos - Documentación

## 📋 Descripción del Proyecto

El **Sistema de Gestión de Turnos** es una aplicación web desarrollada como Trabajo de Fin de Ciclo (TFC) para el curso de Desarrollo de Aplicaciones Web (DAW). Se trata de una solución integral para la administración de horarios laborales, solicitudes de empleados y gestión de recursos humanos.

### 🎯 Objetivos del Sistema

1. **Gestión de Horarios**: Crear y mantener cuadrantes de turnos de forma centralizada
2. **Solicitudes de Empleados**: Permitir que los empleados soliciten cambios de turno y vacaciones
3. **Control de Acceso**: Implementar autenticación y control de permisos por roles
4. **Administración**: Proporcionar herramientas avanzadas para administradores
5. **Escalabilidad**: Diseñar la arquitectura para facilitar expansiones futuras

---

## 📚 Manuales Incluidos

### 1. [Manual de Administración](Manual_Administracion.md)
**Para administradores y personal de RRHH**

Contenido:
- Gestión de empleados (crear, editar, eliminar)
- Gestión del calendario y turnos
- Revisión y aprobación de solicitudes
- Configuración del sistema
- Reportes y estadísticas
- Seguridad y auditoría
- Mantenimiento del sistema

**Público objetivo**: Administradores, responsables de RRHH, gerentes de operaciones

### 2. [Manual de Usuario](Manual_Usuario.md)
**Para empleados**

Contenido:
- Inicio de sesión y primer acceso
- Navegación de la interfaz
- Visualización del calendario
- Solicitud de cambio de turno
- Solicitud de vacaciones
- Gestión de perfil personal
- Resolución de problemas
- Consejos de seguridad

**Público objetivo**: Empleados, personal operativo

---

## 🔧 Especificaciones Técnicas

### Stack Tecnológico

**Backend:**
- PHP 7.4+
- SQLite / MySQL / PostgreSQL
- PDO para abstracción de base de datos

**Frontend:**
- HTML5
- CSS3 (Responsive Design)
- JavaScript ES6+
- DayPilot (Calendario interactivo)

**Servidor:**
- Apache/Nginx
- Sesiones PHP

### Estructura de Directorios

```
PIM_proyecto-turnos/
├── frontend/              # Interfaz de usuario
│   ├── turnos.php        # Punto de entrada
│   ├── components/       # Componentes reutilizables
│   │   ├── header.php
│   │   ├── footer.php
│   │   └── layout.php
│   ├── views/            # Páginas de vistas
│   │   ├── login.php
│   │   ├── admin.php
│   │   ├── calendario.php
│   │   ├── solicitud_cambio.php
│   │   ├── solicitud_vacaciones.php
│   │   ├── mis_solicitudes.php
│   │   ├── perfil.php
│   │   └── menu.php
│   ├── js/               # JavaScript
│   │   ├── main.js
│   │   ├── calendar.js
│   │   ├── dateUtils.js
│   │   └── navigation.js
│   ├── js-daypilot/      # Librerías externas
│   │   └── daypilot-all.min.js
│   └── css/              # Estilos
│       └── styles.css
│
├── backend/              # Lógica del servidor
│   ├── index.php         # API endpoints
│   └── config/
│       └── db.php        # Configuración de BD
│
├── database/             # Persistencia de datos
│   ├── init.sql          # Estructura de BD
│   ├── temp.js           # Scripts de inicialización
│   └── data/
│       ├── empleados.csv
│       ├── turno.csv
│       └── cuadrante.csv
│
└── docs/                 # Documentación
    ├── README.md         # Este archivo
    ├── Manual_Administracion.md
    └── Manual_Usuario.md
```

### Base de Datos

**Tablas Principales:**

```sql
EMPLEADO:      Información de usuarios
SOLICITUD:     Solicitudes de cambio/vacaciones
VACACION:      Registro de vacaciones aprobadas
CUADRANTE:     Calendario de turnos por mes/año
TURNO:         Asignación de turnos a empleados
```

---

## 🚀 Funcionalidades Implementadas

### ✅ Actualmente Disponibles

- [x] Sistema de login/autenticación básico
- [x] Visualización de calendario de turnos (DayPilot)
- [x] Estructura de base de datos (SQLite)
- [x] Componentes reutilizables de UI
- [x] Navegación entre vistas
- [x] Gestión de sesiones

### ⏳ En Desarrollo / Previstas

- [ ] Gestión completa de empleados (CRUD)
- [ ] Panel de revisión de solicitudes
- [ ] Sistema de aprobación de solicitudes
- [ ] Reportes y estadísticas
- [ ] Exportación de datos (PDF, Excel)
- [ ] Notificaciones por email
- [ ] Sistema de roles y permisos avanzado
- [ ] Auditoría de cambios
- [ ] Backup y recuperación
- [ ] Autenticación de dos factores

---

## 📖 Cómo Usar Esta Documentación

### Para Administradores

1. Lee la **introducción** del Manual de Administración
2. Familiarízate con la sección de **Requisitos del Sistema**
3. Aprende el **Acceso al Sistema**
4. Explora cada sección funcional:
   - Gestión de Empleados
   - Gestión de Calendario
   - Revisión de Solicitudes
   - Configuración
5. Consulta la sección de **Resolución de Problemas** si necesitas ayuda

### Para Empleados

1. Comienza con **Primer Acceso** en el Manual de Usuario
2. Lee sobre tu **Dashboard** personal
3. Aprende a usar el **Calendario**
4. Domina las **Solicitudes** (cambios y vacaciones)
5. Personaliza tu **Perfil**
6. Consulta las **Preguntas Frecuentes** para dudas comunes

---

## 🔐 Seguridad

### Consideraciones Actuales

- Autenticación mediante credenciales almacenadas
- Control de sesiones PHP
- Validación de formularios en servidor

### Recomendaciones para Producción

- Implementar HTTPS/SSL
- Usar contraseñas hasheadas (bcrypt)
- Implementar CSRF tokens
- Rate limiting en login
- Logs de auditoría
- Cumplimiento RGPD
- Autenticación de dos factores
- Encriptación de datos sensibles

---

## 🛠️ Guía de Desarrollo

### Requisitos de Instalación

1. **Servidor Web**: Apache o Nginx con PHP 7.4+
2. **Base de Datos**: SQLite 3.x (archivo local)
3. **Navegador**: Chrome 90+, Firefox 88+, Edge 90+, Safari 14+

### Instalación Rápida

```bash
# 1. Clonar/copiar repositorio
cp -r PIM_proyecto-turnos /path/to/webroot

# 2. Navegar a la carpeta
cd /path/to/webroot/PIM_proyecto-turnos

# 3. Crear base de datos (si es necesario)
sqlite3 database/database.db < database/init.sql

# 4. Acceder en navegador
http://localhost/PIM_proyecto-turnos/frontend/turnos.php
```

### Variables de Entorno

```php
// backend/config/db.php configura:
- Ruta de base de datos
- Modo de manejo de errores
- Configuración de PDO
```

---

## 📝 Convenciones de Código

### Naming

- **Variables PHP**: `$nombreVariable` (camelCase)
- **Funciones PHP**: `nombreFuncion()` (camelCase)
- **Clases PHP**: `NombreClase` (PascalCase)
- **Variables JS**: `nombreVariable` (camelCase)
- **Funciones JS**: `nombreFuncion()` (camelCase)
- **IDs CSS**: `nombre-id` (kebab-case)
- **Clases CSS**: `nombre-clase` (kebab-case)

### Estructura de Archivos

- **Vistas PHP**: `views/nombre_vista.php`
- **Componentes**: `components/nombre_componente.php`
- **Scripts JS**: `js/nombre_script.js`
- **Estilos CSS**: `css/nombre_estilo.css`

---

## 🧪 Pruebas

### Usuarios de Prueba

**Administrador:**
- Usuario: `admin`
- Contraseña: `1234`
- Rol: Admin

**Empleados:**
- Se crearán dinámicamente mediante el panel de administración

### Escenarios de Prueba

1. **Login**: Verificar acceso con credenciales correctas/incorrectas
2. **Calendario**: Navegar entre meses, visualizar turnos
3. **Solicitudes**: Crear solicitudes de cambio y vacaciones
4. **Perfil**: Editar datos personales
5. **Seguridad**: Verificar cierre de sesión, control de acceso

---

## 📞 Soporte y Contacto

### Para Problemas Técnicos

- Contacta al administrador del sistema
- Email de soporte: `soporte@sistema-turnos.local`
- Horario: Lunes a viernes, 08:00-17:00

### Reportar Bugs

Incluye:
- Descripción detallada del problema
- Pasos para reproducir
- Navegador y versión
- Capturas de pantalla
- Mensajes de error completos

---

## 📊 Historial de Versiones

| Versión | Fecha | Estado | Descripción |
|---------|-------|--------|-------------|
| 0.1 | 2026-01-15 | Inicial | Estructura base y componentes |
| 0.2 | 2026-02-20 | Desarrollo | Mejoras de UI/UX |
| 0.3 | 2026-04-19 | Beta | Solicitudes en desarrollo |
| 1.0 | 2026-06-30 | Prevista | Lanzamiento completo |

---

## 📄 Licencia y Acreditaciones

**Proyecto**: Sistema de Gestión de Turnos
**Tipo**: Trabajo de Fin de Ciclo (TFC)
**Programa**: Desarrollo de Aplicaciones Web (DAW)
**Fecha**: Abril 2026

### Tecnologías Utilizadas

- **Backend**: PHP (https://www.php.net)
- **Frontend**: HTML5, CSS3, JavaScript
- **Calendario**: DayPilot (https://www.daypilot.org)
- **BD**: SQLite (https://www.sqlite.org)
- **Servidor**: Apache/Nginx

---

## 🤝 Contribuciones Futuras

Áreas sugeridas para mejora:

1. **API REST**: Implementar API completa para integración
2. **Móvil**: Desarrollar versión responsive/PWA
3. **Analytics**: Dashboard con métricas avanzadas
4. **Integraciones**: Google Calendar, Slack, Outlook
5. **Automatización**: Asignación inteligente de turnos
6. **Notificaciones**: Sistema push en tiempo real
7. **Multiidioma**: Soporte para varios idiomas
8. **Temas**: Modo oscuro y personalización

---

## 📌 Notas Importantes

- **Base de Datos**: El sistema utiliza SQLite por defecto, ideal para desarrollo. Para producción, considerar MySQL/PostgreSQL
- **Seguridad**: Las credenciales hardcodeadas son solo para desarrollo. En producción, implementar autenticación robusta
- **Escalabilidad**: La arquitectura está diseñada para ser escalable. Revisar base de datos y caché en producción
- **Performance**: Para muchos usuarios, optimizar consultas y considerar CDN para estáticos

---

## ✅ Checklist de Entrega TFC

- [x] Documentación completa (este README + manuales)
- [x] Manual de Administración detallado
- [x] Manual de Usuario completo
- [x] Código comentado y estructurado
- [x] Requisitos técnicos especificados
- [x] Funcionalidades claramente definidas
- [x] Roadmap de desarrollo incluido
- [ ] Código fuente organizado
- [ ] Tests de funcionalidad
- [ ] Demostración en vivo

---

**Última actualización**: Abril 19, 2026

Para más información, consulta los manuales específicos:
- [Manual de Administración](Manual_Administracion.md)
- [Manual de Usuario](Manual_Usuario.md)

---

*Desarrollado como parte del Trabajo de Fin de Ciclo en Desarrollo de Aplicaciones Web (DAW)*
