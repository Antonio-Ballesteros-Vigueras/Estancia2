INTRUCCIONES PARA IMPORTAR LA BASE DE DATOS CORRESPONDIENTE
AL SISTEMA WEB:
En un servidor como xampp o laragon, en la consola de comandos hacer lo
siguiente:

create database naturalesartrom;

use naturalesartrom;

exit

mysql -u root -p naturalesartrom &lt; (Ruta de la base a importar)
