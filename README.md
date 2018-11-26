Symfony2.
====================================
 
Requerimientos
---------------

* Apache 2.2 con mod rewrite activado
* PHP 5.3.3-27 en adelante
 * php5_intl
 * php5_curl
 * php5_mcrypt
 * php5_mysql
 * php5_gd
 * mas las dependencias que estos paquetes pudieran necesitar
* JSON Activado
* Ctype Activado
* MySQL 5.5
yum install ImageMagick
yum install php-xml

* [Composer][1]

* Recomendado: instalar extensiones ACL en el file system.

Instalacion
-----------


Descomprima / Copie y pegue / haga checkout del proyecto (de acuerdo al soporte en que posea el codigo)
a `/var/www/mdu-rdp` o cualquier carpeta en la que tenga acceso de lectura y escritura.
En adelante `PROJECT_ROOT`.
Crear las carpetas `app/cache` y `app/logs`. La carpeta `cache` y `logs` deben ser modificables por el user del webserver.
Setear el parametro date.timezone = 'America/Buenos_Aires' en el /etc/php.ini
Setear el parametro  AllowOverride All para que tome los .htaccess

    <Directory "/var/www/html">

        #
        # Possible values for the Options directive are "None", "All",
        # or any combination of:
        #   Indexes Includes FollowSymLinks SymLinksifOwnerMatch ExecCGI MultiViews
        #
        # Note that "MultiViews" must be named *explicitly* --- "Options All"
        # doesn't give it to you.
        #
        # The Options directive is both complicated and important.  Please see
        # http://httpd.apache.org/docs/2.2/mod/core.html#options
        # for more information.
        #
            Options Indexes FollowSymLinks

        #
        # AllowOverride controls what directives may be placed in .htaccess files.
        # It can be "All", "None", or any combination of the keywords:
        #   Options FileInfo AuthConfig Limit
        #
            AllowOverride All

        #
        # Controls who can get stuff from this server.
        #
            Order allow,deny
            Allow from all

    </Directory>
Crear un virtual host para el proyecto (o configure los defaults de apache si es una instalacion dedicada) y reinicie apache:

    <VirtualHost *:80>
        DocumentRoot "PROJECT_ROOT/web"
        ServerName IP_DE_LA_MAQUINA
        DirectoryIndex app.php
        <Directory "PROJECT_ROOT/web/">
            AllowOverride All
            Allow from All
            #Require all granted
        </Directory>
        ErrorLog PROJECT_ROOT/app/logs/error.log
        CustomLog PROJECT_ROOT/app/logs/access.log combined
    </VirtualHost>

Instalar las dependencias del proyecto usando composer. En carpeta `PROJECT_ROOT` ejecute:

    rm composer.lock #Solo la primera vez que se levante la aplicación
    php composer.phar self-update #De vez en cuando para mantener el composer.phar siempre actualizado
    php composer.phar install


    
La instalacion de dependencias puede tomar varios minutos. Al finalizar limpiar las caches:

  php app/console cache:clear cache:clear
  php app/console cache:clear --env=prod --no-debug
  la primera vez borrar dos archivos de los vendors
  rm vendor/nusphere/nusoap/lib/class.soapclient.php
  rm vendor/nusphere/nusoap/lib/class.nusoap_base.php 
  php composer.phar self-update 
     
Si la instalacion de dependencias o la limpieza de cache mostrara errores de permisos, verifique la [configuracion de permisos][2].
Si por alguna razon no fuera posible instalar las extensiones ACL, aplique permisos 777 a la carpeta cache antes y despues de
ejecutar los comandos de limpieza o actualizacion de composer. Ej:

    sudo chmod -R 777 app/cache
    app/console cache:clear // composer.phar install
    sudo chmod -R 777 app/cache

Modifique los valores de `app/config/parameters.yml`.

* database_host
* database_port
* database_name
* database_user
* database_password
* secret - poner un string aleatorio distinto Por ejemplo: f229b2d5d168c263588ba7e9c3f6d59ea7d6bc57 (para CSRF protection)
* activar el catpcha 
  captcha_enabled: true
  
configurar los servicios de webservice 
ip_webservice: 10.9.3.15 

pedir a seguridad que de acceso a esos servidores y puertos
      
      
Cree la base de datos y genere las tablas correspondientes al modelo:
ejecutando 
solo la primera vez
´php composer.phar run-script post-update-cmd´
    crear las tablas de menu
    php app/console doctrine:schema:create
    php app/console doctrine:fixtures:load 
ingresar http://ip_servidor/app_dev.php
con el usuario admin clave troquelad0
si se crean nuevas tablas en la base de datos 
1) Hacer un backup del archivo src/GCBA/StoreBundle/Entity/SysUsuario.php
2) Ejecutar lo siguiente
    php app/console doctrine:mapping:import --force GCBAStoreBundle xml
    php app/console doctrine:mapping:convert annotation ./src --force
    php app/console doctrine:generate:entities GCBAStoreBundle
3) Copiar de nuevo el archivo SysUsuario.php a en src/GCBA/StoreBundle/Entity


   
Instale los assets del proyecto en la carpeta web ejecutando

  php  app/console assets:install
