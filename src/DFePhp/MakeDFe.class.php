<?php
/**
 * Contrutor do Documento Fiscal Eletrônico.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp;

use DFePhp\LayoutDeDados\LayoutDeDados;
use DFePhp\LayoutDeDados\VersoesDosLayouts\NFe_500;

/**
 * Classe para construir o Documento Fiscal Eletrônico.
 */
class MakeDFe extends LayoutDeDados {

  /**
   * 
   */
  public function __construct() {
    $this->seleciona_layout();
    
    
  }
  
  private function teste() {
    echo 'teste';
  }
}
