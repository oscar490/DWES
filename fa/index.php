<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Listado de Peliculas</title>
    </head>
    <body>

        <?php
        $pdo = new PDO('pgsql:host=localhost;dbname=fa','fa','fa');
        $query = $pdo->query('SELECT * FROM peliculas');
        ?>
        <table border="1">
            <thead>
                <th>Id</th>
                <th>Título</th>
                <th>Año</th>
                <th>Sinopsis</th>
                <th>Duración</th>
                <th>Género</th>
                <th>Operaciones</th>
            </thead>
                <?php foreach($query as $fila): ?>
                    <tr>
                        <td><?= $fila['id']?></td>
                        <td><?= $fila['titulo']?></td>
                        <td><?= $fila['anyo']?></td>
                        <td><?= $fila['sinopsis']?></td>
                        <td><?= $fila['duracion']?></td>
                        <td><?= $fila['genero_id']?></td>
                        <td>
                            <a href="borrar.php?id=<?= $fila['id']?>">
                                Borrar
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            <tbody>

            </tbody>
        </table>

    </body>
</html>
