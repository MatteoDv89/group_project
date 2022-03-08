<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <title>Magasin guitare</title>
</head>

<body>

    <div class="navbar">
        <a href="index.php">
            <h1>Group<span>Project</span></h1>
        </a>
        <div class="btn_nav">
            <?php if (isset($_SESSION['user_id'])) {
            ?>
                <a href="./php/logout.php">Log out</a>
            <?php
            } ?>
            <a href="add_location.php">
                Ajouter une annonce
            </a>
        </div>
    </div>