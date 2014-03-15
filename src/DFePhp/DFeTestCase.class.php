<?php
/**
 * Customiza o \PHPUnit_Framework_TestCase.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp;

use DFePhp\MakeDFe;

/**
 * Classe para customizar o PHPUnit.
 */
abstract class DFeTestCase extends \PHPUnit_Framework_TestCase {

  public function DFe_set_up($layout = null) {
    if ($layout) {
      $this->DFe = new MakeDFe($layout);
      $this->ReflectionDFe = new \ReflectionObject($this->DFe);
    }
    
  }

  /**
   * Extrai o valor de propriedades privadas ou protegidas.
   *
   * @param String $nome_da_propriedade
   *   O nome da propriedade que contém o valor desejado.
   * @param Object $nome_do_objeto
   *   O nome da propriedade onde o Objeto Reflection foi instanciado.
   * @return AnyType
   *   O valor da propriedade em questão.
   */
  public function reflection_get_valor_da_propriedade($nome_da_propriedade, $nome_do_objeto) {
    $objeto = $this->$nome_do_objeto;

    $propriedade = $objeto->getProperty($nome_da_propriedade);
    // Caso a propriedade seja protegida ou privada.
    $propriedade->setAccessible(TRUE);
    return $propriedade->getValue($obj);
  }

  /**
   * Chama métodos privados ou protegidos.
   *
   * @param String $nome_do_metodo
   *   O nome do método a ser chamado.
   * @param Object $nome_do_objeto
   *   O nome da propriedade onde o objeto reflection foi instanciado.
   * @param Array $argumentos
   *   Lista de argumentos a serem enviados na chamada.
   * /
  public function reflection_chamar_metodo($nome_do_metodo, $nome_do_objeto, $argumentos = null) {
    $objeto = $this->$nome_do_objeto;

    $metodo = $objeto->getMethod($nome_do_metodo);
    // Caso a propriedade seja protegida ou privada.
    $metodo->setAccessible(TRUE);
    return $propriedade->getValue($obj);
  }*/

}

