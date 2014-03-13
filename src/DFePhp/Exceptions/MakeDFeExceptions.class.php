<?php
/**
 * Constroi a mensagem de error para argumentos inválidos.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp\Exceptions;

class MakeDFeExceptions extends \Exception {

  /**
   * O objeto $MakeDFe.
   */
  private $MakeDFe;

  /**
   *
   * @param Object $MakeDFe
   *   O objeto $MakeDFe.
   * @param String $method_checker
   *   O nome do método que deverá ser chamada para verificar se a exceção.
   */
  public function __construct($MakeDFe, $method_checker) {
    $this->MakeDFe = $MakeDFe;
    $this->$method_checker();
  }

  /**
   *
   */
  private function empty_dados_dfe_txt() {
    $MakeDFe = $this->MakeDFe;

    $this->makeDFe_trace();
    if (empty($MakeDFe->dados_dfe_txt)) {
      //parent::__construct();
    }
  }

  private function makeDFe_trace() {
    $trace = $this->getTrace();
    print_r($trace);
  }
}
