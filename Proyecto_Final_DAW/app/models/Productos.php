<?php
class Productos {
    private $id;
    private $title;
    private $price;
    private $image;
    private $category;
    private $stock;

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        return null;
    }
}



?>