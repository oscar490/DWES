<?php

spl_autoload_register();

class Y extends \uno\X
{
    public function __construct()
    {
        echo "Hola, estoy en Y.\n";
        parent::__construct();
    }
}

$y = new Y;
