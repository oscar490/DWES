<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php

    $op1 = $op2 = $op = $res = null;
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

      /**
       * Se encarga de que se muestre el operador usado para realizar la
       * operación aritmética.
       * @param  string $cadena La cadena que repesenta el operador.
       * @return string         El atributo de seleccionado.
       */
      function seleccion(string $cadena): string
      {
        $re = "";

        global $op;

        if ($cadena == $op) {
            $re = 'selected';
        }

        return $re;

      }
      ?>
      <?php if (isset($op1, $op2)): ?>
        <?php if (is_numeric($op1) && is_numeric($op2)): ?>
          <?php if (in_array($op, ['*', '+', '/', '-'])): ?>
            <?php $res = calcula($op1, $op2, $op) ?>
          <?php else: ?>
            <h3>Error: Operación inválida</h3>
          <?php endif ?>
        <?php else: ?>
          <h3>Error: Se deben introducir números</h3>
        <?php endif ?>
      <?php endif ?>

      <form action="calculadora.php" method="get">

        <label for="op1">Primer operando</label>
        <input type="text" name="op1" id="op1" value="<?= $op1 ?>"><br>

        <label for="op2">Segundo operando</label>
        <input type="text" name="op2" id="op2" value="<?= $op2 ?>"><br>

        <label for="resultado">Resultado</label>
        <input type="text" id="resultado" value="<?= $res ?>" ><br>

        <select name="op">
          <option value="+" <?= seleccion("+") ?>>Suma</option>
          <option value="-" <?= seleccion("-") ?>>Resta</option>
          <option value="*" <?= seleccion("*") ?>>Multiplicar</option>
          <option value="/" <?= seleccion("/") ?>>Dividir</option>
        </select>

        <input type="submit" value="Calcular">

      </form>

  </body>
</html>
