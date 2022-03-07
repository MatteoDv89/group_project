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
            <h1>GroupProject</h1>
        </a>
        <?php if (isset($_SESSION['user_id'])) {
        ?>
            <form action="./php/logout.php">
                <button>Log out</button>
            </form>
        <?php
        } ?>
        <form action="add_location.php">
            <button>Ajouter une annonce</button>
        </form>
    </div>