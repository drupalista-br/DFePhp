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
  public $xsd_php_array = array();

  /**
   * Xsd content once 
   */
  private $xsd_content;

  /**
   * The Schema Namespace on which xpath queries will be carried out.
   */
  private $xsd_namespace = 'xs';

  /**
   * A list of XSD tags to be ignored by the get_xsd_node_children() method.
   */
  private $filter_out_by_tag_name = array();

  /**
   * A list of XSD tags to be ignored by the get_xsd_node_children() method only on
   * specified nesting_coordenates.
   */
  private $filter_out_by_nesting_coordenates = array();

  /**
   * Iterates throgh the xsd content nodes generating a php array along the
   * way.
   *
   * @param Array $array
   *   List of children nodes of a single xsd element node.
   */
  public function xsd_2_array($array = FALSE) {

    if ($array === FALSE) {
      // This is the kick off call.
      $array = $this->get_xsd_node_children();
      $this->xsd_php_array = $array;
    }

    foreach ($array as $nesting_coordenates => $node) {
      // Get the grandparents.
      $this_lineage_parents = $array[$nesting_coordenates]['node_parents'];
      // Add the parent.
      $this_lineage_parents[] = array(
        'tag' => $array[$nesting_coordenates]['node_tag'],
        'element_sequence' => $array[$nesting_coordenates]['element_sequence'],
        'nesting_coordenates' => $nesting_coordenates,
      );

      // $query_node.
      $query_node[$nesting_coordenates] = $node['xpath_query_children'];
      // $nesting_coordenates_parents.
      $nesting_coordenates_parents[$nesting_coordenates] = $node['nesting_coordenates'];

      $array_children = $this->get_xsd_node_children($query_node[$nesting_coordenates], $nesting_coordenates_parents[$nesting_coordenates], $this_lineage_parents);

      if (!empty($array_children)) {
        // Tell parent node "You're a daddy!"
        $children = array();
        foreach($array_children as $node_child_coordinates => $node_child) {
          $children[] = array(
            'tag' => $node_child['node_tag'],
            'element_sequence' => $node_child['element_sequence'],
            'nesting_coordenates' => $node_child['nesting_coordenates'],
          );
        }
        $this->xsd_php_array[$nesting_coordenates]['node_children'] = $children;

        $xsd_php_array = $this->xsd_php_array;
  
        $this->xsd_php_array = array_merge($xsd_php_array, $array_children);

        self::xsd_2_array($array_children);
      }
    }
  }

  /**
   * Get the children of a given XSD element node.
   *
   * @param String $query_node
   *   The xpath query address of the node to be searched.
   * @param String $nesting_coordenates_parents
   *   The parent's nesting coordinates of the current node.
   * @param Array $node_parents
   *   A list tags representing the lineage of the current element node.
   * @return Array
   *   The children nodes of the specified XSD element node.
   */
  private function get_xsd_node_children($query_node = '/', $nesting_coordenates_parents = FALSE, $node_parents = FALSE) {
    if (empty($this->xsd_content)) {
      throw new \Exception("The XSD content has not been loaded. You must beforehand call \$myObject->load_xsd_content('/xsd/location/file.xsd').");
    }

    $xsd = $this->xsd_content;
    $namespace = $this->xsd_namespace;

    $xpath_query = $xsd->xpath("$query_node*");

    $nodes = array();

    foreach ($xpath_query as $key => $node) {
      $xsd_tag = $node->getName();

      // Check if current xsd tag is listed for being filtered out.
      if(in_array($xsd_tag, $this->filter_out_by_tag_name)) {
        continue;
      }

      $node_array = (array) $node;

      // ${$xsd_tag} holds the per xsd tag element sequencing number.
      if(empty(${$xsd_tag})) {
        ${$xsd_tag} = 0;
      }
      ${$xsd_tag} += 1;

      // $item_sequence holds the sequencing number of all xsd elements
      // regardless of they having different tags.
      $item_sequence = $key + 1;

      $nesting_separator = '-';
      if (!$nesting_coordenates_parents) {
        $nesting_separator = '';
      }

      // The nesting coordinate address of the current XSD node.
      $current_coordinates = $nesting_coordenates_parents . $nesting_separator . $item_sequence;

      // Check if current node nesting coordinates is listed for being filtered
      // out.
      if(in_array($current_coordinates, $this->filter_out_by_nesting_coordenates)) {
        continue;
      }

      $nodes[$current_coordinates] = array (
        'node_values' => $node_array,
        'node_tag' => $xsd_tag,
        'element_sequence' => ${$xsd_tag},
        // Concatenate the last ran xpath query with ns:nodetag[elementsequence]/
        'xpath_query_children' => $query_node . "$namespace:$xsd_tag" . "[" . ${$xsd_tag} . "]/",
        'nesting_coordenates' => $current_coordinates,
        'node_parents' => $node_parents,
        'node_children' => FALSE,
      );
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

  /**
   * Informs a list of XSD tags which will be ignored by the get_xsd_node_children()
   * method.
   *
   * @param Array $tags
   *   An list of XSD tags.
   */
  public function set_filter_out_by_tag_name($tags) {
    $this->filter_out_by_tag_name = $tags;
  }

  /**
   * Informs a list of XSD tags which will be ignored by the get_xsd_node_children()
   * method only on specified nesting_coordenates.
   *
   * @param Array $tags
   *   An list of XSD tags keyed with nesting_coordenates.
   */
  public function set_filter_out_by_nesting_coordenates($tags) {
    $this->filter_out_by_nesting_coordenates = $tags;
  }

  /**
   * Returns the XSD content arranged as an array.
   *
   * @return Array
   *   The generated array from the xsd content.
   */
  public function get_xsd_php_array() {
    return $this->xsd_php_array;
  }
}
