<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Videoclub</title>
    </head>
    <body>
        <?php
        $titulo = $_POST['titulo'];
        $anyo = $_POST['anyo'];
        $argumento = $_POST['argumento'];

        $pdo = new PDO('pgsql:host=localhost;dbname=pelis', 'pelis', 'pelis');

        $esqueleto = $pdo->prepare("INSERT INTO")

        $consulta = $pdo->query("SELECT *
                                 FROM peliculas");

        var_dump($consulta->fetchAll());



        ?>
    </body>
</html>
