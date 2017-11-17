
<?php


function conectar(): PDO
{
    return new PDO('pgsql:host=localhost;dbname=fa','fa','fa');
}
