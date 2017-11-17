<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Confirmación de Borrado</title>
    </head>
    <body>
        <?php
        require 'auxiliar.php';

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        try {
            if (!is_int($id)) {
                throw new Exception('Parámetro incorrecto');
            }


            $pdo = conectar();
            $query = $pdo->query("SELECT *
                                    FROM peliculas
                                   WHERE id = $id");
            $fila = $query->fetch();

            if (empty($fila)) {
                throw new Exception('La pelicula no existe');
            }

            ?>
                <h3>
                    ¿Seguro que desea borrar la película <?= $fila['titulo'] ?>?
                </h3>
                <form action="hacer_borrado.php" method="post">
                    <input type="hidden" name="id" value="<?= $id ?>" />
                    <input type="submit" value="Si" />
                    <input type="submit" value="No" formaction="index.php" formmethod="get">
                </form>
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
