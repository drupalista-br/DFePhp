<?php
/**
 * Arquivo que contém a classe MakeDFe.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp;

use DFePhp\Exceptions\MakeDFeExceptions;
use DFePhp\Exceptions\DFeInvalidArgumentException;
use DFePhp\Ferramentas\Constantes;
use DFePhp\Ferramentas\Arquivo;

/**
 * Classe para construir o Documento Fiscal Eletrônico.
 */
class MakeDFe {

  /**
   * TODO:
   */
  private $objeto_layout_dispatcher;
  
  /**
   * Array com os dados do DFe.
   */
  private $dados_dfe_array;

  /**
   * XML com os dados do DFe.
   */
  private $dados_dfe_xml;

  /**
   * TXT com os dados do DFe.
   */
  private $dados_dfe_txt;

  /**
   * Caminho físico da pasta pai onde são arquivados os DFe.
   */
  private $output_path;

  /**
   * Caminho físico da pasta do(s) arquivo(s) de entrada de dados dos DFe(s).
   */
  private $input_path;

  /**
   * Nome do arquivo que contém os dados de entrada do(s) DFe(s).
   */
  private $input_nome_do_arquivo;

  /**
   * Tipo de entrada de dados. 
   */
  private $input_extensao_do_arquivo;
  
  /**
   * Define a versão do layout da estrutura de dados do DFe.
   * 
   * @param String $tipo_dfe
   *   O tipo de Documento Fiscal Eletrônico.
   * @param String $versao_dfe
   *   A versão do Documento Fiscal Eletrônico.
   * @param String $versao_xsd
   *   A versão do Pacote de Liberação contendo os XSDs
   */
  public function __construct($tipo_dfe = null, $versao_dfe = null, $versao_xsd = null) {
    // Instancia os Objetos para fazer Exception throws.
    $InvalidArgumentException = new DFeInvalidArgumentException();
    $exception = new MakeDFeExceptions();

    // TODO:
    // InvalidArgumentException
    // Exception | Verificar se a $dispatcher existe.
    $dispatcher = "DFePhp\\Schemas\\$tipo_dfe\\Dispatcher$versao_dfe";

    $this->objeto_layout_dispatcher = new $dispatcher($tipo_dfe, $versao_dfe, $versao_xsd);

    // Define o Path padrão onde os arquivos DFe ficarão armazenados.
    $this->output_path = Arquivo::endereco(array(Constantes::PASTA_OUTPUTS));
  }

  /**
   * Define nova localização física da pasta contendo os DFe(s).
   *
   * @param String $novo_path
   *   Caminho físico da pasta pai onde ficam armazenadas as pastas que contém
   *   os arquivos dos DFe.
   */
  public function set_output_path($novo_path) {
    $this->output_path = $novo_path;
  }

  /**
   * Envia array com os dados do(s) DFe(s).
   *
   * @param Array $input_array
   *   Array estruturada com os dados do(s) DFe(s).
   */
  public function set_input_array($input_array) {
    $this->dados_dfe_array = $input_array;
  }

  /**
   * Envia o caminho da pasta onde estão o(s) arquivo(s) de entrada de dados.
   *
   * @param String $input_path
   *   Caminho da pasta.
   */
  public function set_input_path($input_path) {
    $this->input_path = $input_path;
  }

  /**
   * Envia o nome do arquivo que contém o(s) DFe(s).
   *
   * @param String $input_nome_do_arquivo
   *   Nome do arquivo que contém os dados do(s) DFe(s).
   */
  public function set_input_nome_do_arquivo($input_nome_do_arquivo) {
    // Instancia os Objetos para fazer Exception throws.
    $InvalidArgumentException = new DFeInvalidArgumentException();
    $exception = new MakeDFeExceptions();

    $this->input_nome_do_arquivo = $input_nome_do_arquivo;

    $extensao = strtolower(pathinfo($input_nome_do_arquivo, PATHINFO_EXTENSION));

    switch($extensao) {
      case Constantes::EXTENSAO_TXT:
        $this->input_extensao_do_arquivo = Constantes::EXTENSAO_TXT;
      break;
      case Constantes::EXTENSAO_XML:
        $this->input_extensao_do_arquivo = Constantes::EXTENSAO_XML;
      break;
    }
    // TODO:
    // Exception | Verificar se $input_extensao_do_arquivo não está vazio.
  }

  /**
   * Lê e carrega os dados do DFe armazenado em arquivo TXT ou XML.
   */
  public function carrega_dados_do_arquivo() {
    // Instancia o Objeto para fazer Exception throws.
    $exception = new MakeDFeExceptions();

    $input_extensao_do_arquivo = $this->input_extensao_do_arquivo;

    // Checa se o arquivo de entrada de dados existe.
    $exception->input_arquivo_existe($this);

    $input_path = $this->input_path;
    $input_nome_do_arquivo = $this->input_nome_do_arquivo;

    switch($input_extensao_do_arquivo) {
      case Constantes::EXTENSAO_TXT:
        $this->dados_dfe_txt = fopen($input_path . DIRECTORY_SEPARATOR . $input_nome_do_arquivo, "r");

        // Checa se a propriedade $dados_dfe_txt está vazia.
        $exception->is_empty_dados_dfe_txt($this);
      break;
      case Constantes::EXTENSAO_XML:
        $this->dados_dfe_xml = simplexml_load_file($input_path . DIRECTORY_SEPARATOR . $input_nome_do_arquivo);

        // Checa se a propriedade $dados_dfe_xml está vazia.
        $exception->is_empty_dados_dfe_xml($this);
      break;
      default:
        $mensagem = sprintf("A extensao do arquivo %s NAO e' TXT ou XML.", $input_nome_do_arquivo);
        $exception->_throw_exception($mensagem);
    }
  }

  public function converte_array2xml() {
    
  }

  public function converte_array2txt() {
    
  }

  public function converte_txt2xml() {
    
  }

  /**
   * Converte dados do DFe em TXT para Array.
   *
   * TODO: Criar tests | NFe500test
   */
  public function converte_txt2array() {
    // Instancia o Objeto para fazer Exception throws.
    $exception = new MakeDFeExceptions();

    // Abre o arquivo TXT e salva o conteúdo na propriedade $dados_dfe_txt.
    $this->carrega_dados_do_arquivo();

    $conteudo_do_arquivo = $this->dados_dfe_txt;
    if ($conteudo_do_arquivo) {
      $array = array();
      $primeiro_loop = TRUE;
      $segundo_loop = TRUE;
      // Quantidade de DFe(s) no arquivo TXT.
      $qtde_dfe = 0;
      // Contagem sequencial do(s) DFe(s).
      $dfe_seq = 0;

      while (($linha = fgets($conteudo_do_arquivo)) !== false) {
        $linha_explode = explode('|', $linha);

        if($primeiro_loop) {
          // Quantidade de DFe(s) no arquivo TXT.
          $qtde_dfe = $linha_explode[1];

          $array['config'] = array(
            'qtde_dfe' => $linha_explode[1],
            'tag_1a_linha' => $linha_explode[0],
          );
          $primeiro_loop = FALSE;
        }
        else {
          if ($segundo_loop) {
            // Define a tag cabeçalho da primeira linha de cada DFe.
            $tag_inicial = trim($linha_explode[0]);

            $segundo_loop = FALSE;
          }

          $tag_da_linha_atual = trim($linha_explode[0]);

          if ($tag_da_linha_atual == $tag_inicial) {
            // Inicia um novo DFe.
            $dfe_seq += 1;
            // Reinicia a numeração das linhas do DFe.
            $num_linha = 1;
          }

          $array["dfe_$dfe_seq"]["linha_$num_linha"] = $linha_explode;
          $num_linha += 1;
        }
      }
    }
    $this->dados_dfe_array = $array;

    // TODO: Checar Exception para dados_dfe_array;
  }

  public function converte_xml2array() {
    
  }

  public function converte_xml2txt() {
    
  }

  /**
   * TODO: Colocar na classe Validacoes.
   */
  private function validar_schema() {
    function libxml_display_error($error) {
        $return = "<br/>\n";
        switch ($error->level) {
            case LIBXML_ERR_WARNING:
                $return .= "<b>Warning $error->code</b>: ";
                break;
            case LIBXML_ERR_ERROR:
                $return .= "<b>Error $error->code</b>: ";
                break;
            case LIBXML_ERR_FATAL:
                $return .= "<b>Fatal Error $error->code</b>: ";
                break;
        }
        $return .= trim($error->message);
        if ($error->file) {
            $return .=    " in <b>$error->file</b>";
        }
        $return .= " on line <b>$error->line</b>\n";
    
        return $return;
    }
    
    function libxml_display_errors() {
        $errors = libxml_get_errors();
        foreach ($errors as $error) {
            print libxml_display_error($error);
        }
        libxml_clear_errors();
    }
    
    // Enable user error handling
    libxml_use_internal_errors(true);
    
    $xml = new DOMDocument(); 
    $xml->load('example.xml'); 
    
    if (!$xml->schemaValidate('example.xsd')) {
      print '<b>DOMDocument::schemaValidate() Generated Errors!</b>';
      libxml_display_errors();
    }
  }
}
