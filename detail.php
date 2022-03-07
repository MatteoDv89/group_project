<?php
include_once "php/header.php";
include "php/config.php";
spl_autoload_register(function ($class) {
    include './classes/' . $class . '.class.php';
});


if (isset($_GET['id_location'])) {

    $manager_location = new Manager_location($conn);
    $result = $manager_location->get_location_by_id($_GET['id_location']);
} else {
    header('Location:index.php');
}





?>

<div class="container_detail">
    <div class="textBox">
        <h2><?php echo $result['title']; ?></h2>
        <p><?php echo $result['description']; ?></p>
        <span><?php echo "publié le: " . $result['created_at']; ?></span>

    </div>

    <?php if ((isset($_SESSION['user_id']) && $result['user_id'] == $_SESSION['user_id']) || (isset($_SESSION['admin']) && $_SESSION['admin'] === "nkksdogljslo822s2Jdll")) { ?>
        <div class="option_btn">
            <form action="edit.php" method='post' class='edit'>
                <input type="text" name="location_id" value=<?php echo $result['id_advert']; ?> hidden>
                <button>Modifier cette annonce<i class="fas fa-edit"></i></button>
            </form>
            <a href="delete.php?id_location=<?php echo $result['id_advert']; ?>" class="link_delete">Supprimer l'annonce<i class="fas fa-trash"></i></a>
        </div>
    <?php } ?>
    <div class="textarea">
        <form action="" method='post'>
            <textarea name="reservation_message" placeholder='Envoyez un message pour etre recontacter' cols="70" rows="5">

            <?php if ($result['reservation_message'] == "disponible") {
                echo "";
            } else {
                echo $result['reservation_message'];
            }  ?>
        </textarea>
            <input type="text" name="location_id" value=<?php echo $result['id_advert']; ?> hidden>
            <input type='submit' name='submit' value="Je reserver maintenant!" />
        </form>
    </div>


</div>

<?php
if (isset($_POST) && isset($_POST['submit']) && !empty($_POST['reservation_message'])) {


    $manager_location->reservation_location($_POST);
}
?>