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
   * O objeto $DFe construido pela classe MakeDFe.
   */
  private $DFe;

  /**
   * Salva o Objeto DFe na propriedade $DFe.
   * 
   * @param Object $MakeDFe
   *   O objeto $DFe construido pela classe MakeDFe.
   */
  public function __construct($DFe) {
    $this->DFe = $DFe;
  }

  /**
   *
   */
  public function is_empty_dados_dfe_txt() {

    $this->makeDFe_trace();
    parent::__construct('test');
    
    throw $this;
    if (empty($this->DFe->dados_dfe_txt)) {
      //parent::__construct();
    }
  }

  private function makeDFe_trace() {
    $trace = $this->getTrace();
    print_r($trace);
  }
}
