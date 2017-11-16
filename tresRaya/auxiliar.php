<?php



function mostrarTablero(array $tablero): void
{
    ?>
    <table border="1">
      <?php for ($i = 0; $i < count($tablero); $i++): ?>
        <tr>
          <?php for ($x = 0; $x < count($tablero[$i]); $x++): ?>
            <td width="60" height="70" align="center"><?= $tablero[$i][$x] ?></td>
          <?php endfor ?>
        </tr>
      <?php endfor ?>
    </table>
    <?php
}

function addBD($ficha, $celda)
{
    $pdo = new PDO('pgsql:host=localhost;dbname=tresRaya','tresRaya', 'tresRaya');
    $ficha = $ficha == 'x'? 1 : 2;
    $insercion = "INSERT INTO partida (jugador_id, ficha_id, celda_id) 
      VALUES (1, $ficha, $celda);";
    $pdo->query($insercion);
    echo $insercion;
    var_dump($pdo);
}


function mostrarOpciones(int $numOpciones)
{
  for ($i = 1; $i <= 9; $i++ ):
    ?>
    <option value="<?= $i ?>"><?= $i ?></option>
    <?php
  endfor;
}
