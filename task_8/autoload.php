<?php
// автозагрузка
spl_autoload_register(function ($class_name) 
{
    $class_file = strtolower($class_name).'.php';
    $class_path = '';

    if (strpos($class_name, 'Model_') !== false) {
      $class_path = "application/models/";
    } elseif (strpos($class_name, 'Controller_') !== false) {
      $class_path = "application/controllers/";
    }

    $full_class_path = $class_path.$class_file;

    if (file_exists($full_class_path)) {
      require_once $full_class_path;
    } 
});