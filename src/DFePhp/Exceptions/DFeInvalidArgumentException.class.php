<?php
/**
 * Gerencia o throw Exception para a classe InvalidArgumentException.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp\Exceptions;

/**
 * Classe para gerenciar os throw Exceptions da classe InvalidArgumentException.
 */
class DFeInvalidArgumentException extends \InvalidArgumentException {

  /**
   * Mensagem do Exception throw.
   */
  private $mensagem;

  /**
   * Isola o construtor da classe \InvalidArgumentException.
   */
  public function __construct() {}

  /**
   * Faz o throw Exception após a devida checagem tenha sido feita por um dos
   * métodos públicos desta classe.
   */
  private function _throw_exception() {
    parent::__construct($this->mensagem);
    throw $this;
  }

  /**
   * Checa se o parâmetro é um Integer.
   */
  public function _is_integer($nome_do_parametro, $valor_do_parametro) {
    if (!is_integer($valor_do_parametro)) {
      $this->set_mensagem($nome_do_parametro, $valor_do_parametro, 'Integer');
      $this->_throw_exception();
    }
  }

  /**
   * Identifica o método que fez a chamada para checar se há Exception.
   *
   * @return String
   *   O nome do método que fez a chamada para fazer o throw Exception.
   */
  private function set_mensagem($nome_do_parametro, $valor_do_parametro, $datatype_esperado) {
    $datatype_atual = gettype($valor_do_parametro);

    if (empty($valor_do_parametro)) {
      $valor_do_parametro = '[VAZIO]';
    }

    $trace = $this->getTrace();
    $this->mensagem = sprintf('Exception no Método %s da classe %s | %s deveria ser um(a) %s e NÃO um(a) %s - Valor enviado: %s',
      $trace[0]['function'],
      $trace[0]['class'],
      $nome_do_parametro,
      $datatype_esperado,
      $datatype_atual,
      $valor_do_parametro
    );
  }
}
