
<?php
include_once "php/header.php";
include "php/config.php";
spl_autoload_register(function ($class) {
    include './classes/' . $class . '.class.php';
});

?>

<h2>Détails de l'annonce</h2>

<table>
    <thead>
        <tr>
            <td>Titre de l'annonce</td>
            <td>Code postal</td>
            <td>Ville</td>
            <td>Prix</td>
            <td>Catégorie</td>
            <td>Description</td>
            <td>Réservation</td>
            <td>Annonce déposée le</td>
            <td style="width: 5%">Modifier</td>
            <td style="width: 5%">Supprimer</td>
        </tr>
    </thead>
    <tbody>

        <?php

        $manager_location = new Manager_location($conn);
        $result = $manager_location->get_one_location($_GET['id']);

        if (isset($_POST) && isset($POST['reserve'])) {
            
            $manager_location->reservation_location($_POST); 

        };

        ?>

            <tr>
                <td> <?= strtoupper($result['title']) ?> </td>

                <td> <?=  $result['postcode'] ?> </td>

                <td> <?= mb_strtoupper($result['city']) ?> </td>

                <td> <?= substr($result['price'], 0, strlen($result['price'] - 2)) . " €" ?> </td>

                <td> <?= ucfirst($result['category_name']) ?> </td>

                <td> <?= substr($result['description'], 0, 20) . "..." ?> </td>

                <td>
                    <?php if ($result['reservation_message'] == "disponible") {
                        echo "Disponible";
                    } else {
                        echo "Réservé";
                    } ?>
                </td>

                <td> <?= substr($result['created_at'], 0, 10) ?> </td>

                 
                <td>
                    <form action="edit.php" method='post' class='edit'>
                        <input type="text" name="location_id" value=<?php echo $result['id_advert'] ?> hidden>
                        <button><i class="fas fa-edit"></i></button>
                    </form>
                </td>
                <td>
                    <a href="delete.php" class="link_delete"><i class="fas fa-trash"></i></a>
                </td>
            </tr>

    </tbody>
</table> 

<h4>Cette annonce vous intéresse ? Réservez-là !</h4>

            <!-- Formulaire de réservation de l'annonce -->

            <label for="reservation" id="msg">Votre message</label>
            <form action="#" method="POST">
                <textarea name="reservation_message" cols="80" rows="8" placeholder="Tapez votre message..."></textarea>
            
                <div class="field button">
                <input type="submit" class="btn-1" name="reserve" value="Je réserve">
                </div>
            </form>


<?php

    if ( isset($_POST['reservation_message']) && !empty($_POST['reservation_message']) ) {
        
        echo "Votre réservation est confirmée !";

    } else {
        
        echo $result['reservation_message'] = "Un message est obligatoire pour confirmer la réservation";
        
    }
