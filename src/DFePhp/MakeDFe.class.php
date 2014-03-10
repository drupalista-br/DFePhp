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
   * Array com os dados estruturados do DFe sendo gerado.
   */
  private $array_do_dfe;

  /**
   * XML do DFe sendo gerado.
   */
  private $xml_do_dfe;

  /**
   * XML do DFe sendo gerado.
   */
  private $txt_do_dfe;

  /**
   * 
   * @param String $versao_do_layout
   *   Versão do Layout para gerar o DFe.
   * @param Array $input
   *   Veja a descrição do método dfe_data_input().
   */
  public function __construct($versao_do_layout = '', $input = '') {
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

    if (!empty($input)) {
      $this->dfe_data_input($input);
    }
  }

  private function transforma_array2xml() {
    
  }

  private function transforma_array2txt() {
    
  }

  private function transforma_txt2array() {
    
  }

  private function transforma_txt2xml() {
    
  }

  private function transforma_xml2array() {
    
  }

  private function transforma_xml2txt() {
    
  }

  /**
   * 
   */
  public function dfe_data_input($input) {
    
  }

  public function test() {
    return $this->layout_do_dfe;
  }
}
