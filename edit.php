<?php

include_once "php/header.php";
include "php/config.php";

spl_autoload_register(function ($class) {
    include './classes/' . $class . '.class.php';
});


if ( isset($_POST['location_id']) ) {
    $manager = new Manager_location($conn);

    $advert_info = $manager->get_one_location($_POST['location_id']);
} else {
    header('Location:index.php');
    exit;
}


if (isset($_POST) && isset($_POST['valider'])) {
    $manager2 = new Manager_location($conn);

    $manager2->update_location($_POST); 
    
};

?>


<div class="wrapper">
    <section class="form signup">
        <header>Modifier l'annonce</header>
        <form action='#' enctype='multipart/form-data' method="post">

             <div class="field input">
                    <label>Titre</label>
                    <input type="text" name="title" value="<?= $advert_info['title']?>" required>
                    <input type="text" hidden>
                </div>
                 <div class="field input">
                    <label>Description</label>
                    <input type="text" name="description" value="<?= $advert_info['description']?>" required>                
                </div>
                 <div class="field input">
                    <label>Code Postal</label>
                    <input type="text" name="postcode" value="<?= $advert_info['postcode']?>" required>     
                </div>
                 <div class="field input">
                    <label>Ville</label>
                    <input type="text" name="city" value="<?= $advert_info['city']?>" required>
                </div>
                <div class="field input">
                    <label>Prix</label>
                    <input type="number" name="price" value="<?= $advert_info['price']?>" required>
                </div>
                <div class="field input">
                    <label>Catégorie</label>
                    <select name="category_id"  id="type">
                    <?php include "php/config.php";
                    
                    $type_arr = array('location','vente');

                     
                       foreach($type_arr as $row){
                        ?>
                        <?php 
                            if($row == $advert_info['category_name']){
                                    echo "<option value='".$advert_info['category_id']."' selected>".$advert_info['category_name']."</option>";

                            }else{

                                echo "<option value='".$row."'>".$row."</option>";
                            }
                        }
                         ?>

                 </select>

                 
                 <input type="number" value=<?= $advert_info['id_advert']?> name="location_id" >
                    
                </div>
               
               
                   
                 <div class="field button">                   
                    <input type="submit" name="valider" value="Enregistrer">
                </div>
           
        </form>
        <div class="link">Retourner a l'accueil <a href="index.php"><i class="fas fa-arrow-right"></i></a></div>
        
    </section>
</div>



    
</body>
</html>