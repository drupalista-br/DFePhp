<?php
/**
 * Arquivo que contém a classe DFePhp\FerramentasXsd2PhpArray.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp\Ferramentas;

/**
 * Classe para transformar arquivos xsd ( xml schema ) em arrays
 * estruturadas.
 *
 * @see 
 */
class Xsd2PhpArray {

  /**
   * The generated array from the xsd content.
   */
  public $xsd_array = array();

  /**
   * Xsd content once 
   */
  private $xsd_content;
  
  /**
   * Iterates throgh the xsd content nodes generating an php array along the
   * way.
   */
  public function generate_array ($array, $parentes = FALSE) {
    $number_of_nodes = count($array);

    $lineages_of_this_call = array();

    for ($i = 1; $i <= $number_of_nodes; $i++) {
      $lineages_of_this_call[$i] = $parentes;
    }

    $loop_count = 1;
    foreach ($array as $key => $node) {

      if (is_array($node)) {
        // Padrão é não ter filhas.
        $filhas = FALSE;

        // Checa se as filhas são strings.
        foreach ($node as $sub_node_key => $sub_node) {

          if (!is_array($sub_node)) {
            $parentes_das_filhas = $lineages_of_this_call[$loop_count];
            $parentes_das_filhas[] = $key;

            $filhas[$sub_node_key] = array(
              'tag' => $sub_node_key,
              'value' => $sub_node,
              'tags_parents' => $parentes_das_filhas,
            );
          }
        }

        $this->xsd_array[$key] = array(
          'tag' => $key,
          'value' => FALSE,
          'tags_parents' => $lineages_of_this_call[$loop_count],
          'tags_children' => $filhas,
        );
        $lineages_of_this_call[$loop_count][] = $key;

        self::generate_array($node, $lineages_of_this_call[$loop_count]);
      }

      $loop_count += 1;
    }
  }
  
  /**
   * Loads the XSD content into the $xsd_content property.
   */
  public function load_xsd_content($location) {
    $exist_check = is_readable($location);

    if (!$exist_check) {
      // TODO: Set a error/warning handler instead of suppressing it.
      $exist_check = @get_headers($location);

      if (stripos($exist_check[0], "200 OK")) {
        // Remote file could be read.
        $exist_check = TRUE;
      }
      else {
        // Can't reach it remotelly.
        $exist_check = FALSE;
      }
    }

    if ($exist_check) {
      $this->xsd_content = simplexml_load_file($location);
    }
    else {
      throw new \Exception(sprintf("The XSD source at %s could not be found / read.", $location));
    }
  }
  
  public function test($location) {
    $this->xsd_content = get_headers($location);
  }
  
}
