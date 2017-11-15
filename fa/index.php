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
        $filas = $query->fetchAll();
        ?>
        <table border="1">
            <thead>
                <th>Id</th>
                <th>Título</th>
                <th>Año</th>
                <th>Sinopsis</th>
                <th>Duración</th>
                <th>Género</th>
            </thead>
                <?php foreach($filas as $fi): ?>
                    <tr>
                        <td><?= $fi['id']?></td>
                        <td><?= $fi['titulo']?></td>
                        <td><?= $fi['anyo']?></td>
                        <td><?= $fi['sinopsis']?></td>
                        <td><?= $fi['duracion']?></td>
                        <td><?= $fi['genero_id']?></td>
                    </tr>
                <?php endforeach ?>
            <tbody>

            </tbody>
        </table>

    </body>
</html>
