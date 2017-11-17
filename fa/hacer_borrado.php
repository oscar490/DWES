<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Borrar Película</title>
    </head>
    <body>
        <?php
        require 'auxiliar.php';

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ?? false;
        try {
            if ($id === false) {
                throw new Exception('Parámetro incorrecto.');
            }
            $pdo = conectar();
            
            $query = $pdo->prepare("SELECT COUNT(*)
                                    FROM peliculas
                                   WHERE id = :id");
            $query->execute([':id'=>$id]);
            $fila = $query->fetch();
            if ($query->fetchColumn() === 0) {
                throw new Exception('La película no existe.');
            }
            $query = $pdo->prepare("DELETE FROM peliculas
                                          WHERE id = :id");
            $query->execute([':id' => $id]);

            if ($query->rowCount() !== 1) {
                throw new Exception('Ha ocurrido un error al eliminar la pelicula.');
            }
            ?>
            <h3>Película eliminada correctamente.</h3>
            <a href="index.php">Volver</a>
            <?php

        } catch (Exception $e) {
            ?>
            <h3>Error: <?= $e->getMessage() ?></h3>
            <a href="index.php">Volvel</a>
            <?php
        }

        ?>

    </body>
</html>
