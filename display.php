<?php 
include "php/header.php";
if(isset($_GET['id'])){
    include "php/config.php";   

    $sql = $conn -> query("SELECT * FROM logement WHERE logement.id_logement = {$_GET['id']}");
    $result = $sql -> fetch(PDO::FETCH_ASSOC);

    ?>


    <div class="container">
        <h2><?php echo $result['titre']; ?></h2>
        <div class="imgBox">
            <img src='./images/logement_<?php echo $result['id_logement'] ?>.jpg' alt = 'photo' />

        </div>
        <div class="txtBox">
            <p><?php echo $result['description']; ?></p>
        </div>
        <div class="link">Retourner a l'accueil <a href="index.php"><i class="fas fa-arrow-right"></i></a></div>
    </div>



<?php



}else{
    header("Location: index.php");
    die();
}