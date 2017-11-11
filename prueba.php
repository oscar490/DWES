<?php

function suma($a, $b)
{
        return $a + $b;
}

try {
    echo suma(2, 5, 7, 6, 7);
} catch (ArgumentCountError $e) {
    echo $e->getMessage() . PHP_EOL;
}
