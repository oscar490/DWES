<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Insertar una nueva película</title>
        <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
        integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
        crossorigin="anonymous">
    </head>
    <body>
        <?php

        require 'auxiliar.php';

        $titulo = trim(filter_input(INPUT_POST, 'titulo'));
        $anyo = trim(filter_input(INPUT_POST, 'anyo'));
        $sinopsis = trim(filter_input(INPUT_POST, 'sinopsis'));
        $duracion = trim(filter_input(INPUT_POST, 'duracion'));
        $genero_id = trim(filter_input(INPUT_POST, 'genero_id'));
        $error = [];
        ?>

        <?php if (!empty($_POST)):
            try {

                comprobarTitulo($titulo, $error);
                comprobarAnyo($anyo, $error);
                comprobarDuracion($duracion, $error);
                $pdo = conectar();
                comprobarGenero($pdo, $genero_id, $error);
                comprobarErrores($error);
                $valores = array_filter(compact(
                    'titulo',
                    'anyo',
                    'sinopsis',
                    'duracion',
                    'genero_id'
                ), 'comp');

                insertar($pdo, $valores);
                $_SESSION['mensaje'] = 'La Película se ha insertado correctamente.';

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
            ), null);

        
        ?>

    </body>
</html>
