# Curriculum
application to add your skills :) (basic)

Guia de instalacion del proyecto:
antes de la instalacion y la descarga del proyecto debe tener instalado en su maquina php 8.1, mysql 8, composer y nodejs. Tambien es necesario crear una base de datos llamada con el nombre de su preferencia.

1 descargar el proyecto con en la carpeta de su preferencia en su maquina local con el comando "git clone https://github.com/Dorku14/Curriculum.git" y moverse a la carpeta que creó el comando donde se encuentran los archivos del proyecto

2  una vez descargado el proyecto ir al archivo .env para modificar unos parametros:
        DB_CONNECTION=mysql
        DB_HOST={ip de su base de datos}
        DB_PORT={puerto de su servidor mysql}
        DB_DATABASE={nombre de la base de datos que creó}
        DB_USERNAME={usuario de la base de datos usualmente es 'root'}
        DB_PASSWORD={password  de la base de datos}
        
3  abrir el proyecto usar la linea de comandos puede cmd o powershell asegurese de que la ruta sea en donde se descargó el proyecto

4 usar los siguientes comandos en el orden que se escriben y debe esperar a que termine de ejecutarse cada uno para continuar con el siguiente: 

  -"npm install" 
  
  -"composer install"
  
  -"php artisan key:generate"
  
  -"php artisan migrate"
  
  -"php artisan db:seed"
  
  
5 una ves ajecutado los comando ejecutar los siguientes comando en dos terminales, en el primero "npm run dev" y en el segundo "php artisan serv"

6 ir a la url que muestra la termina donde colocó el comando  "php artisan serv"
