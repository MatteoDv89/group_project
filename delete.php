<?php
include_once "php/header.php";
include "php/config.php";
spl_autoload_register(function ($class) {
   include './classes/' . $class . '.class.php';
});



if (isset($_GET['id_location'])) {

   $delete = new Manager_location($conn);
   $delete->delete_by_id($_GET['id_location']);
}
