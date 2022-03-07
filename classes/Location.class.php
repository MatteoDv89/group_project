<?php


class Location
{

    private $uid;
    private $title;
    private $description;
    private $postcode;
    private $city;
    private $price;
    private $reservation_message;
    private $category_id;
    private $category_name;
    private $created_at;

    public function __construct(array $data)
    {

        foreach ($data as $key => $value) {

            $methode = 'set' . ucfirst($key);

            if (method_exists($this, $methode)) {
                $this->$methode($value);
            }
        }
    }

    //SETTER

    public static function get_root()
    {
        return $_SERVER;
    }

    public function setTitle($value)
    {
        $this->title = $value;
    }
    public function setDescription($value)
    {
        $this->description = $value;
    }
    public function setPostcode($value)
    {
        $this->postcode = $value;
    }
    public function setCity($value)
    {
        $this->city = $value;
    }
    public function setPrice($value)
    {
        $this->price = $value;
    }
    public function setReservation_message($value)
    {
        $this->reservation_message = $value;
    }
    public function setCategory_id($value)
    {
        $this->category_id = $value;
    }
    public function setCategory_name($value)
    {
        $this->category_name = $value;
    }
    public function setCreated_at($value)
    {
        $this->created_at = $value;
    }
    public function setUid($value)
    {
        $this->uid = $value;
    }



    //GETTER

    public function getTitle()
    {
        return  $this->title;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getPostcode()
    {
        return  $this->postcode;
    }
    public function getCity()
    {
        return  $this->city;
    }
    public function getPrice()
    {
        return  $this->price;
    }
    public function getReservation_message()
    {
        return  $this->reservation_message;
    }
    public function getCategory_id()
    {
        return $this->category_id;
    }
    public function getCategory_name()
    {
        return $this->category_name;
    }
    public function getCreated_at()
    {
        return $this->created_at;
    }


    public function get_info()
    {
        $result = array(
            'uid' => $this->uid,
            'title' => $this->title,
            'postcode' => $this->postcode,
            'city' => $this->city,
            'price' => $this->price,
            'description' => $this->description,
            'reservation_message' => $this->reservation_message,
            'category_id' => $this->category_id
        );
        return $result;
    }
}
