<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    header('Location:index.php');
}
include_once "php/header.php";
include "php/config.php";
spl_autoload_register(function ($class) {
    include './classes/' . $class . '.class.php';
});

?>

<div class="wrapper">
    <section class="form signup">
        <header>Inscription</header>


        <form action='' method="post">

            <div class="field input">
                <label>Nickname</label>
                <input type="text" name="nickname" placeholder="Nickname" required>
            </div>

            <div class="field input">
                <label>Email Adress</label>
                <input type="text" name="mail" placeholder="Enter your mail" required>
            </div>
            <div class="field input">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
                <i class="fas fa-eye"></i>
            </div>

            <div class="field button">
                <input type="submit" name="submit" value="Continue">
            </div>


            <?php

            if (isset($_POST) && isset($_POST['submit'])) {

                $user_manager = new Manager_user($conn);
                $user = new User_info($_POST);
                if (
                    $user->getNickname() !== NULL && $user->getPassword() !== NULL &&
                    $user->getRole() !== NULL && $user->getMail() !== NULL
                ) {
                    $user_manager->add_user($user->get_user_info());
                }
            }  ?>

        </form>
        <div class="link">Already signed up? <a href="./signin.php">Login now</a></div>

    </section>
</div>