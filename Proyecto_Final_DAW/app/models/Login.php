<?php
class Login {

private $user;
private $password;
private $userId;
private $rol;

function __set($name, $value)
{
 if ( property_exists($this,$name)){
     $this->$name = $value;
 }
}

function __get($name)
{
    if ( property_exists($this,$name)){
        return $this->$name;
    }
}


}



