<?php

session_start();
require('php/config.php');


spl_autoload_register(function ($class) {
    include './' . $class . '.class.php';
});

class Manager_location
{

    private $bdd;
    /**
     * Undocumented function
     *
     * @param PDO $bdd
     */
    public function __construct(PDO $bdd)
    {
        $this->bdd = $bdd;
    }

    //ADD

    public function add_location(array $array)
    {
        $msg_reservation = "disponible";



        $sql = $this->bdd->prepare("INSERT INTO advert (title,description,postcode,city,price,reservation_message,category_id)
                            VALUES (:title,:description,:postcode,:city,:price,:reservation_message,:category_id);");
        $sql->bindValue(':title', $array['title'], PDO::PARAM_STR);
        $sql->bindValue(':description', $array['description'], PDO::PARAM_STR);
        $sql->bindValue(':postcode', $array['postcode'], PDO::PARAM_STR);
        $sql->bindValue(':city', $array['city'], PDO::PARAM_STR);
        $sql->bindValue(':price', $array['price'], PDO::PARAM_STR);
        $sql->bindValue(':reservation_message', $msg_reservation, PDO::PARAM_STR);
        $sql->bindValue(':category_id', $array['category_id'], PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {

            echo "<div class='success-txt'>success</div>";
        } else {
            echo "<div class='error-txt'>something wrong</div>";
        }
    }


    //UPDATE MATTEO



    //DELETE STEVEN

    public function delete_location(array $array) {
        $sql = $this->bdd->prepare("DELETE FROM advert (logement_id = :logement_id");
        $sql->bindValue(':logement_id', $array['logement_id'], PDO::PARAM_INT);
        $sql->execute();
        if ($sql->rowCount() > 0) {

            echo "<div class='success-txt'>success</div>";
        } else {
            echo "<div class='error-txt'>something wrong</div>";
        }
    }


    //GET_ONE HUGO



    //GET_ALL HUGO


}
