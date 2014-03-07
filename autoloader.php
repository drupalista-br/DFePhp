<?php
/**
 * Carregador Automático das Classes.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */
namespace DFePhp\AutoLoader;

/**
 * Namespace das classes que contém os Layouts de cada versão de DFe.
 */
const NS_VERSOES = 'DFePhp\\LayoutDeDados\\VersoesDosLayouts\\';

spl_autoload_register(function($className) {
  $filename = str_replace(array('\\', '_'), DIRECTORY_SEPARATOR, $className) . '.class.php';
  $path = __DIR__ . "/src/" . $filename;
  if (is_file($path)) {
    include $path;
    return true;
  }
  return false;
});
