<?php
/*
En este archivo se definen las constantes que se utilizarán dentro del backend con su respectivo valor:
    - db_driver: Corresponde al nombre del driver o controlador que utilizaremos en el objeto PDO (en nuestro caso, MySQL)
    - db_host: Corresponde al host del servidor de la base de datos (en nuestro caso, MySQL)
    - db_user: Corresponde al nombre de usuario del servidor de la base de datos
    - db_name: Corresponde al nombre de la base de datos a la cual nos conectaremos (en mi caso, la nombré 'evaluacion')
    - db_pass: Corresponde a la contraseña del nombre de usuario del servidor de la base de datos
    - db_charset: Corresponde al tipo de codificación de carácteres que utilizaremos
*/
define("db_driver","mysql");
define("db_host","localhost");
define("db_user","root");
define("db_pass","");
define("db_name","evaluacion");
define("db_charset","utf8")

?>