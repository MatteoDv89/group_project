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

    public function update_location(array $array)
    {

        $sql_update = $this->bdd->prepare("UPDATE `advert` SET `title`= :title,`description`= :description,`postcode`= :postcode,`city`= :city,`price`= :price,`category_id`= :category_id WHERE advert.id_advert = :location_id");
        $sql_update->bindValue(':title', $array['title'], PDO::PARAM_STR);
        $sql_update->bindValue(':description', $array['description'], PDO::PARAM_STR);
        $sql_update->bindValue(':postcode', $array['postcode'], PDO::PARAM_STR);
        $sql_update->bindValue(':city', $array['city'], PDO::PARAM_STR);
        $sql_update->bindValue(':price', $array['price'], PDO::PARAM_STR);
        $sql_update->bindValue(':category_id', $array['category_id'], PDO::PARAM_INT);
        $sql_update->bindValue(':location_id', $array['location_id'], PDO::PARAM_INT);
        $sql_update->execute();

        if ($sql_update->rowCount() > 0) {

            echo "<div class='success-txt'>success</div>";
            header("Location: index.php");
        } else {
            echo "<div class='error-txt'>something wrong</div>";
        }
    }





    //DELETE STEVEN

    public function delete_by_id($id)
    {

        $sql = $this->bdd->query("DELETE FROM advert WHERE advert.id_advert = {$id}");
        header('location:index.php');
    }


    //GET_ONE HUGO
    public function get_location_by_id($id)
    {
        $sql = $this->bdd->query("SELECT advert.*,category.id_category AS category_id, category.value AS category_name FROM advert
                                    INNER JOIN category ON category.id_category = advert.category_id
                                    WHERE advert.id_advert = {$id}
                                   ");
        $result = $sql->fetch();              
        
        $ad = new Location($result);
        return $ad;
    }



    //GET_ALL HUGO
    public function get_all_location()
    {
        $sql = $this->bdd->query("SELECT advert.* , DATE_FORMAT(created_at, '%d/%m/%Y') AS created_at, category.value AS category_name FROM advert
                                INNER JOIN category ON category.id_category = advert.category_id ORDER BY created_at DESC");
        $result = $sql->fetchAll();

      
       
        return $result;
    }
}
