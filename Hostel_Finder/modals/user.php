<?php

class User
{
    public $id;
    public $username;
    public $email;
    public $type;


    public function __construct($id, $username, $email, $type)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->type = $type;
    }



}
?>