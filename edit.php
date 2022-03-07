<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location:login.php');
}
include_once "php/header.php";
require_once('php/config.php');
spl_autoload_register(function ($class) {
    include './classes/' . $class . '.class.php';
}); ?>


<div class="wrapper">
    <section class="form signup">
        <header>Modifier annonce</header>
        <form action='' enctype='multipart/form-data' method="post">


            <?php



            $manager_location = new Manager_location($conn);




            if (isset($_POST['location_id'])) {

                $result = $manager_location->get_location_by_id($_POST['location_id']);
            };

            ?>



            <div class="field input">
                <label>Title</label>
                <input type="text" <?php if (isset($_POST['location_id'])) {
                                        echo "value='" . $result['title'] . "'";
                                    } ?> name="title" required>
                <input type="text" <?php if (isset($_POST['location_id'])) {
                                        echo "value='" . $_POST['location_id'] . "'";
                                    } ?> name="location_id" hidden>
            </div>
            <div class="field input">
                <label>City</label>
                <input type="text" <?php if (isset($_POST['location_id'])) {
                                        echo "value='" . $result['city'] . "'";
                                    } ?> name="city" required>
            </div>
            <div class="field input">
                <label>Postcode</label>
                <input type="text" <?php if (isset($_POST['location_id'])) {
                                        echo "value='" . $result['postcode'] . "'";
                                    } ?> name="postcode" required>
            </div>

            <div class="field input">
                <label>Prix</label>
                <input type="number" <?php if (isset($_POST['location_id'])) {
                                            echo "value='" . $result['price'] . "'";
                                        } ?> name="price" required>
            </div>

            <div class="field input">
                <label>Categorie</label>
                <select name="category_id" id="type">
                    <?php

                    $type_arr = array('location', 'vente');


                    foreach ($type_arr as $row) {
                    ?>
                        <?php if (isset($_POST['location_id'])) {
                            if ($row == $result['category_name']) {
                                echo "<option value='" . $result['category_id'] . "' selected>" . $result['category_name'] . "</option>";
                            } else {
                                $cat_value;
                                if ($row == 'location') {
                                    $cat_value = 1;
                                } else {
                                    $cat_value = 2;
                                };
                                echo "<option value='" . $cat_value . "'>" . $row . "</option>";
                            }
                        } else {
                            echo "<option value='" . $row . "'>" . $row . "</option>";
                        } ?>
                    <?php
                    }


                    ?>
                </select>




            </div>


            <div class="field input">
                <label>Description</label>
                <textarea name="description" id="description" cols="30" rows="10"> <?php if (isset($_POST['location_id'])) {
                                                                                        echo $result['description'];
                                                                                    } ?></textarea>
            </div>




            <div class="field button">
                <input type="submit" name="submit" value="Enregistrer">
            </div>
            <?php
            if (isset($_POST) && isset($_POST['submit'])) {


                $manager_location->update_location($_POST);
            }
            ?>

        </form>
        <div class="link">Retourner a l'accueil <a href="index.php"><i class="fas fa-arrow-right"></i></a></div>

    </section>
</div>




</body>

</html>