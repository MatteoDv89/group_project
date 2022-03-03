<?php include_once "php/header.php"  ?>

   <?php 
                include "php/config.php";
                if(isset($_GET['id_location'])){
                   $sql0 = $conn -> query("SELECT id_logement FROM logement WHERE logement.id_logement = {$_GET['id_location']}");
                  $result = $sql0->fetch(PDO::FETCH_ASSOC);
                   unlink("./images/logement_".$result['id_logement'].".jpg");
                $sql = $conn -> query ("DELETE FROM logement WHERE logement.id_logement = {$_GET['id_location']}");
                header('location:index.php');
            
                } 
            