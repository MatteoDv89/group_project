<?php include_once "php/header.php"  ?>


<div class="wrapper">
    <section class="form signup">
        <header>Ajouter un bien</header>
        <form action='' enctype='multipart/form-data' method="post">



            <div class="field input">
                <label>Titre</label>
                <input type="text" name="title" required>
            </div>
            <div class="field input">
                <label>Description</label>

                <textarea name="description" placeholder=" Ajouter une description"cols="30" rows="10" required>
                </textarea>
            </div>
            <div class="field input">
                <label>Code Postal</label>
                <input type="text" name="postcode" required>
            </div>
            <div class="field input">
                <label>Ville du bien immo</label>
                <input type="text" name="city" required>
            </div>

            <div class="field input">
                <label>Prix</label>
                <input type="number" name="price" required>
            </div>


            <div class="field input">
                <label>Categorie de l'annonce</label>
                <select name="category_id" id="type">
                    <?php

                    $type_arr = array('location', 'vente');


                    foreach ($type_arr as $result) {
                    ?>
                        <option value="<?php if ($result == 'location') {
                                            echo 1;
                                        } else {
                                            echo 2;
                                        } ?>"><?php echo $result; ?></option>
                    <?php
                    }


                    ?>


                </select>




            </div>





            <div class="field button">
                <input type="submit" name="submit" value="Enregistrer">
            </div>



            <?php

            spl_autoload_register(function ($class) {
                include './classes/' . $class . '.class.php';
            });
            require_once('php/config.php');
            $manager_location = new Manager_location($conn);

            if (isset($_POST) && isset($_POST['submit'])) {

                $appartement =   new Location($_POST);
                $manager_location->add_location($_POST);
            }

            ?>

        </form>
        <div class="link">Retourner a l'accueil <a href="index.php"><i class="fas fa-arrow-right"></i></a></div>
    </section>
</div>




</body>

</html>