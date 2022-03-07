<?php


class Category
{

    private $id;
    private $value;
    

    public function __construct(int $id,$value)
    {
       $this->setId($id);
       $this->setValue($id);
    }

    //SETTER

   

    public function setTitle($value)
    {
        $this->title = $value;
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

    public function get_info()
    {
        $result = array(
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
