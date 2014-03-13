<?php
/**
 * Constroi a mensagem de error para argumentos inválidos.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp\Exceptions;

class NonIntegerException extends \InvalidArgumentException {
  public function __construct($method, $argument, $value) {
    parent::__construct(
      sprintf('%s requer que %s seja um integer, o valor enviado foi %s.', $method, $argument, gettype($value))
    );
  }
}
