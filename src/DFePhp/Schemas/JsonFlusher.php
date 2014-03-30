<?php
/**
 * Gerar os arquivos Json contendo a array PHP dos layouts definidos pelos
 * arquivos XSD.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */
namespace DFePhp\Schemas;

$lib_path = realpath(__DIR__);
$lib_path .=  DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
include_once $lib_path . 'autoloader.php';

use DFePhp\Schemas\ConversorXsd2Json;

$JsonFlusher = new ConversorXsd2Json();


