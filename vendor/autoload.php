<?php
    spl_autoload_register(function ($class_name) {
        $classFile = $_SERVER['DOCUMENT_ROOT'] . '\\' . $class_name . '.php';
        if (file_exists($classFile)) {
            include $classFile;
        } else {
            throw new Exception("Класс <b>$class_name</b> не найден");
        }
    });
?>