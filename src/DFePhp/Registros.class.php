<?php
/**
 * Arquivo que contém a classe Registros em DFePhp.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp;

/**
 * Classe para extrair os detalhes das definições dos componentes externos
 * de cada tipo de Documento Fiscal suportado por esta biblioteca.
 */
class Registros {
  
  /**
   * Informações sobre as classes de cada componente.
   */
  private $componetes = array(
    'Schemas' => array(),
    'Txts' => array(),
    'WebServices' => array(),
  );

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
    $componetes = $this->componetes;

    $path_atual = realpath(__DIR__);

    // $registros nesta altura ainda está vario.
    foreach($componetes as $pasta => $registros) {
      $path_do_componete = $path_atual . DIRECTORY_SEPARATOR . $pasta;

      $componete = new \DirectoryIterator($path_do_componete);
  
      foreach ($componete as $DFe) {
        // Cada subpasta representa um tipo de DFe.
        if ($DFe->isDir() && !$DFe->isDot()) {
          $nome_do_DFe = $DFe->getFilename();
          $path_DFe = $path_do_componete . DIRECTORY_SEPARATOR . $nome_do_DFe;

          // Agora busca as classes em cada DFe.
          $this->helper_carrega_registros($nome_do_DFe, $path_DFe, $pasta);
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
   */
  private function helper_carrega_registros($nome_do_DFe, $path_DFe, $componente) {
    $arquivos = new \DirectoryIterator($path_DFe);

    $registros = FALSE;
    foreach ($arquivos as $arquivo) {
      if ($arquivo->isFile()) {
        $nome_da_classe = explode('.', $arquivo->getFilename());
        $nome_da_classe = "\\DFePhp\\$componente\\$nome_do_DFe\\" . $nome_da_classe[0];
   
        if (class_exists($nome_da_classe)) {
          if (method_exists($nome_da_classe, 'registro')) {
            $registro = $nome_da_classe::registro();
            $registro['classe'] = $nome_da_classe;
            $registro['componente'] = $componente;
            $registro['DFe'] = $nome_do_DFe;

            $registros[$registro['data_do_release']] = $registro;
          }
        }
      }
    }

    if ($registros) {
      // TODO: Ordenar os registros por data.
      $this->componetes[$componente][$nome_do_DFe] = $registros;
    }
  }
  
  /**
   * Public getter.
   *
   * @return Array
   *   Informações das classes contidas em cada componente.
   */
  public function get_componentes_info() {
    $componentes = array();
    foreach ($this->componetes as $componente => $info) {
      if (!empty($info)) {
        $componentes[$componente] = $info;
      }
    }
    return $componentes;
  }
}
