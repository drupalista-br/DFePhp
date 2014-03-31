<?php
/**
 * Arquivo que contém a classe Arquivo em Ferramentas.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp\Ferramentas;

/**
 * Classe para manipular pastas e arquivos guardados nesta biblioteca.
 */
class Arquivo {
  /**
   * Constroi o caminho físico raiz de onde esta biblioteca está guardada.
   *
   * @return String
   *   O endereço do caminho físico da biblioteca.
   */
  static function raiz() {
    $backwards = DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..';
    return realpath(__DIR__ . $backwards);
  }

  /**
   * Pega o endereço do caminho físico desta biblioteca e adiciona
   * subpastas/arquivos ao endereço.
   *
   * @param Array $subcaminhos
   *   Lista de subpastas/arquivos a serem incrementados ao endereço
   *   físico desta biblioteca.
   * @param Bool $criar_pastas
   *   Cria a pasta ou arquivo caso não exista.
   * @param String $permission
   *   A permissão de acesso da pasta a ser criada. Padrão 0777.
   * @return String
   *   O endereço do caminho físico absoluto mais a(s) subpasta(s)/arquivo(s)
   *   enviado como argumento.
   *
   * @todo Throw exception quando $subcaminhos não for enviado ou nao for array.
   */
  static function endereco($subcaminhos = array(), $criar_pastas = FALSE, $permission = '0777') {
    $path_raiz = self::raiz();

    // Inicia com o caminho raiz da biblioteca.
    $caminho_completo = $path_raiz;
    foreach ($subcaminhos as $subcaminho) {
      $caminho_completo .= DIRECTORY_SEPARATOR . $subcaminho;
    }

    if ($criar_pastas) {
      // Pasta a ser criada.
      $pasta = $caminho_completo;

      // Verifica se o último elemento da array trata-se de um nome de arquivo.
      $pathinfo = pathinfo($caminho_completo);
      if (!empty($pathinfo['extension'])) {
        // Sendo o último elemento um nome de arquivo, então esse é excluido
        // do endereço para fique somente o endereço da pasta.
        $pasta = $pathinfo['dirname'];
      }
      
      if (!file_exists($pasta)) {
        mkdir($pasta, $permission, TRUE);
      }
    }

    return $caminho_completo;
  }
}

$test = '/opt/lampp/htdocs/sites/saturnopecas.com.br/libraries/DFePhp/src/DFePhp';

Arquivo::endereco('src/DFePhp/Ferramentas');
