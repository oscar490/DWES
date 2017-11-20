<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Insertar una nueva película</title>
    </head>
    <body>
        <?php

        $titulo = trim(filter_input(INPUT_POST, 'titulo')) ?? '';
        $anyo = trim(filter_input(INPUT_POST, 'anyo')) ?? '';
        $sinopsis = trim(filter_input(INPUT_POST, 'sinopsis')) ?? '';
        $duracion = trim(filter_input(INPUT_POST, 'duracion')) ?? '';
        $genero_id = trim(filter_input(INPUT_POST, 'genero_id')) ?? '';
        ?>

        <?php if (!empty($_POST)): ?>
            try {
                $error = [];
                comprobarTitulo($titulo, $error);
                comprobaranyo($anyo, $error);
                comprobarDuracion($duracion, $error);
                comprobarGenero($genero, $error);
                comprobarErrores($errores);

            } catch (Exception $e) {
                mostrarErrores($e);
            }
        <?php endif ?>


        <form  action="insertar.php" method="post">
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
            <input type="submit" value="Insertar">
            <input type="submit" value="Cancelar" formmethod="get" formaction="index.php">
        </form>

    </body>
</html>
