<?php
/**
 * Arquivo que contém a classe Xsd2PhpArray em Ferramentas.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp\Ferramentas;

/**
 * Classe para transformar arquivo xsd ( xml schema ) em uma array estruturada.
 *
 * @todo Publicar e instalar esta classe como biblioteca stand-alone.
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
   * The Schema Namespace on which xpath queries will be carried out.
   */
  private $xsd_namespace = 'xs';
  
  /**
   * Iterates throgh the xsd content nodes generating an php array along the
   * way.
   */
  public function generate_array ($array, $xpath_query = '/', $parents = FALSE) {
    $number_of_nodes = count($array);

    $lineages_of_this_call = array();

    for ($i = 1; $i <= $number_of_nodes; $i++) {
      $lineages_of_this_call[$i]['parents'] = $parents;
      $lineages_of_this_call[$i]['xpath_query'] = $xpath_query;
    }

    $loop_count = 1;
    foreach ($array as $key => $node) {

      if (is_array($node)) {
        // By default it won't have children.
        $children = FALSE;

        // Checa se as filhas são strings.
        foreach ($node as $sub_node_key => $sub_node) {

          if (!is_array($sub_node)) {
            $children_parents = $lineages_of_this_call[$loop_count]['parents'];
            $children_parents[] = $key;

            $children[] = array(
              'tag' => $sub_node_key,
              'value' => $sub_node,
              'tags_parents' => $children_parents,
            );
          }
        }

        $this->xsd_array[] = array(
          'tag' => $key,
          'value' => FALSE,
          'tags_parents' => $lineages_of_this_call[$loop_count]['parents'],
          'tags_children' => $children,
        );

        // Add the values from the current call to the lineages.
        $lineages_of_this_call[$loop_count]['parents'][] = $key;
        //$lineages_of_this_call[$loop_count]['xpath_query'] .= $xpath_query;

        // Call itself.
        $parents_temp = $lineages_of_this_call[$loop_count]['parents'];
        $xpath_query_temp = $lineages_of_this_call[$loop_count]['xpath_query'];

        self::generate_array($node, $xpath_query_temp, $parents_temp);
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
      
      // TODO: Set an error/warning handler instead of suppressing it.
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

  /**
   * Performes a xpath query on $xsd_content property.
   *
   * @param String $query
   *   The xpath query.
   */
  private function xpath_query($query = '/') {
  
    $xsd = $this->xsd_content;
    $namespace = $this->xsd_namespace;

    $xpath_query = $xsd->xpath("$query*");

    $nodes = array();
    foreach ($xpath_query as $key => $node) {
      $item = $key +1;

      $xsd_tag = $node->getName();
      $node_array = (array) $node;

      $item_name = $item;
      if (!empty($node_array['@attributes']['name'])) {
        $item_name = $node_array['@attributes']['name'];
      }

      $nodes[$item_name] = $node_array;
      $nodes[$item_name]['xsd_tag'] = $xsd_tag;
      $nodes[$item_name]['xml_tag'] = !is_integer($item_name) ? $item_name : FALSE;
      $nodes[$item_name]['xpath_query'] = $query . "$namespace:$xsd_tag" . "[$item]/";
    }

    return $nodes;
  }
  
  /**
   * Public setter.
   *
   * @param String $namespace
   *   O namespace usado pelo xpath query.
   */
  public function set_xsd_namespace($namespace) {
    $this->xsd_namespace = $namespace;
  }

  function teste($query = '/') {
    return $this->xpath_query($query);
  }
  
}
