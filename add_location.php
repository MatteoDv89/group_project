<?php include_once "php/header.php"  ?>


<div class="wrapper">
    <section class="form signup">
        <header>Ajouter un bien</header>
        <form action='' enctype='multipart/form-data' method="post">

             <?php include "php/record_error.php"; ?> 
                 
            
             <div class="field input">
                    <label>Titre</label>
                    <input type="text" name="titre"  required>
                </div>
                 <div class="field input">
                    <label>Adresse</label>
                    <input type="text" name="adresse" required>                
                </div>
                 <div class="field input">
                    <label>Ville</label>
                    <input type="text" name="ville" required>     
                </div>
                 <div class="field input">
                    <label>Code Postal</label>
                    <input type="number" name="cp" required>
                </div>
                <div class="field input">
                    <label>Surface</label>
                    <input type="number" name="surface" required>
                </div>               
                <div class="field input">
                    <label>Prix</label>
                    <input type="number" name="prix" required>
                </div>
                 <div class="field input">
                    <label>Photo</label>
                    <input type="file" name="photo">
                </div>
                  <div class="field input">
                    <label>Type</label>
                    <select name="type" id="type">
                    <?php include "php/config.php";
                    
                    $type_arr = array('location','vente');

                     
                       foreach($type_arr as $result){
                        ?>
                        <option value="<?php echo $result; ?>"><?php echo $result;?></option>
                        <?php
                    }

                                     
                    ?>
                 </select>

                 
                 
                    
                </div>

              
                <div class="field input">
                    <label>Description</label>                    
                    <textarea name="description" id="description" cols="30" rows="10"></textarea>
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