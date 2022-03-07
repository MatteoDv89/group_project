<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location:login.php');
}
include_once "php/header.php";
include "php/config.php";
spl_autoload_register(function ($class) {
    include './classes/' . $class . '.class.php';
});


?>


<table>
    <thead>
        <tr>

            <td>Titre de l'annonce</td>
            <td>Post code</td>
            <td>City</td>
            <td>Price</td>

            <td>Category</td>
            <td>Description</td>
            <td>Reservation</td>
            <!-- <td>Date</td> -->


        </tr>
    </thead>
    <tbody>

        <?php

        $manager_location = new Manager_location($conn);
        $results = $manager_location->get_all_location();




        foreach ($results as $result) {

        ?>
            <tr>

            <tr>

                <td>
                    <?php
            if ((isset($_SESSION['user_id']) && $result['user_id'] == $_SESSION['user_id']) || (isset($_SESSION['admin']) && $_SESSION['admin'] === "nkksdogljslo822s2Jdll")) {
                        echo "<a href='detail.php?id_location=" . $result['id_advert'] . "'  id='detail_link_user' >" . strtoupper($result['title']) . "</a>";
                    } else {

                        echo strtoupper($result['title']);
                    }
                    ?>
                </td>

                <td>
                    <?php echo $result['postcode']; ?>
                </td>
                <td>
                    <?php echo $result['city']; ?>
                </td>
                <td>
                    <?php echo substr($result['price'], 0, strlen($result['price'] - 2)); ?>
                </td>



                <td>
                    <?php echo $result['category_name']; ?>

                </td>

                <td>
                    <?php
                    $short_desc = substr($result['description'], 0, 20) . "...";
                    echo $short_desc;
                    ?>
                </td>
                <td>
                    <?php

                    if ($_SESSION['user_id'] && $result['user_id'] == $_SESSION['user_id']) {
                        if ($result['reservation_message'] == "disponible") {
                            echo "<a href='detail.php?id_location=" . $result['id_advert'] . "'  id='detail_link_user' >A Réserver</a>";
                        } else {
                            echo "Réservé";
                        }
                    } else {


                        if ($result['reservation_message'] == "disponible") {
                            echo "<a href='detail.php?id_location=" . $result['id_advert'] . "'  id='detail_link' >Réserver</a>";
                        } else {
                            echo "Réservé";
                        }
                    }
                    ?>
                </td>






            </tr>

        <?php

        }
        ?>













    </tbody>
</table>
<div class="button_more">
    <a class='view_all' href="index.php">Retour à l'accueil</a>
</div>
<script src="javascript/delete.js"></script>