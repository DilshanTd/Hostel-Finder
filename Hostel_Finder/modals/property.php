<?php

class Property
{
    public $name;
    public $price;
    public $description;
    public $location;
    public $image;
    public $uid;


    public function __construct($name, $price, $description, $location, $image, $uid)
    {

        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->location = $location;
        $this->image = $image;
        $this->uid = $uid;
    }



}
?>