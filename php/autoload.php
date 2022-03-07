<?php

spl_autoload_register(function ($className) {
    // require_once $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $className . '.php';
    var_dump($_SERVER);
});
