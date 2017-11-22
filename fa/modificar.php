<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Modificar una película</title>
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
            extract($fila);
            if (!empty($_POST)):
                $titulo = trim(filter_input(INPUT_POST, 'titulo'));
                $anyo = trim(filter_input(INPUT_POST, 'anyo'));
                $sinopsis = trim(filter_input(INPUT_POST, 'sinopsis'));
                $duracion = trim(filter_input(INPUT_POST, 'duracion'));
                $genero_id = trim(filter_input(INPUT_POST, 'genero_id'));
                try {
                    comprobarTitulo($titulo, $error);
                    comprobarAnyo($anyo, $error);
                    comprobarDuracion($duracion, $error);
                    comprobarGenero($pdo, $genero_id, $error);
                    comprobarErrores($error);
                    $valores = compact(
                        'titulo',
                        'anyo',
                        'sinopsis',
                        'duracion',
                        'genero_id'
                    );
                    

                    modificar($pdo, $id, $valores);
                    ?>
                    <h3>La película se ha modificado perfectamente.</h3>
                    <?php
                    volver();
                } catch (Exception $e) {
                    mostrarErrores($error);
                    volver();
                }
            endif;
            if (empty($_POST) || (!empty($_POST) && !empty($error))):

            ?>
            <form  action="modificar.php?id=<?= $id ?>" method="post">
                <!-- Titulo -->
                <label for="titulo">Titulo: *</label>
                <input type="text" name="titulo" id="titulo"
                value="<?= htmlspecialchars($titulo)?>"><br>

                <!-- Año -->
                <label for="anyo">Año: </label>
                <input type="text" name="anyo" id="anyo"
                value="<?= htmlspecialchars($anyo)?>"><br />

                <!-- Sinopsis -->
                <label for="sinopsis">Sinopsis: </label><br />
                <textarea name="sinopsis" rows="8" cols="70"
                id="sinopsis"><?= htmlspecialchars($sinopsis)?>
                </textarea><br />

                <!-- duracion -->
                <label for="duracion">Duración: </label>
                <input type="text" name="duracion" id="duracion"
                value="<?= htmlspecialchars($duracion)?>"><br />

                <!-- Género -->
                <label for="genero_id">Género: *</label>
                <input type="text" name="genero_id" id="genero_id"
                value="<?= htmlspecialchars($genero_id)?>"><br />

                <!-- Bóton de envío de datos -->
                <input type="submit" value="Modificar">
                <a href="index.php">Cancelar</a>
            </form>
            <?php

            endif;
        } catch (Exception $e){
            mostrarErrores($error);
            volver();
        }
        ?>


    </body>
</html>
