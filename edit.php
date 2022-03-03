<?php include_once "php/header.php"  ?>


<div class="wrapper">
    <section class="form signup">
        <header>Modifier guitare</header>
        <form action='' enctype='multipart/form-data' method="post">

             <?php include "php/update_error.php"; ?> 
             <?php include "php/config.php";
             if(isset($_POST['location_id'])){
                 $sql = $conn -> query("SELECT * FROM logement WHERE logement.id_logement = {$_POST['location_id']} ");
                 $result = $sql->fetch(PDO::FETCH_ASSOC);
             };
             ?>

                 
            
             <div class="field input">
                    <label>Titre</label>
                    <input type="text" <?php if(isset($_POST['location_id'])){ echo "value='".$result['titre']."'";} ?> name="titre"  required>
                    <input type="text" <?php if(isset($_POST['location_id'])){ echo "value='".$result['id_logement']."'";} ?> name="uid"  hidden>
                </div>
                 <div class="field input">
                    <label>Adresse</label>
                    <input type="text" <?php if(isset($_POST['location_id'])){ echo "value='".$result['adresse']."'";} ?> name="adresse" required>                
                </div>
                 <div class="field input">
                    <label>Ville</label>
                    <input type="text" <?php if(isset($_POST['location_id'])){ echo "value='".$result['ville']."'";} ?> name="ville" required>     
                </div>
                 <div class="field input">
                    <label>Code Postal</label>
                    <input type="number" <?php if(isset($_POST['location_id'])){ echo "value='".$result['cp']."'";} ?> name="cp" required>
                </div>
                <div class="field input">
                    <label>Surface</label>
                    <input type="number" <?php if(isset($_POST['location_id'])){ echo "value='".$result['surface']."'";} ?> name="surface" required>
                </div>               
                <div class="field input">
                    <label>Prix</label>
                    <input type="number" <?php if(isset($_POST['location_id'])){ echo "value='".$result['prix']."'";} ?> name="prix" required>
                </div>
                 <div class="field input">
                    <label>Photo</label>
                    <?php if(isset($_POST['location_id'])){ echo "<img class='edit_img' src='images/logement_".$result['id_logement'].".jpg' alt='photo' />";} ?>
                    <input type="file" name="photo">
                </div>
                  <div class="field input">
                    <label>Type</label>
                    <select name="type"  id="type">
                    <?php include "php/config.php";
                    
                    $type_arr = array('location','vente');

                     
                       foreach($type_arr as $row){
                        ?>
                        <?php if(isset($_POST['location_id'])){
                            if($row == $result['type']){
                                    echo "<option value='".$result['type']."' selected>".$result['type']."</option>";

                            }else{

                                echo "<option value='".$row."'>".$row."</option>";
                            }

                        }else{
                          echo "<option value='".$row."'>".$row."</option>";
                        } ?>
                        <?php
                    }

                                     
                    ?>
                 </select>

                 
                 
                    
                </div>

              
                <div class="field input">
                    <label>Description</label>                    
                    <textarea name="description" id="description" cols="30" rows="10"> <?php if(isset($_POST['location_id'])){ echo $result['description'];} ?></textarea>
                </div>   

                   
               
                   
                 <div class="field button">                   
                    <input type="submit" value="Enregistrer">
                </div>
           
        </form>
        <div class="link">Retourner a l'accueil <a href="index.php"><i class="fas fa-arrow-right"></i></a></div>
        
    </section>
</div>



    
</body>
</html>