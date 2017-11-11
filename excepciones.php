
<?php

try {
    intdiv(3, 0);
    throw new TypeError("Error horroroso.");
    echo 'Se ha saltado la excepción';
} catch (ErrorException $e) {
    echo 'Se ha provocado el siguiente error: ' . $e ->getMessage() . PHP_EOL;
} catch (ArithmeticError | TypeError $e) {
    echo 'Se ha provocado un error aritmético: ' .  $e -> getMessage() . PHP_EOL;
}
