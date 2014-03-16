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
    $dados_dfe_txt = self::get_valor_da_propriedade('dados_dfe_txt', $DFe);

    if (!is_resource($dados_dfe_txt)) {
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
    $dados_dfe_xml = self::get_valor_da_propriedade('dados_dfe_xml', $DFe);

    if (!is_resource($dados_dfe_xml)) {
      $this->_throw_exception('A propriedade $dados_dfe_xml esta vazia.');
    }
  }

  /**
   * Verifica se arquivo de entrada de dados existe.
   *
   * @param Objeto $DFe
   *   O objeto DFe.
   */
  public function input_arquivo_existe($DFe) {
    $input_path = self::get_valor_da_propriedade('input_path', $DFe);
    $input_nome_do_arquivo = self::get_valor_da_propriedade('input_nome_do_arquivo', $DFe);
    
    $file_full_location = $input_path . DIRECTORY_SEPARATOR . $input_nome_do_arquivo;

    if (empty($input_path) || empty($input_nome_do_arquivo)) {
      $file_full_location = FALSE;
    }

    if (!is_readable($file_full_location)) {
      $mensagem = sprintf("O arquivo de entrada de dados %s ou a pasta %s NAO existem.", $input_nome_do_arquivo, $input_path);
      $this->_throw_exception($mensagem);
    }
  }

  /**
   * Extrai o valor de qualquer tipo de propriedade ( privada, protegida
   * e publica ) do objeto $DFe ( class MakeDFe ).
   *
   * @param String $nome_da_propriedade
   *   O nome da propriedade que contém o valor desejado.
   * @param Object $DFe
   *   O Objeto DFe.
   * @return AnyType
   *   O valor da propriedade em questão.
   */
  private function get_valor_da_propriedade($nome_da_propriedade, $DFe) {
    $reflection = new \ReflectionObject($DFe);

    $propriedade = $reflection->getProperty($nome_da_propriedade);
    // Caso a propriedade seja protegida ou privada.
    $propriedade->setAccessible(TRUE);
    return $propriedade->getValue($DFe);
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
