<?php
/**
 * Arquivo que contém a classe PL008bXsd310 em NFe.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp\Schemas\NFe;

use DFePhp\Schemas\SchemaGeral;

/**
 * Classe para construir o Layout da NFe conforme Pacote de Liberação No. 8b.
 */
class PL008bXsd310 extends SchemaGeral {

  /**
   * Informações sobre a versão / release do manual do contribuinte.
   */
  public static function registro() {
    return array (
      'website' => 'http://www.nfe.fazenda.gov.br',
      'versao' => 'XSD 3.10',
      // YYYY-MM-DD
      'data_do_release' => '2013-12-11',
      'manual' => 'resources/docs/Nfe/Manual_de_Orientacao_Contribuinte_v_5.00.pdf',
      'observacao' => 'Pacote de Liberação No. 8b',
    );
  }
}
