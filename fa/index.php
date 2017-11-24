<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
        integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
        crossorigin="anonymous">
        <title>Listado de Peliculas</title>
        <style type="text/css">
            #buscar {
                margin-bottom: 12px;
            }

            #tabla {
                margin: auto;
            }
        </style>
    </head>
    <body>
        <?php
        $titulo = trim(filter_input(INPUT_GET, 'titulo')) ?? '';
        ?>
        <div class="container">
            <?php if (isset($_SESSION['mensaje'])): ?>
                <div>
                    <?= $_SESSION['mensaje'] ?>
                </div>
                <?php unset($_SESSION['mensaje']) ?>
            <?php endif ?>
        </div>
        <div id="buscar">
          <fieldset>
              <legend>Buscar</legend>
            <form action="index.php" method="get">
                <label for="titulo">Titulo</label>
                <input type="text" name="titulo" id="titulo"
                    value="<?= $titulo ?>"/>
                <input type="submit" name="" value="Buscar" />
            </form>
          </fieldset>
        </div>


        <?php
        require 'auxiliar.php';

        $pdo = conectar();
        $sent = $pdo->prepare("SELECT peliculas.id,
                                      titulo,
                                      anyo,
                                      left(sinopsis, 30) AS sinopsis,
                                      duracion,
                                      genero_id,
                                      genero
                                FROM peliculas
                                JOIN generos ON genero_id = generos.id
                                WHERE lower(titulo) LIKE lower(:titulo)");

        $sent->execute([':titulo' =>"%$titulo%"]);
        ?>
        <div class="">
            <table border="1" id="tabla">
                <thead>

                    <th>Título</th>
                    <th>Año</th>
                    <th>Sinopsis</th>
                    <th>Duración</th>
                    <th>Género</th>
                    <th colspan="2">Operaciones</th>
                </thead>
                    <?php foreach($sent as $fila): ?>
                        <tr>

                            <td><?= htmlspecialchars($fila['titulo'])?></td>
                            <td><?= $fila['anyo']?></td>
                            <td><?= $fila['sinopsis']?></td>
                            <td><?= $fila['duracion']?></td>
                            <td><?= $fila['genero']?></td>
                            <td>
                                <a href="modificar.php?id=<?= htmlspecialchars($fila['id'])?>">
                                    Modificar
                                </a>
                            </td>
                            <td>
                                <a href="borrar.php?id=<?= htmlspecialchars($fila['id'])?>">
                                    Borrar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <tbody>

                </tbody>
            </table>
        </div>
        <a href="insertar.php">Insertar una nueva película</a>

    </body>
</html>
