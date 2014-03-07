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

/**
 * Classe para construir o Documento Fiscal Eletrônico.
 */
class MakeDFe {

  /**
   * 
   */
  public function __construct($versao_do_layout, $dados_da_dfe) {
    $dfe = new $versao_do_layout();
  }
}
