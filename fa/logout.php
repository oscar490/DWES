<?php session_start();
$_SESSION = [];

$params = session_get_cookie_params();

setcookie(
    session_name(),    //  nombre.
    '',             //  valor.
    1,              //  tiempo de expiracion (1970-01-01 00:00:01).
    $params['path'],             //  Ruta (no lo sé).
    $params['domain'],              //  Dominio (no lo sé).
    $params['secure'],          //  secure (no lo sé).
    $params['httponly']

);

session_destroy();
header('Location: index.php');

?>
