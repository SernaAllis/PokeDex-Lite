# 🎮 Pokedex Web

Una aplicación web para explorar y gestionar Pokémon usando la [PokéAPI](https://pokeapi.co/). Construida con **PHP vanilla** con arquitectura MVC y almacenamiento en caché.

---

## 📋 Características

- ✅ **Listado paginado** de Pokémon (20 por página)
- 🔍 **Búsqueda** por nombre o ID
- 🏷️ **Filtrado por tipo** (Fire, Water, Grass, Electric, etc.)
- 👁️ **Vista de detalle** con stats, habilidades y tipos
- ❤️ **Sistema de favoritos** persistente (JSON)
- 🆚 **Comparador de Pokémon** (selecciona 2 para comparar)
- ⚡ **Caché local** para reducir llamadas a la API

---

## 🛠️ Requisitos

- **PHP 8.0+** (con `ext-json`)
- **conexión a internet** (para acceder a PokéAPI)
- No requiere base de datos (usa JSON local)

### Verificar PHP instalado:
```bash
php -v
```

---

## 🚀 Instalación y Ejecución

### Opción 1: PHP Built-in Server (Recomendado para desarrollo)

1. **Navega a la carpeta del proyecto:**
```bash
cd c:\xampp\htdocs\pokedex
```

2. **Inicia el servidor PHP:**
```bash
php -S localhost:8000 -t public
```

3. **Abre tu navegador:**
```
http://localhost:8000
```

### Opción 2: XAMPP (Ya estás en htdocs)

1. Asegúrate de que **Apache** está corriendo en XAMPP
2. Abre el navegador:
```
http://localhost/pokedex/public
```

---

## 📁 Estructura del Proyecto

```
pokedex/
├── public/                    # Punto de entrada web
│   ├── index.php             # Front Controller
│   ├── css/
│   │   └── styles.css
│   └── js/
│       └── app.js
├── app/
│   ├── controllers/          # Lógica de negocio
│   │   ├── controller.php    # Controlador frontal
│   │   ├── favoritesController.php
│   │   ├── compareController.php
│   │   └── detailController.php
│   ├── services/             # Servicios reutilizables
│   │   ├── pokeApiService.php      # Conexión a PokéAPI
│   │   ├── cacheService.php        # Gestión de caché
│   │   └── favoritesService.php    # Gestión de favoritos
│   └── views/                # Plantillas HTML/PHP
│       ├── home.php
│       ├── favorites.php
│       ├── detail.php
│       ├── compare.php
│       └── layout/
│           ├── header.php
│           └── footer.php
└── storage/                  # Almacenamiento local
    ├── favorites.json        # Favoritos guardados
    └── cache/               # Caché de API (JSON)
```

---

## 🎯 Decisiones de Arquitectura

### **1. MVC Simplificado**
- **Controller:** `controller.php` actúa como Front Controller, enrutando según parámetros GET
- **Services:** Lógica separada en servicios estáticos para API y caché
- **Views:** Plantillas PHP puras, sin motor de templates

### **2. Almacenamiento en JSON**
- **Ventaja:** Cero dependencias, fácil de debuggear, portátil
- **Caché:** Almacena respuestas de PokéAPI en `/storage/cache`
- **Favoritos:** Guardados en `/storage/favorites.json`

### **3. Métodos Estáticos**
Todos los servicios usan métodos estáticos (`PokeApiService::get()`) para evitar instanciación repetida y simplificar la sintaxis.

### **4. Paginación en API**
Se implementa a nivel de servicio, no en base de datos:
- 20 Pokémon por página
- Offset calculado: `(page - 1) * 20`

### **5. Caché Inteligente**
- Primero intenta obtener del caché: `CacheService::get($url)`
- Si no existe, consulta la API: `PokeApiService::get($url)`
- Guarda para futuras consultas: `CacheService::set($url, $data)`

### **6. Routing por Parámetros GET**
```php
?page=home          # Vista principal
?page=detail&name=pikachu   # Detalle de Pokémon
?page=favorites     # Favoritos
?page=compare       # Comparador
?type=fire          # Filtrar por tipo
?p=2                # Página 2
```

---

## ⚠️ Limitaciones

### **1. Rendimiento**
- Caché basada en archivos (lento con muchas consultas simultáneas)
- Sin índices en JSON (búsquedas O(n))
- No escalable a miles de usuarios

### **2. Autenticación**
- Sin sistema de usuarios
- Los favoritos son compartidos en el navegador (locales a la máquina)

### **3. API de PokeAPI**
- Requiere conexión a internet
- Rate limit no configurado (riesgo de bloqueo con muchos usos)
- Versión 2 de PokéAPI puede tener cambios

### **4. Frontend**
- Diseño responsivo básico
- Sin JavaScript avanzado (sin AJAX)
- Comparador requiere carga completa de página

### **5. Seguridad**
- Sin validación profunda de entrada (pero se usa `htmlspecialchars()`)
- Archivos JSON accesibles si se expone `/storage/`
- Sin HTTPS ni cookies seguras

### **6. Funcionalidad**
- No hay edición de favoritos (solo agregar/quitar)
- Sin historial de búsquedas
- Sin recomendaciones personalizadas

---

## 🔧 Uso Básico

### **Buscar un Pokémon**
```
?name=pikachu
```

### **Ver detalles**
```
?page=detail&name=bulbasaur
```

### **Filtrar por tipo**
```
?type=water
```

### **Paginar**
```
?p=2          # Página 2
?p=3&type=fire # Página 3 de tipo Fire
```

### **Agregar a favoritos**
```
?page=favorites&action=add&id=25&name=pikachu&sprite=URL
```

---

## 📝 Notas de Desarrollo

- Los favoritos se guardan en JSON local (verificar permisos de `/storage/`)
- El caché se auto-genera en `/storage/cache/` (no borrar manualmente)
- Si cambias URLs de la API, actualiza `pokeApiService.php`
- Para limpiar caché, borra los archivos en `/storage/cache/`

---

**Última actualización:** Febrero 2026
