<?php


class Location
{

    private $title;
    private $description;
    private $postcode;
    private $city;
    private $price;
    private $reservation_message;
    private $category_id;
    private $created_at;

    public function __construct(array $data)
    {

        foreach ($data as $key => $value) {

            $methode = 'set' . ucfirst($value);

            if (method_exists($this, $methode)) {
                $this->$methode($value);
            }
        }
    }

    //SETTER

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
    public function setCreated_at($value)
    {
        $this->created_at = $value;
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
    public function getcCity()
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
}
