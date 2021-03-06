<?php
/**
 * Validação de Dados de Entrada.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 *
 */

namespace DFePhp\Ferramentas;

/**
 * Classe para validar entrada de dados.
 */
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

  /**
   * Busca por caracteres especiais e coverte-os para formato UTF8.
   *
   * @param String $texto
   *   String a ser checada.
   * @return String
   *   O mesmo texto de entrada mas com caracteres especiais convertidos para
   *   UTF8.
   */
  function utf8($texto) {
    return trim(strtr(utf8_decode($texto), utf8_decode('ªºàáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aoaaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY'));
  }

}
