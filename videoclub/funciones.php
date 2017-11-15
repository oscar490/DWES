<?php


function mostrarTabla(array $lista): void
{
  $cabecera = ['Titulo', 'Director', 'Año', 'Género', 'Duración', 'Sipnosis',
                'Edad'];
  ?>
  <table border="1" align="center">
    <tr>
    <?php foreach ($cabecera as $v): ?>
        <td align="center" width="50" height="20"><?= htmlentities($v) ?></td>
    <?php endforeach ?>
  </tr>
  <tr>
    <?php foreach ($lista as $v): ?>
        <td align="center" width="50" height="20"><?= htmlentities($v)?></td>
    <?php endforeach ?>
  </tr>
  </table>
  <?php
}
