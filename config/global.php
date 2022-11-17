<?php
/*
En este archivo se definen las constantes que se utilizarán dentro del backend con su respectivo valor:
    - default_controller: Corresponde al controlador predeterminado que se llamará en caso que no se encuentre el proporcionado.
        Esta constante es importante debido a que el backend fue desarrollado mediante el patrón de diseño MVC (Modelo-Vista-Controlador)
    - default_action: Corresponde a la acción predeterminada que se mandará a ejecutar cuando se acceda a nuestro backend, en este caso 'read' devolverá todos los registros de la base de datos de la tabla 'Persona'.
*/
define("default_controller","personas");
define("default_action","read");

?>