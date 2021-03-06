<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Modificar una película</title>
        <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
        integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
        crossorigin="anonymous">
    </head>
    <body>
        <?php

        require 'auxiliar.php';

        if (!comprobarLogueado()) {
            return;
        }
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
                    $_SESSION['mensaje'] = 'La Película se ha modificado correctamente.';
                    header('Location: index.php');
                    return;
                } catch (Exception $e) {
                    mostrarErrores($error);

                }
            endif;


                formulario(compact(
                    'titulo',
                    'anyo',
                    'sinopsis',
                    'duracion',
                    'genero_id'
                ), $id);


        } catch (Exception $e){
            mostrarErrores($error);
            volver();
        }
        ?>


    </body>
</html>
