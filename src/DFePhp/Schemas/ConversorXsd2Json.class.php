<?php
/**
 * Arquivo que contém a classe ConversorXsd2Json em Schemas.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */
namespace DFePhp\Schemas;

// A classe Xsd2PhpArray não está autoloading porque está em um namespace
// diferente. TODO: Ajustar o arquivo autoloader.php à fazer o autoload
// do NS Drupalista_br.
$lib_path = realpath(__DIR__);
$lib_path .=  DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
include_once $lib_path . 'Ferramentas/Xsd2PhpArray.class.php';

use Drupalista_br\Xsd2PhpArray;

/**
 *
 */
class ConversorXsd2Json {

}
