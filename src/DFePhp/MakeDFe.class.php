<?php
/**
 * Arquivo que contém a classe \DFePhp\MakeDFe.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp;

use DFePhp\Exceptions\MakeDFeExceptions;
use DFePhp\Exceptions\DFeInvalidArgumentException;

/**
 * Classe para construir o Documento Fiscal Eletrônico.
 */
class MakeDFe {

  /**
   * Extensão dos arquivos XML.
   */
  const EXTENSAO_XML = 'xml';

  /**
   * Extensão dos rquivos TXT.
   */
  const EXTENSAO_TXT = 'txt';

  /**
   * Pasta para armazenar os arquivos TXT dos DFe.
   */
  const PASTA_TXTS = 'txts';

  /**
   * Pasta para armazenar os arquivos XMLs sem assinaturas.
   */
  const PASTA_1_XML_NAO_ASSINADOS = '1_xml_sem_assinaturas';

  /**
   * Pasta para armazenar os arquivos XMLs somente assinados.
   */
  const PASTA_2_XML_ASSINADOS = '2_xml_assinados';

  /**
   * Pasta para armazenar os arquivos XMLs Autorizados.
   */
  const PASTA_3_XML_AUTORIZADOS = '3_xml_autorizados';

  /**
   * Pasta para armazenar os arquivos XMLs NÃO Autorizados.
   */
  const PASTA_4_XML_NAO_AUTORIZADOS = '4_xml_nao_autorizados';

  /**
   * Pasta para armazenar os arquivos XMLs Cancelados.
   */
  const PASTA_5_XML_CANCELADOS = '5_xml_cancelados';

  /**
   * Nome da classe que gera o Layout do DFe.
   */
  private $classe_do_schema;

  /**
   * Layout do DFe a ser gerado. O Layout é definido por uma sub-classe da
   * classe LayoutDeDados.
   */
  private $layout_do_dfe;
  
  /**
   * Array com os dados do DFe sendo gerado.
   */
  private $dados_dfe_array;

  /**
   * XML do DFe sendo gerado.
   */
  private $dados_dfe_xml;

  /**
   * TXT do DFe sendo gerado.
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
   * @param String $schema
   *   Versão do Layout para gerar o DFe.
   */
  public function __construct($DFe = null, $schema = null) {
    // Instancia os Objetos para fazer Exception throws.
    $InvalidArgumentException = new DFeInvalidArgumentException();
    $exception = new MakeDFeExceptions();

    // TODO:
    // InvalidArgumentException | Verificar se $schema está vazio
    //                            Verificar se $schema não é uma string.
    // Exception | Verificar se a $classe_do_schema existe.
    $this->classe_do_schema = $classe_do_schema = "DFePhp\\Schemas\\$DFe\\$schema";

    
      if (!empty($schema) && is_string($schema)) {

        if (!class_exists($classe_do_schema, TRUE)) {
          $exception_error_message = "O Layout $schema nao e' valido ou nao e' mais suportado.";
        }
      }
      else {
        $exception_error_message = "Voce nao informou a versao do Layout do DFe ou o informado nao e' uma string.";
      }

    $this->layout_do_dfe = $classe_do_schema::layout();

    // TODO:
    // Exception | Verificar se $layout_do_dfe é uma array não vazia.

    // Define o Path padrão onde os arquivos DFe ficarão armazenados.
    $this->output_path = $this->get_path_da_biblioteca('DFe_outputs');
  }

  /**
   * Constroi o caminho físico onde a biblioteca está instalada.
   *
   * @param String $file_path
   *   Caminho interno da biblioteca. Opcionalmente poderá também informar
   *   o nome do arquivo. Ex. 'arquivosDfe/txts/NF25.txt'
   *
   * @return String
   *   O caminho físico da biblioteca + $file_path.
   */
  public function get_path_da_biblioteca($file_path = '') {
    $lib_path = DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
    return realpath(__DIR__ . $lib_path . $file_path);
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
      case self::EXTENSAO_TXT:
        $this->input_extensao_do_arquivo = self::EXTENSAO_TXT;
      break;
      case self::EXTENSAO_XML:
        $this->input_extensao_do_arquivo = self::EXTENSAO_XML;
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
      case self::EXTENSAO_TXT:
        $this->dados_dfe_txt = fopen($input_path . DIRECTORY_SEPARATOR . $input_nome_do_arquivo, "r");

        // Checa se a propriedade $dados_dfe_txt está vazia.
        $exception->is_empty_dados_dfe_txt($this);
      break;
      case self::EXTENSAO_XML:
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
    function libxml_display_error($error)
    {
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

  public function test() {
    echo "<pre>";
    //print_r($this->dados_dfe_txt);
  }
}
