<?php

/* -------------------------------------------------------------------------- */
/*                 include Php file need included in all file                 */
/* -------------------------------------------------------------------------- */
    session_start();
    include_once __DIR__.'\helpers\function.php';
    $configApp = include_once __DIR__.'\..\config\app.php';
    include_once __DIR__.'\DataBase\conection.php';

?>