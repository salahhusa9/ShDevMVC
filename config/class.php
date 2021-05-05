<?php

include_once "../App/Controller/MainController.php";

spl_autoload_register(function ($_class_name) {                 /////
    $_dir= "..\\";                                               /////
    $_path = $_dir.$_class_name;                                /////
    include $_path. '.php';                                     /////
});       