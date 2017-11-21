<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
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
        require 'auxiliar.php';
        
        $titulo = trim(filter_input(INPUT_GET, 'titulo')) ?? '';
        ?>
        <div id="buscar">

          <fieldset>
              <legend>Buscar</legend>
            <form action="index.php" method="get">
                <label for="titulo">Titulo</label>
                <input type="text" name="titulo" id="titulo"
                    value="<?= h($titulo) ?>"/>
                <input type="submit" name="" value="Buscar" />
            </form>
          </fieldset>

        </div>


        <?php


        $pdo = conectar();
        $sent = buscarPeliculaInicio($pdo, $titulo);
        ?>
        <div class="">
            <table border="1" id="tabla">
                <thead>

                    <th>Título</th>
                    <th>Año</th>
                    <th>Sinopsis</th>
                    <th>Duración</th>
                    <th>Género</th>
                    <th>Operaciones</th>
                </thead>
                    <?php foreach($sent as $fila): ?>
                        <tr>

                            <td><?= h($fila['titulo'])?></td>
                            <td><?= h($fila['anyo'])?></td>
                            <td><?= h($fila['sinopsis'])?></td>
                            <td><?= h($fila['duracion'])?></td>
                            <td><?= h($fila['genero_id'])?></td>
                            <td>
                                <a href="borrar.php?id=<?= h($fila['id'])?>">
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
