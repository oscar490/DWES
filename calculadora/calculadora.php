<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php

    $op1 = $op2 = $op  = null;
    extract($_GET, EXTR_IF_EXISTS);




      /**
       * Realiza una operación aritmética.
       * @param  float $op1 El primer operando
       * @param  float $op2 El segundo operando
       * @param  string $op  Representa el operador
       * @return float      Devuelve el número resultante de la operación.
       */
      function calcula(float $op1, float $op2, string $op): float
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

      function selected(string $v, ?string $o): string
      {
          return $v == $o ? 'selected': '';
      }

      ?>
      <?php if (isset($op1, $op2, $op)): ?>
        <?php if (is_numeric($op1) && is_numeric($op2)): ?>
          <?php if (in_array($op, ['*', '+', '/', '-'])): ?>
            <?php $op1 = calcula($op1, $op2, $op) ?>
          <?php else: ?>
            <h3>Error: Operación inválida</h3>
          <?php endif ?>
        <?php else: ?>
          <h3>Error: Se deben introducir números</h3>
        <?php endif ?>
    <? elseif ($op1 !== null || $op2 !== null || $op !== null): ?>
          <h3>Error: Falta algún parámetro</h3>
      <?php endif ?>

      <form action="calculadora.php" method="get">

        <label for="op1">Primer operando</label>
        <input type="text" name="op1" id="op1" value="<?= $op1 ?>"><br>

        <label for="op2">Segundo operando</label>
        <input type="text" name="op2" id="op2" value="<?= $op2 ?>"><br>


        <select name="op">
          <option value="+" <?= selected("+", $op) ?> >Suma</option>
          <option value="-" <?= selected("-", $op) ?> >Resta</option>
          <option value="*" <?= selected("*", $op) ?> >Multiplicar</option>
          <option value="/" <?= selected("/", $op) ?> >Dividir</option>
        </select>

        <input type="submit" value="Calcular">

      </form>

  </body>
</html>
