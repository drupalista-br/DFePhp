<?php
/**
 * Gerencia o throw Exception para a classe MakeDFe.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp\Exceptions;

/**
 * Classe para gerenciar os throw Exceptions da classe MakeDFe.
 */
class MakeDFeExceptions extends \Exception {

  /**
   * Isola o construtor da classe \Exception.
   */
  public function __construct() {}

  /**
   * Faz o throw Exception após a devida checagem tenha sido feita por um dos
   * métodos públicos desta classe.
   *
   * @param String $mensagem
   *   A mensagem da Exception.
   */
  private function _throw_exception($mensagem) {
    $mensagem = sprintf('%s | %s', $this->get_trace_caller(), $mensagem);
    parent::__construct($mensagem);
    throw $this;
  }

  /**
   * Verifica se a propriedade $dados_dfe_txt está vazia.
   *
   * @param Objeto $DFe
   *   O objeto DFe.
   */
  public function is_empty_dados_dfe_txt($DFe) {
    if (!is_resource($DFe->get_dados_dfe_txt())) {
      $this->_throw_exception('A propriedade $dados_dfe_txt esta vazia.');
    }
  }

  /**
   * Verifica se a propriedade $dados_dfe_xml está vazia.
   *
   * @param Objeto $DFe
   *   O objeto DFe.
   */
  public function is_empty_dados_dfe_xml($DFe) {
    if (!is_resource($DFe->get_dados_dfe_xml())) {
      $this->_throw_exception('A propriedade $dados_dfe_xml esta vazia.');
    }
  }

  /**
   * Verifica se a propriedade $input_extensao_do_arquivo contém o valor
   * $DFe::EXTENSAO_TXT.
   *
   * @param Objeto $DFe
   *   O objeto DFe.
   */
  public function is_txt_input_extensao_do_arquivo($DFe) {
    if ($DFe->get_input_extensao_do_arquivo() != $DFe::EXTENSAO_TXT) {
      $mensagem = sprintf("A extensao do arquivo %s nao e' TXT.", $DFe->get_input_nome_do_arquivo());
      $this->_throw_exception($mensagem);
    }
  }

  /**
   * Verifica se arquivo de entrada de dados existe.
   *
   * @param Objeto $DFe
   *   O objeto DFe.
   */
  public function input_arquivo_existe($DFe) {
    $input_path = $DFe->get_input_path();
    $input_nome_do_arquivo = $DFe->get_input_nome_do_arquivo();

    if (!file_exists($input_path . DIRECTORY_SEPARATOR . $input_nome_do_arquivo)) {
      $mensagem = sprintf("O arquivo de entrada de dados %s NAO existe na pasta %s.", $input_nome_do_arquivo, $input_path);
      $this->_throw_exception($mensagem);
    }
  }

  /**
   * Identifica o método que fez a chamada para checar se há Exception.
   *
   * @return String
   *   O nome do método que fez a chamada para fazer o throw Exception.
   */
  private function get_trace_caller() {
    $trace = $this->getTrace();
    return sprintf('Exception no Metodo %s da classe %s', $trace[0]['function'], $trace[0]['class']);
  }
}
