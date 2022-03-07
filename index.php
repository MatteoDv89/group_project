
<?php
include_once "php/header.php";
include "php/config.php";
spl_autoload_register(function ($class) {
    include './classes/' . $class . '.class.php';
});


?>

<h2>Paru récemment:</h2>
<table>
    <thead>
        <tr>

            <td>Titre de l'annonce</td>
            <td>Code postal</td>
            <td>Ville</td>
            <td>Prix</td>
            <td>Réservation</td>
            <td>Catégorie</td>
            <td>Description</td>
            <td>Réservation</td>
            <!-- <td>Date</td> -->
            <!-- <td>Modifier</td>
            <td>Supprimer</td> -->

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
                    <?php echo strtoupper($result['title']); ?>
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
                    <?php echo $result['reservation_message']; ?>
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
                    <?php if ($result['reservation_message'] == "disponible") {
                        echo "Disponible";
                    } else {
                        $result['reservation_message'];
                    } ?>
                </td>
                <!-- <td>
                     <?php echo substr($result['created_at'], 0, 10); ?> 
                </td> -->

                <!-- 
                <td>
                    <form action="edit.php" method='post' class='edit'>
                        <input type="text" name="location_id" value=<?php echo $result['id_advert']; ?> hidden>
                        <button><i class="fas fa-edit"></i></button>
                    </form>
                </td>
                <td>
                    <a href="delete.php?id_location=<?php echo $result['id_advert']; ?>" class="link_delete"><i class="fas fa-trash"></i></a>
                </td> -->



            </tr>

        <?php

        }
        ?>











        <script src="javascript/delete.js"></script>

    </tbody>
</table>
<div class="button_more">
    <a class='view_all' href="all_location.php">Consulter toute les annonces</a>
</div>
