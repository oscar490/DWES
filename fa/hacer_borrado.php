<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Borrar Película</title>
    </head>
    <body>
        <?php

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ?? false;
        try {
            if ($id === false) {
                throw new Exception('Parámetro incorrecto.');
            }
            $pdo = new PDO('pgsql:host=localhost;dbname=fa','fa','fa');
            $query = $pdo->query("SELECT id
                                    FROM peliculas
                                   WHERE id = $id");
            $fila = $query->fetch();
            if (empty($fila)) {
                throw new Exception('La película no existe.');
            }
            $numFilas = $pdo->exec("DELETE FROM peliculas
                                          WHERE id = $id");

            if ($numFilas !== 1) {
                throw new Exception('Ha ocurrido un error al eliminar la pelicula.');
            }
            ?>
            <h3>Película eliminada correctamente.</h3>
            <a href="index.php">Volver</a>
            <?php

        } catch (Exception $e) {
            
        }

        ?>

    </body>
</html>
