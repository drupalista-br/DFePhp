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
  private $layout_do_dfe;
  
  /**
   * Array com as informações da DFe sendo gerada.
   */
  private $dados_do_dfe;

  /**
   * XML do DFe sendo gerada.
   */
  private $xml_do_dfe;

  /**
   * XML do DFe sendo gerada.
   */
  private $txt_do_dfe;

  /**
   * 
   * @param String $versao_do_layout
   *   Versão do Layout do DFe.
   */
  public function __construct($versao_do_layout = '') {
    try {
      $exception_error_message = FALSE;

      if (!empty($versao_do_layout) && is_string($versao_do_layout)) {
        $class_name = 'DFePhp\\LayoutDeDados\\VersoesDosLayouts\\' . $versao_do_layout;

        if (!class_exists($class_name, TRUE)) {
          $exception_error_message = "O Layout $versao_do_layout nao e' valido ou nao e' mais suportado.";
        }
      }
      else {
        $exception_error_message = "Voce nao informou a versao do Layout do DFe ou o informado nao e' uma string.";
      }

      if ($exception_error_message) {
        throw new \Exception($exception_error_message);
      }
      else {
        $this->layout_do_dfe = $class_name::layout();
      }
    }
    catch (\Exception $e) {
      echo $e->getMessage();
    }
  }

  private function gera_xml() {
    
  }

  private function gera_txt() {
    
  }

  public function test() {
    return $this->layout_do_dfe;
  }
}
