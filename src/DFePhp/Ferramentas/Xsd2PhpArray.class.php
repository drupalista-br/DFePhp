<?php
/**
 * File containing the Xsd2PhpArray class.
 *
 * @author https://github.com/drupalista-br/Xsd2PhpArray/graphs/contributors
 * @version https://github.com/drupalista-br/Xsd2PhpArray/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace Drupalista_br;

/**
 * Class for converting xsd ( xml schema ) content into a PHP Array.
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
   * Iterates throgh the xsd content nodes generating a php array along the
   * way.
   */
  public function xsd_2_array($array, $xpath_query = '/', $parents = FALSE) {
    $array = $this->xpath_query($xpath_query);

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

        self::xsd_2_array($node, $xpath_query_temp, $parents_temp);
      }

      $loop_count += 1;
    }
  }

  /**
   * Performes a xpath query on $xsd_content property.
   *
   * @param String $query
   *   The xpath query.
   * @param String $parents_nesting_coordenates
   *   The parents nesting coordinates of the current node.
   */
  private function xpath_query_assembling($query = '/', $parents_nesting_coordenates = FALSE) {
    if (empty($this->xsd_content)) {
      throw new \Exception("The XSD content has not been loaded. You must beforehand call \$myObject->load_xsd_content('/xsd/location/file.xsd').");
    }

    $xsd = $this->xsd_content;
    $namespace = $this->xsd_namespace;

    $xpath_query = $xsd->xpath("$query*");

    $nodes = array();

    foreach ($xpath_query as $key => $node) {
      $xsd_tag = $node->getName();

      $node_array = (array) $node;

      $xml_tag = FALSE;
      if (!empty($node_array['@attributes']['name'])) {
        $xml_tag = $node_array['@attributes']['name'];
      }

      $nesting_separator = '-';
      if (!$parents_nesting_coordenates) {
        $nesting_separator = '';
      }

      // ${$xsd_tag} holds the per xsd element sequencing number.
      if(empty(${$xsd_tag})) {
        ${$xsd_tag} = 0;
      }
      ${$xsd_tag} += 1;

      // $item_sequence holds the sequencing number of all xsd elements.
      $item_sequence = $key + 1;

      // The nesting coordinate address of the current XSD node.
      $current_coordinates = $parents_nesting_coordenates . $nesting_separator . $item_sequence;

      $nodes[$current_coordinates]['xsd_values'] = $node_array;
      $nodes[$current_coordinates]['xsd_tag'] = $xsd_tag;
      $nodes[$current_coordinates]['xml_tag'] = $xml_tag;
      $nodes[$current_coordinates]['xpath_query_children'] = $query . "$namespace:$xsd_tag" . "[" . ${$xsd_tag} . "]/";
    }

    return $nodes;
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
   * "xs" is the default value set at instantiation.
   *
   * @param String $namespace
   *   The Schema Namespace on which xpath queries will be carried out.
   */
  public function set_xsd_namespace($namespace) {
    $this->xsd_namespace = $namespace;
  }

  function teste($query = '/', $parents_nesting_coordenates = FALSE) {
    return $this->xpath_query_assembling($query, $parents_nesting_coordenates);
  }
}
