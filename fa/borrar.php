<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Confirmación de Borrado</title>
        <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
        integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
        crossorigin="anonymous">
    </head>
    <body>
        <?php
        require 'auxiliar.php';

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?? false;
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
                    <input type="hidden" name="id" value="<?= h($id) ?>" />
                    <input type="submit" value="Si" />
                    <input type="submit" value="No" formaction="index.php" formmethod="get">
                </form>
                <?php
            } catch (Exception $e) {
                mostrarErrores($error);
                volver();
            }
        ?>
    </body>
</html>
