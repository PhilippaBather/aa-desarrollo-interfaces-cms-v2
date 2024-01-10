<?php

// "call back functions" para cargar las clases requeridas automaticamente
spl_autoload_register(function($class) {
    if(file_exists($class.'.php')) {
        require $class.'.php';
    }
});

// inicializa la sesión
session_start();