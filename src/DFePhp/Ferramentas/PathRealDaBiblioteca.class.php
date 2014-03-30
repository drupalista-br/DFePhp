<?php
/**
 * Arquivo que contém a classe PathRealDaBiblioteca em Ferramentas.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp\Ferramentas;

/**
 * Classe para definir o path real raiz desta biblioteca.
 */
class PathRealDaBiblioteca {

  /**
   * Endereço do caminho físico onde a biblioteca está guardada.
   */
  private $path_raiz;

  /**
   * Constroi o caminho físico onde a biblioteca está guardada.
   *
   * @param String $file_path
   *   Caminho interno da biblioteca. Opcionalmente poderá também informar
   *   o nome do arquivo. Ex. 'arquivosDfe/txts/NF25.txt'
   *
   * @return String
   *   O caminho físico da biblioteca + $file_path.
   */
  public function __construct() {
    $backwards = DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
    $this->path_raiz = realpath(__DIR__ . $backwards);
  }

  /**
   * Determina o caminho físico onde esta biblioteca esta guardada.
   *
   * @return String
   *   O endereço do caminho físico no sistema de arquivos.
   */
  public static function get_path_raiz() {
    self::__construct();
    return $this->path_raiz;
  }

  /**
   * Pega o endereço do caminho físico desta biblioteca e adiciona
   * subpastas/arquivos ao endereço.
   *
   * @param Array $subcaminhos
   *   Lista de subpastas/arquivos a serem incrementados ao endereço
   *   físico desta biblioteca.
   * @return String
   *   O endereço do caminho físico completo mais a(s) subpasta(s)/arquivo(s)
   *   enviado como argumento.
   *
   * @todo Throw exception quando $subcaminhos não for enviado ou nao for array.
   */
  public static function mais($subcaminhos) {
    self::__construct();

    // Inicia com caminho raiz.
    $caminho_completo = $this->path_raiz;
    foreach ($subcaminhos as $subcaminho) {
      $caminho_completo .= DIRECTORY_SEPARATOR . $subcaminho;
    }

    return $caminho_completo;
  }
}
