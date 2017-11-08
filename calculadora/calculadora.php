<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
      <?php
      $op1 = $op2 = null;
      extract($_GET, EXTR_IF_EXISTS);
      ?>
      <?php if (isset($op1, $op2)): ?>
        <?php if (is_numeric($op1) && is_numeric($op2)): ?>
          <p>El resultado es <?= $op1 + $op2 ?></p>
        <?php else: ?>
          <h3>Error: Se deben introducir números</h3>
        <?php endif ?>
      <?php else: ?>
        <h3>Error: Los números son obligatorios</h3>
      <?php endif ?>
  </body>
</html>
