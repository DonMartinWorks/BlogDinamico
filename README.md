<a name="readme-top"></a>

# Sobre el Proyecto

_Este proyecto es blog de presentación para demostrar a terceros las habilidades y/o un contenido demostrativo, que el usuario puede demostrar dinánicamente, este puede crear, editar y eliminar su contenido como cambiar las imagenes de estas._

<br />
<br />

## Creación de archivos necesarios

1. _Crea un archivo llamado <b>.env</b> tomando de ejemplo de archivo <b>.env.example</b> este archivo es necesario para el funcionamiento del proyecto._

<br />
<br />

### Levantar el servidor Local

<p>Levantar estos comandos en 2 consolas <b>CMD</b> al mismo tiempo</p>

1. Levantado de servidor local

    ```
    php artisan serve
    ```

2. Servidor de instancias de NPM

    ```
    npm run dev
    ```

<br />
<br />

# Instalación del proyecto

_Para la instalacion de este proyecto Laravel es necesario seguir los siguientes comandos_

1. Instalacion de los paquetes `Composer`

    ```
    composer install
    ```

2. Instalacion de los paquetes `NODE`

    ```
    npm install
    ```

3. Construcción de los paquetes `NODE`

    ```
    npm run build
    ```

4. Construcción de la DB.

    ```
    php artisan migrate
    ```

5. Generación de una llave de proyecto

    ```
    php artisan key:generate
    ```

6. Generación de seeds

    ```
    php artisan db:seed
    ```

7. Creación de los enlaces simbólicos, para generar en la carpeta public las imagenes por defecto

    ```
    php artisan storage:link
    ```

<br />
<br />

## Generar el sistema de testing

_Esta sección es para generar los archivos necesarios para las pruebas unitarias (TDD)_

1. _Crea un archivo llamado <b>.env.testing</b> tomando de ejemplo de archivo <b>.env.example</b> este archivo es necesario para hacer las pruebas TDD._

2. Copia el archivo .env.example y en APP_ENV cambia el local por testing

    ```bash
    APP_ENV=testing
    ```

3. Genera una llave exclusiva para el .env.texting con el siguiente comando

    ```
    php artisan key:generate --env=testing
    ```

_Este codigo creará una llave en: `APP_KEY=` exclusiva para el funcionamiento de las pruebas unitarias._

<br />
<br />

### Hacer funcionar el sistema de testing

_Tambien se puede utilizar el llamado de test con: (llamando al test con su nombre listado abajo)_

-   NavigationTest
-   ItemTest
-   InfoTest
-   ImageTest
-   ProjectTest
-   ContactTest
-   SocialLinkTest
-   FooterLinkTest

```bash
  php artisan test --filter NavigationTest
```

_O llamando por su nombre y ruta._

1. Aplica el siguiente codigo en la consola de comandos. Para ver las pruebas unitarias de navigation.

    ```
    php artisan test ./tests/Feature/Navigation/NavigationTest.php
    ```

2. Aplica el siguiente codigo en la consola de comandos. Para ver las pruebas unitarias de item.

    ```
    php artisan test ./tests/Feature/Navigation/ItemTest.php
    ```

3. Aplica el siguiente codigo en la consola de comandos. Para ver las pruebas unitarias de info.

    ```
    php artisan test ./tests/Feature/Hero/InfoTest.php
    ```

4. Aplica el siguiente codigo en la consola de comandos. Para ver las pruebas unitarias de image.

    ```
    php artisan test ./tests/Feature/Hero/ImageTest.php
    ```

5. Aplica el siguiente codigo en la consola de comandos. Para ver las pruebas unitarias de project.

    ```
    php artisan test ./tests/Feature/Project/ProjectTest.php
    ```

6. Aplica el siguiente codigo en la consola de comandos. Para ver las pruebas unitarias de contact.

    ```
    php artisan test ./tests/Feature/Contact/ContactTest.php
    ```

7. Aplica el siguiente codigo en la consola de comandos. Para ver las pruebas unitarias de social links.

    ```
    php artisan test ./tests/Feature/Contact/SocialLinkTest.php
    ```

8. Aplica el siguiente codigo en la consola de comandos. Para ver las pruebas unitarias del footer.

    ```
    php artisan test ./tests/Feature/Navigation/FooterLinkTest.php
    ```

<br />
<br />

### Comandos SQL

```
php artisan migrate:rollback
```

<p>Regresa a la migracion anterior de la DB</p>

<br />

```
php artisan migrate:refresh
```

<p>Limpia la DB</p>

<br />

```
php artisan migrate:rollback --step=1
```

<p>Regresa a la migracion anterior de un paso de la DB</p>

<br />
<br />

### Reinicio de la Base de Datos

```
php artisan migrate:fresh --seed
```

<p>Reinicia desde cero la DB y crea los seeders</p>

<br />

```
php artisan migrate:refresh --seed
```

<p>Limpia la DB y crea los seeders</p>

<br />
<br />

## Otros Comandos

_Comandos que podrian ser necesarios_

1. Generación de seeds

    ```
    php artisan db:seed
    ```

2. Limpieza de caché

    ```
    php artisan config:cache
    ```

3. Creacion de los links de los archivos estaticos

    ```
    php artisan storage:link
    ```

4. Creacion de un modelo con controller tipo resource, con migration y seeder para la DB.
    ```
    php artisan make:model Model -mcs --resource
    ```

<br />
<br />

#### Paquetes Utilizados

<p align="left">
<a href="https://laravel.com/docs/9.x/starter-kits#laravel-breeze">Breeze</a>
<br />
<a href="https://publisher.laravel-lang.com/">Laravel Lang Publisher</a>
<br />
<a href="https://laravel-livewire.com/">Livewire</a>
<br />
<a href="https://alpinejs.dev/">Alpine.js</a>
</p>

<br />
<br />

###### Laravel Lang Instalacion (Hoy 20/02/23 - pagina caida)

<p align="left">

1. Creacion de los archivos base de composer.
    ```
    composer require laravel-lang/publisher laravel-lang/lang laravel-lang/attributes --dev
    ```

2. Creacion de los archivos vwndor.
    ```
    php artisan vendor:publish --provider="LaravelLang\Publisher\ServiceProvider"
    ```

3. Creacion de los archivos de traducción (añadir una localizacion ESPAÑOL).
    ```
    php artisan lang:add es
    ```

4. Reemplazar el locale de `en` a `es`
    ```
    ruta-proyecto/config/app.php (linea 85)
    ```


</p>

<br />
<br />

#### Programas que utilicé

_Lista de programas utilizados en este proyecto_

<p align="left">
<a href="https://nodejs.org/">Node <b>LTS</b></a>
<br />
<a href="https://getcomposer.org/download/">Composer</a>
</p>

<br />
<br />

## Contacto

Mi Cuenta GitHub: [https://github.com/DonMartinWorks](https://github.com/DonMartinWorks)

<br />

Link ReadMe Opción N°2: [https://readme.so/es](https://readme.so/es)

<br />
<br />

<a href="#readme-top">Subir a las instrucciones</a>
