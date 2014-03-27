<?php
/**
 * Arquivo que contém a classe Registros em DFePhp.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp;

use DFePhp\Schemas as Schemas;
use DFePhp\Txts as Txts;
use DFePhp\WebServices as WebServices;

/**
 * Classe para extrair os detalhes das definições dos componentes externos
 * de cada tipo de Documento Fiscal suportado por esta biblioteca.
 */
class Registros {
  
  /**
   * Detalhamento dos XML Schemas suportados.
   */
  private $componete_schemas;

  /**
   * Detalhamento dos Layouts de Arquivos TXT suportados.
   */
  private $componete_layouts_txts;

  /**
   * Detalhamento dos Webservices suportados.
   */
  private $componete_webservices;

  /**
   * Construtor automático.
   */
  public function __construct() {
    $this->carrega_registros();
  }

  /**
   * Busca os DFe existentes em cada pasta componente.
   */
  private function carrega_registros() {
    // propriedade => pasta do componente.
    $componetes = array(
      'componete_schemas' => 'Schemas',
      'componete_layouts_txts' => 'Txts',
      'componete_webservices' =>'WebServices',
    );

    $path_atual = realpath(__DIR__);

    foreach($componetes as $propriedade => $pasta) {
      $path_do_componete = $path_atual . DIRECTORY_SEPARATOR . $pasta;

      $componete = new \DirectoryIterator($path_do_componete);
  
      foreach ($componete as $DFe) {
        // Cada subpasta representa um tipo de DFe.
        if ($DFe->isDir() && !$DFe->isDot()) {
          $nome_do_DFe = $DFe->getFilename();
          $path_DFe = $path_do_componete . DIRECTORY_SEPARATOR . $nome_do_DFe;

          // Agora busca as classes em cada DFe.
          $this->helper_carrega_registros($nome_do_DFe, $path_DFe, $pasta, $propriedade);
        }
      }
    }
  }

  /**
   * Busca as classes existentes em cada pasta DFe.
   *
   * @param String $nome_do_DFe
   *   O nome do Documento Fiscal.
   * @param String $path_DFe
   *   O caminho físico da pasta onde as classes do DFe estão.
   * @param String $componente
   *   Nome do componente ( Schemas, Txts ou Webservices )
   * @param String $propriedade
   *   O nome da propriedade ( $componete_schemas, $componete_layouts_txts ou
   *   $componete_webservices ).
   */
  private function helper_carrega_registros($nome_do_DFe, $path_DFe, $componente, $propriedade) {
    $arquivos = new \DirectoryIterator($path_DFe);

    $registros = FALSE;
    foreach ($arquivos as $arquivo) {
      if ($arquivo->isFile()) {
        $nome_da_classe = explode('.', $arquivo->getFilename());
        $nome_da_classe = "\\$componente\\" . $nome_da_classe[0];

        if (class_exists($nome_da_classe)) {
          if (method_exists($nome_da_classe, 'registro')) {
            $registro = $nome_da_classe::registro();

            $registros[$registro['data_do_release']] = $registro;
          }
        }
      }
    }

    if ($registros) {
      $this->$propriedade[$nome_do_DFe] = ksort($registros);
    }
  } 
}
