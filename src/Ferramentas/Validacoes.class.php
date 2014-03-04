<?php
/**
 * Ferramentas para Validação de Dados.
 *
 * @author https://github.com/nfephp-org/nfephp/graphs/contributors
 * @version https://github.com/nfephp-org/nfephp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 *
 */

namespace Nfephp\Ferramentas;
 
class Validacoes {

  /**
   * Verifica se o código IBGE numerico da unidade da UF é existente.
   *
   * @param String $valor
   *   Código da Unidade da Federação.
   * @return Bool
   *   Boleano Verdadeiro ou Falso
   */
  static function is_ibge_unidade_uf_numerico($valor) {
    // TODO: Escrever a validação.
    return TRUE;
  }

  /**
   * Verifica se o código IBGE do município é existente.
   *
   * @param String $valor
   *   Código do Município.
   * @return Bool
   *   Boleano Verdadeiro ou Falso
   */
  static function is_ibge_cod_municipio($valor) {
    // TODO: Escrever a validação.
    return TRUE;
  }

  /**
   * Valida valor conforme expressão regular.
   *
   * @param String $valor
   *   Valor a ser validado.
   * @param Array $parametros
   *   Expressão Regular
   * @return Bool
   *   Boleano Verdadeiro ou Falso
   */
  static function regex_valida($valor, $parametros) {
    $regex = $parametros['regex'];

    if(preg_match("/$regex/", $valor)) {
      return TRUE;
    }
    return FALSE;
  }

}



