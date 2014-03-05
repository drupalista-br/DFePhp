<?php
/**
 * Calcula os Dígitos Verificadores.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 *
 */

namespace DFePhp\Ferramentas;

/**
 * Classe para calcular dígito verificador.
 */
class DigitoVerificador {

  /**
   * Calcula e retorna o dígito verificador usando o algoritmo Modulo 10
   *
   * @param Integer $num
   *   Número base para calcular o Dígito Verificador.
   * @return int
   *   Digito Verificador.
   *
   */
  protected static function modulo10($num) {
    $numtotal10 = 0;
    $fator = 2;

    //  Separacao dos numeros.
    for ($i = strlen($num); $i > 0; $i--) {
      // Pega cada numero isoladamente.
      $numeros[$i] = substr($num,$i-1,1);

      // Efetua multiplicacao do numero pelo (falor 10).
      $temp = $numeros[$i] * $fator;
      $temp0 = 0;

      foreach (preg_split('// ', $temp, -1, PREG_SPLIT_NO_EMPTY) as $v){ $temp0 += $v; }

      $parcial10[$i] = $temp0; // $numeros[$i] * $fator;
      // Monta sequencia para soma dos digitos no (modulo 10).
      $numtotal10 += $parcial10[$i];

      if ($fator == 2) {
        $fator = 1;
      }
      else {
        // Intercala fator de multiplicacao (modulo 10).
        $fator = 2;
      }
    }

    $remainder  = $numtotal10 % 10;
    $digito = 10 - $remainder;

    // Digitos 10 são transformados em 0.
    $digito = ($digito == 10) ? 0 : $digito;

    return $digito;
  }

  /**
   * Calcula e retorna o dígito verificador usando o algoritmo Modulo 11
   *
   * @param string $num
   * @param int $base
   * @return array
   *   Retorna um array com as chaves 'digito' e 'resto'
   */
  protected static function modulo11($num, $base = 9) {
    $fator = 2;

    $soma  = 0;
    // Separacao dos numeros.
    for ($i = strlen($num); $i > 0; $i--) {
      // Pega cada numero isoladamente.
      $numeros[$i] = substr($num,$i-1,1);

      // Efetua multiplicacao do numero pelo falor.
      $parcial[$i] = $numeros[$i] * $fator;

      // Soma dos digitos.
      $soma += $parcial[$i];

      if ($fator == $base) {
        // Restaura fator de multiplicacao para 2.
        $fator = 1;
      }
      $fator++;
    }

    $result = array(
      'digito' => ($soma * 10) % 11,
      'resto' => $soma % 11,
    );

    if ($result['digito'] == 10){
      $result['digito'] = 0;
    }
    return $result;
  }
}
