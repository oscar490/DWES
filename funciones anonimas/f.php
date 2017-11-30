<?php


function f(callable $c, $p)
{
    echo call_user_func($c, $p);
}

$f = function ($x){ echo "Hoola $x";};

f($f, 'Manolo');



$o = new DateTime;

f([$o, 'format'], 'd-m-y');

f('strlen', 'hola');

class C
{
    public static function m($r)
    {
        return "Es un método estático y recibe $r";
    }
}

echo f(['C', 'm'], 123);
