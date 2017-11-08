<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
      <?php
      $op1 = $op2 = $op = null;
      extract($_GET, EXTR_IF_EXISTS);

      function calcula($op1, $op2, $op)
      {
        switch ($op) {
          case '+':
            $resultado = $op1 + $op2;
            break;

          case '-':
            $resultado = $op1 - $op2;
            break;

          case '*':
            $resultado = $op1 * $op2;
            break;

          case '/':
            $resultado = $op1 / $op2;
            break;

        }

        return $resultado;
      }
      ?>
      <?php if (isset($op1, $op2)): ?>
        <?php if (is_numeric($op1) && is_numeric($op2)): ?>
          <?php if (in_array($op, ['*', '+', '/', '-'])): ?>
            <p>El resultado es <?= calcula($op1, $op2, $op) ?></p>
          <?php else: ?>
            <h3>Error: Operación inválida</h3>
          <?php endif ?>
        <?php else: ?>
          <h3>Error: Se deben introducir números</h3>
        <?php endif ?>
      <?php else: ?>
        <h3>Error: Los números son obligatorios</h3>
      <?php endif ?>
  </body>
</html>
