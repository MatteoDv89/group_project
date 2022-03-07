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



    //DELETE STEVEN


    //GET_ONE HUGO

    public function get_one_location(array $array) {

        return $one_location = $this->bdd->query("SELECT * FROM advert WHERE id_advert = $array['id_advert']")->fetch(PDO::FETCH_ASSOC);
    }

    //GET_ALL HUGO

    public function get_all_locations() {

    return $all_locations = $this->bdd->query("SELECT * FROM advert")->fetchAll(PDO::FETCH_ASSOC);
    }


}
