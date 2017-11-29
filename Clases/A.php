<?php

namespace mio;


class A
{
    public function __construct()
    {
        echo 'Hola. soy A';
    }
}

$a = new A;         //  ruta relativa.
$b = new \mio\A;    //  ruta absoluta.
