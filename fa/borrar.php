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
            $error = [];
            comprobarParametro($id, $error);

            $pdo = conectar();
            $fila = buscarPelicula($pdo, $id, $error);
            comprobarErrores($error);
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
                mostrarErrores($e);
            }
        ?>
    </body>
</html>
