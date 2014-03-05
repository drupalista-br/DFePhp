<?php
/**
 * Carregador Automático das Classes.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

spl_autoload_register(function($className) {
  $filename = str_replace(array('\\', '_'), DIRECTORY_SEPARATOR, $className) . '.php';
  $path = __DIR__ . "/src/" . $filename;
  if (is_file($path)) {
    include $path;
    return true;
  }
  return false;
});
