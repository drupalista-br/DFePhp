<?php
/**
 * Contrutor do Documento Fiscal Eletrônico.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp;

/**
 * Classe para construir o Documento Fiscal Eletrônico.
 */
class MakeDFe {

  /**
   * Layout do DFe a ser gerado. 
   */
  private $layout_escolhido;

  /**
   * 
   * @param String $versao_do_layout
   *   Versão do Layout da Estrutura de Dados da DFe.
   */
  public function __construct($versao_do_layout) {
    $class_name = 'DFePhp\\LayoutDeDados\\VersoesDosLayouts\\' . $versao_do_layout;
    $layout = new $class_name();
    $this->layout_escolhido = $layout->layout_escolhido;
  }

  private function gera_dfe_com_dados($dados_da_dfe) {
    
  }

  private function gera_dfe_com_txt($txt) {
    
  }

  public function test() {
    return $this->layout_escolhido;
  }
}
