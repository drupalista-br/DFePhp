<?php
/**
 * Arquivo que contém a classe SchemaGeral em Schemas.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */
namespace DFePhp\Schemas;

/**
 * Classe para criar os Layouts de Entrada de Dados dos DFe.
 */
abstract class SchemaGeral {

  /**
   * Tipo de Documento Fiscal. Ex. NFe, CTe, etc.
   */
  private $tipo_dfe;

  /**
   * Versão do DFe.
   */
  private $versao_dfe;

  /**
   * O nome da pasta em Schemas/$dfe/$pasta_dos_xsd onde os arquivos dos
   * Schemas XML estão guardados.
   */
  private $pasta_dos_xsd;

  /**
   * Construtor automático.
   */
  protected function __construct($tipo_dfe, $versao_dfe) {
    $this->set_tipo_dfe($tipo_dfe);
  }
  
  /**
   *
   */
  private function xsd_carregar_layout() {
    
  }

  /**
   * Informa o Tipo de Documento Fiscal. Ex. NFe, CTe, etc.
   */
  public function set_tipo_dfe($tipo_dfe) {
    $this->tipo_dfe = $tipo_dfe;
  }

  /**
   * Informa o nome da pasta em Schemas/$dfe/$pasta_dos_xsd onde os arquivos dos
   * Schemas XML estão guardados.
   */
  public function set_pasta_dos_xsd($pasta_dos_xsd) {
    $this->pasta_dos_xsd = $pasta_dos_xsd;
  }
}
