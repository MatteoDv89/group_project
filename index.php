<?php include_once "php/header.php" ?>


<table>
    <thead>
        <tr>
            <td>Apercu</td>
            <td>Titre de l'annonce</td>
            <td>Adresse du bien</td>
            <td>Ville</td>
            <td>CP</td>
            <td>Surface</td>
            <td>Prix</td>
            <td>Type</td>
            <td>Description</td>
            <td>Modifier</td>
            <td>Supprimer</td>

        </tr>
    </thead>
    <tbody>

        <?php include "php/config.php";
        spl_autoload_register(function ($class) {
            include 'classes/' . $class . '.class.php';
        });

        $manager_location = new Manager_location($conn);

        // $sql = $conn-> query("SELECT * FROM logement ");
        // $results = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $result) {

        ?>
            <tr>

            <tr>
                <td>
                    <?php if ($result['photo'] !== "No available img.") {
                        echo "<a class='display_link' href=display.php?id=" . $result['id_logement'] . ">";
                        echo "<img class='img_accueil' src='./images/logement_" . $result['id_logement'] . ".jpg' alt='apercu bien-immo'/>";
                        echo "<i class='fa-solid fa-magnifying-glass-plus'></i>";
                        echo "</a>";
                    } else {
                        echo  $result['photo'];
                    }
                    ?>
                </td>
                <td>
                    <?php echo $result['titre']; ?>
                </td>
                <td>
                    <?php echo $result['adresse']; ?>
                </td>
                <td>
                    <?php echo $result['ville']; ?>
                </td>
                <td>
                    <?php echo $result['cp']; ?>
                </td>
                <td>
                    <?php echo $result['surface']; ?>
                </td>
                <td>
                    <?php echo $result['prix']; ?>
                </td>


                <td>
                    <?php echo $result['type']; ?>

                </td>

                <td>
                    <?php
                    $short_desc = substr($result['description'], 0, 20) . "...";
                    echo $short_desc;
                    ?>
                </td>

                <td>
                    <form action="edit.php" method='post' class='edit'>
                        <input type="text" name="location_id" value=<?php echo $result['id_logement']; ?> hidden>



                        <button><i class="fas fa-edit"></i></button>
                    </form>
                </td>

                <td>
                    <a href="delete.php?id_location=<?php echo $result['id_logement']; ?>" class="link_delete"><i class="fas fa-trash"></i></a>
                </td>



            </tr>

        <?php

        }
        ?>











        <script src="javascript/delete.js"></script>

    </tbody>
</table>