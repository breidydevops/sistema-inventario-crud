# 📦 Sistema de Gestión de Inventarios y Usuarios (PHP & MySQL)

Aplicación web full-stack desarrollada para la administración segura de usuarios y el control de inventario de productos en tiempo real. Este proyecto incluye un sistema completo de autenticación y operaciones CRUD (Crear, Leer, Actualizar, Eliminar).

## 🌐 Demo en Vivo

Puedes probar la aplicación funcionando en el siguiente enlace de producción:

- [Sistema de Inventario Online](http://tienda-app-2026.rf.gd/login.php)

---

## ✨ Características Principales

- **Autenticación Segura:** Registro de usuarios e inicio de sesión con sesiones protegidas en PHP y encriptación de contraseñas.
- **Control de Inventario (CRUD):**
  - Panel principal con la lista de productos disponibles.
  - Formulario para añadir nuevos productos al stock.
  - Opciones de edición y eliminación de registros.
- **Diseño Responsivo y Minimalista:** Interfaz limpia adaptada con CSS personalizado para una experiencia de usuario fluida.
- **Despliegue en la Nube:** Arquitectura conectada a una base de datos relacional remota (MySQL).

---

## 🛠️ Tecnologías Utilizadas

- **Backend:** PHP (Programación Orientada a Procesos / PDO)
- **Base de Datos:** MySQL (phpMyAdmin)
- **Frontend / Estilos:** HTML5, CSS3
- **Control de Versiones:** Git y GitHub
- **Hosting / Servidor:** InfinityFree

---

## 📂 Estructura del Proyecto

```text
├── conexion.php       # Archivo de conexión a la base de datos (PDO)
├── login.php          # Vista y lógica de inicio de sesión
├── registro.php       # Vista y lógica de registro de usuarios
├── dashboard.php      # Panel principal de inventario (CRUD - Leer)
├── crear.php          # Formulario para registrar nuevos productos
├── editar.php         # Formulario para actualizar productos existentes
├── eliminar.php       # Lógica para eliminar registros de la base de datos
├── logout.php         # Cierre de sesión y destrucción de variables
└── style.css          # Hoja de estilos general de la aplicación
```
