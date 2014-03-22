<?php
/**
 * Arquivo com a classe DFeTestCase.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp;

use DFePhp\MakeDFe;
use DFePhp\Exceptions\MakeDFeExceptions;
use DFePhp\Ferramentas\Xsd2PhpArray;

/**
 * Classe para customizar o PHPUnit.
 */
abstract class DFeTestCase extends \PHPUnit_Framework_TestCase {

  /**
   * @param String $Dfe
   *   O nome do Documento Fiscal. Ex. NFe, CTe, NFCe, etc.
   * @param String $layout
   *   A do layout a ser utilizado.
   */
  public function MakeDFe_set_up($Dfe = null, $layout = null) {
    if ($Dfe && $layout) {
      $this->MakeDFe = new MakeDFe($Dfe, $layout);
      $this->MakeDFeReflection = new \ReflectionObject($this->DFe);
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
    return $propriedade->getValue($this->Xsd2PhpArray);
  }

  /**
   * Chama métodos privados ou protegidos.
   *
   * @param String $nome_do_metodo
   *   O nome do método a ser chamado.
   * @param Object $nome_do_objeto
   *   O nome da propriedade onde o objeto reflection foi instanciado.
   */
  public function reflection_get_metodo($nome_do_metodo, $nome_do_objeto) {
    $objeto = $this->$nome_do_objeto;

    $metodo = $objeto->getMethod($nome_do_metodo);
    // Caso a propriedade seja protegida ou privada.
    $metodo->setAccessible(TRUE);
    return $metodo;
  }

}

