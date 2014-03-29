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
  public $xsd_structure_array = array();

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
  public function xsd_2_array($array = FALSE) {

    if ($array === FALSE) {
      // This is the kick off call.
      $array = $this->xpath_query();
      $this->xsd_structure_array = $array;
    }

    foreach ($array as $nesting_coordenate => $node) {

      // Get the grandparents.
      $this_lineage_parents = $array[$nesting_coordenate]['node_parents'];
      // Add the parent.
      $this_lineage_parents[] = $array[$nesting_coordenate]['node_tag'];


      // $query_node.
      $query_node[$nesting_coordenate] = $node['xpath_query_children'];
      // $nesting_coordenates_parents.
      $nesting_coordenates_parents[$nesting_coordenate] = $node['nesting_coordenates'];

      $array_children = $this->xpath_query($query_node[$nesting_coordenate], $nesting_coordenates_parents[$nesting_coordenate], $this_lineage_parents);
      
      if (!empty($array_children)) {
        $xsd_structure_array = $this->xsd_structure_array;
  
        $this->xsd_structure_array = array_merge($xsd_structure_array, $array_children);
        
        self::xsd_2_array($array_children);
      }
    }
  }

  /**
   * Performes a xpath query on a given XSD element node.
   *
   * @param String $query_node
   *   The xpath query address of a node.
   * @param String $nesting_coordenates_parents
   *   The parent's nesting coordinates of the current node.
   * @return Array
   *   The children nodes of the specified XSD element node.
   */
  private function xpath_query($query_node = '/', $nesting_coordenates_parents = FALSE, $node_parents = FALSE) {
    if (empty($this->xsd_content)) {
      throw new \Exception("The XSD content has not been loaded. You must beforehand call \$myObject->load_xsd_content('/xsd/location/file.xsd').");
    }

    $xsd = $this->xsd_content;
    $namespace = $this->xsd_namespace;

    $xpath_query = $xsd->xpath("$query_node*");

    $nodes = array();

    foreach ($xpath_query as $key => $node) {
      $xsd_tag = $node->getName();

      $node_array = (array) $node;

      $nesting_separator = '-';
      if (!$nesting_coordenates_parents) {
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
      $current_coordinates = $nesting_coordenates_parents . $nesting_separator . $item_sequence;

      $nodes[$current_coordinates]['node_values'] = $node_array;
      $nodes[$current_coordinates]['node_parents'] = $node_parents;
      $nodes[$current_coordinates]['node_tag'] = $xsd_tag;
      $nodes[$current_coordinates]['xpath_query_children'] = $query_node . "$namespace:$xsd_tag" . "[" . ${$xsd_tag} . "]/";
      $nodes[$current_coordinates]['nesting_coordenates'] = $current_coordinates;
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

  function teste($query_node = '/', $nesting_coordenates_parents = FALSE) {
    $this->xsd_2_array();
    return $this->xsd_structure_array;
    // return $this->xpath_query();
    //return $this->xpath_query($query_node, $nesting_coordenates_parents);
  }
}
