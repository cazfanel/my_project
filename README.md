
## Requisitos Previos

- **PHP** >= 8.0
- **Composer**
- **Laravel Framework** (v10)
- **Base de datos**: MySQL 

## Instalación

### 1. Clonar el repositorio


```bash
git clone https://github.com/tu_usuario/mi_project.git cd mi_project
```

### 2. Instalar dependencias de Composer


```bash
composer install
```

### 3. Copiar el archivo de entorno y configurar


```bash
cp .env.example .env
```

- Edita el archivo `.env` y configura los detalles de tu base de datos y otras variables de entorno necesarias.

### 4. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 5. Ejecutar migraciones y seeders

```bash
php artisan migrate --seed
```


- Esto creará las tablas necesarias y, opcionalmente, insertará datos iniciales.

### 6. Instalar dependencias de NPM (opcional)

Si tu proyecto utiliza assets front-end:



```bash
npm install npm run dev
```

## Estructura del Proyecto

El proyecto sigue la Arquitectura Hexagonal y está organizado en las siguientes capas:

```bash
/src
├── Application
│   ├── Application.php                // Implementación de ApplicationInterface
│   ├── Commands                       // Objetos de comando (DTOs)
│   ├── Services                       // Servicios de aplicación (casos de uso)
│   └── Interfaces
│       └── ApplicationInterface.php   // Interfaz que define los casos de uso
├── Domain
│   ├── Entities                       // Entidades de dominio (Ebook, Order)
│   ├── Repositories                   // Interfaces de repositorios (puertos de salida)
│   └── ValueObjects                   // Objetos de valor (OrderId, EbookId)
├── Infrastructure
│   ├── Http
│   │   ├── Controllers                // Controladores HTTP (adaptadores de entrada)
│   │   └── Requests                   // Validaciones de solicitudes HTTP
│   ├── Persistence
│   │   ├── Models                     // Modelos Eloquent
│   │   ├── Repositories               // Implementaciones de repositorios (adaptadores de salida)
│   │   └── InMemory                   // Repositorios en memoria para pruebas
│   └── Console
│       └── Commands                   // Comandos de consola
└── Providers
    └── AppServiceProvider.php         // Registro de dependencias e inyección

```


- **Application**: Contiene la lógica de aplicación y los casos de uso.
- **Domain**: Contiene las entidades de dominio y las reglas de negocio.
- **Infrastructure**: Contiene los detalles de infraestructura, como controladores, repositorios y modelos.

## Uso

### Ejecutar el servidor de desarrollo


```bash
php artisan serve
```


El servidor estará disponible en `http://localhost:8000`.

### Rutas Disponibles

#### 1. Listar libros electrónicos disponibles

- **Método**: GET
- **URL**: `/api/ebooks`
- **Descripción**: Obtiene una lista de libros electrónicos disponibles.

**Ejemplo de solicitud:**

```bash
curl -X GET http://localhost:8000/api/ebooks
```

**Respuesta esperada:**

```bash
[
  {
    "id": 1,
    "title": "Aprendiendo Laravel",
    "author": "Juan Pérez",
    "price": 19.99,
    "available": true
  },
  {
    "id": 2,
    "title": "Arquitectura Hexagonal en PHP",
    "author": "María López",
    "price": 24.99,
    "available": true
  }
]

```
#### 2. Crear un pedido

- **Método**: POST
- **URL**: `/api/orders`
- **Descripción**: Crea un nuevo pedido de un libro electrónico.

**Parámetros requeridos:**

- `ebook_id` (int): ID del libro electrónico.
- `quantity` (int): Cantidad a comprar.
- `email` (string): Correo electrónico del cliente.

**Ejemplo de solicitud:**


```bash
curl -X POST http://localhost:8000/api/orders \
     -H 'Content-Type: application/json' \
     -d '{
           "ebook_id": 1,
           "quantity": 2,
           "email": "cliente@example.com"
         }'

```
**Respuesta esperada:**

```bash
{   "order_id": 1 }
`````

### Nota

- Asegúrate de tener libros electrónicos disponibles en tu base de datos antes de realizar pedidos.
- Puedes usar seeders para insertar datos de ejemplo.

## Pruebas

### Ejecutar pruebas unitarias

El proyecto incluye pruebas unitarias utilizando PHPUnit. Para ejecutar las pruebas:


```bash
php artisan test
```

### Configuración de pruebas

- Los repositorios en memoria se utilizan durante las pruebas para evitar dependencias en la base de datos.
- Las dependencias se inyectan utilizando el contenedor de Laravel y se configuran en los casos de prueba.

**Ejemplo de configuración en pruebas:**

```bash
protected function setUp(): void
{
    parent::setUp();

    $this->app->bind(EbookRepository::class, InMemoryEbookRepository::class);
    $this->app->bind(OrderRepository::class, InMemoryOrderRepository::class);
}

```

