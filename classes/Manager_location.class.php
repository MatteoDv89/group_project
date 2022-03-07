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

    public function add_location(array $array) {
        
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
    public function update_location(array $array)
    {

        $sql_modif = $this->bdd->prepare("UPDATE `advert` SET `title`= :title,`description`= :description,`postcode`= :postcode,`city`= :city,`price`= :price,`category_id`= :category_id WHERE advert.id_advert = :location_id");
        $sql_modif->bindValue(':title', $array['title'], PDO::PARAM_STR);
        $sql_modif->bindValue(':description', $array['description'], PDO::PARAM_STR);
        $sql_modif->bindValue(':postcode', $array['postcode'], PDO::PARAM_STR);
        $sql_modif->bindValue(':city', $array['city'], PDO::PARAM_STR);
        $sql_modif->bindValue(':price', $array['price'], PDO::PARAM_STR);
        $sql_modif->bindValue(':category_id', $array['category_id'], PDO::PARAM_INT);
        $sql_modif->bindValue(':location_id', $array['location_id'], PDO::PARAM_INT);
        $sql_modif->execute();

        if ($sql_modif->rowCount() > 0) {

            echo "<div class='success-txt'>success</div>";
            header("Location: index.php");
        } else {
            echo "<div class='error-txt'>something wrong</div>";
        }
    }


    //DELETE STEVEN


    //GET_ONE HUGO

    public function get_one_location(int $id) {

        $one_location = $this->bdd->query("SELECT advert.*, category.value AS category_name FROM advert 
                                        INNER JOIN category ON category.id_category = advert.category_id
                                        WHERE id_advert = $id")->fetch(PDO::FETCH_ASSOC);
        return $one_location;
    }

    //GET_ALL HUGO

    public function get_all_location() {

        return $all_location = $this->bdd->query("SELECT advert.*, category.value AS category_name FROM advert
                                                  INNER JOIN category ON category.id_category = advert.category_id")->fetchAll(PDO::FETCH_ASSOC);
    }

    //Réservation
    public function reservation_location(array $array)
    {

        $sql_update = $this->bdd->prepare("UPDATE `advert` SET `reservation_message`= :reservation_message WHERE advert.id_advert = :location_id");

        $sql_update->bindValue(':reservation_message', $array['reservation_message'], PDO::PARAM_STR);
        $sql_update->bindValue(':location_id', $array['location_id'], PDO::PARAM_INT);
        $sql_update->execute();

        if ($sql_update->rowCount() > 0) {

            echo "<div class='success-txt'>success</div>";
            header("Location: index.php");
        } else {
            echo "<div class='error-txt'>something wrong</div>";
        }
    }



}
