<?php
/**
 * Arquivo que contém a classe SchemaGeral em Schemas.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */
namespace DFePhp\Schemas;

use DFePhp\Ferramentas as Ferramentas;

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
   * Versão do Pacote de Liberação contendo os arquivos XSDs.
   */
  private $versao_xsd;

  /**
   * Construtor automático.
   *
   * @param String $tipo_dfe
   *   O tipo de Documento Fiscal Eletrônico.
   * @param String $versao_dfe
   *   A versão do Documento Fiscal Eletrônico.
   * @param String $versao_xsd
   *   A versão do Pacote de Liberação contendo os XSDs
   */
  protected function __construct($tipo_dfe, $versao_dfe, $versao_xsd) {
    $this->set_tipo_dfe($tipo_dfe);
    $this->set_versao_dfe($versao_dfe);
    $this->set_versao_xsd($versao_xsd);
  }
  
  /**
   *
   */
  private function xsd_carregar_layout() {
    
  }

  /**
   * Informa o Tipo de Documento Fiscal. Ex. NFe, CTe, etc.
   *
   * @param String $tipo_dfe
   *   O tipo de Documento Fiscal Eletrônico.
   */
  public function set_tipo_dfe($tipo_dfe) {
    $this->tipo_dfe = $tipo_dfe;
  }

  /**
   * Informa a versão do DFe.
   *
   * @param String $versao_dfe
   *   A versão do Documento Fiscal Eletrônico.
   */
  public function set_versao_dfe($versao_dfe) {
    $this->versao_dfe($versao_dfe);
  }

  /**
   * Informa a versão do Pacote de Liberação contendo os arquivos XSDs.
   *
   * @param String $versao_xsd
   *   A versão do Pacote de Liberação contendo os XSDs.
   */
  public function set_versao_xsd($versao_xsd) {
    $this->versao_xsd($versao_xsd);
  }
}
