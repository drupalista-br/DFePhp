<?php
/**
 * Contrutor do Documento Fiscal Eletrônico.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp;

use DFePhp\Exceptions\MakeDFeExceptions;

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
   * @param String $versao_do_layout
   *   Versão do Layout para gerar o DFe.
   */
  public function __construct($versao_do_layout = '') {
    try {
      $exception_error_message = FALSE;

      if (!empty($versao_do_layout) && is_string($versao_do_layout)) {
        $class_name = 'DFePhp\\LayoutDeDados\\VersoesDosLayouts\\' . $versao_do_layout;

        if (!class_exists($class_name, TRUE)) {
          $exception_error_message = "O Layout $versao_do_layout nao e' valido ou nao e' mais suportado.";
        }
      }
      else {
        $exception_error_message = "Voce nao informou a versao do Layout do DFe ou o informado nao e' uma string.";
      }

      if ($exception_error_message) {
        throw new \Exception($exception_error_message);
      }
      else {
        $this->layout_do_dfe = $class_name::layout();
      }
    }
    catch (\Exception $e) {
      echo $e->getMessage();
    }

    // Define o Path padrão onde os arquivos DFe ficarão armazenados.
    $this->output_path = $this->get_path_da_biblioteca('arquivosDfe');
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
  private function get_path_da_biblioteca($file_path = '') {
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
    $this->input_nome_do_arquivo = $input_nome_do_arquivo;

    $extensao = explode('.', $input_nome_do_arquivo);
    $extensao = strtolower($extensao[1]);

    switch($extensao) {
      case self::EXTENSAO_TXT:
        $this->input_extensao_do_arquivo = self::EXTENSAO_TXT;
      break;
      case self::EXTENSAO_XML:
        $this->input_extensao_do_arquivo = self::EXTENSAO_XML;
      break;
    }
  }

  /**
   * Lê e carrega os dados do DFe armazenado em arquivo TXT ou XML.
   */
  private function carrega_dados_do_arquivo() {
    // Instancia o Objeto para fazer Exception throws.
    $exception = new MakeDFeExceptions();
    // Checa se a propriedade $input_extensao_do_arquivo contém o valor
    // self::EXTENSAO_TXT.
    $exception->is_txt_input_extensao_do_arquivo($this);

    $input_extensao_do_arquivo = $this->input_extensao_do_arquivo;
    $input_path = $this->input_path;


    $input_nome_do_arquivo = $this->input_nome_do_arquivo;
    $conteudo_do_arquivo = fopen($input_path . DIRECTORY_SEPARATOR . $input_nome_do_arquivo, "r");

    switch($input_extensao_do_arquivo) {
      case self::EXTENSAO_TXT:
        $this->dados_dfe_txt = $conteudo_do_arquivo;
      break;
      case self::EXTENSAO_XML:
        $this->dados_dfe_xml = $conteudo_do_arquivo;
      break;
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
   */
  public function converte_txt2array() {
    // Abre o arquivo TXT e salva o conteúdo na propriedade $dados_dfe_txt.
    $this->carrega_dados_do_arquivo();

    // Instancia o Objeto para fazer Exception throws.
    $exception = new MakeDFeExceptions();
    // Checa se a propriedade $dados_dfe_txt está vazia.
    $exception->is_empty_dados_dfe_txt($this);

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
  }

  public function converte_xml2array() {
    
  }

  public function converte_xml2txt() {
    
  }

  /**
   * Busca o valor de $input_nome_do_arquivo.
   */
  public function get_input_nome_do_arquivo() {
    return $this->input_nome_do_arquivo;
  }

  /**
   * Busca o valor de $input_extensao_do_arquivo.
   */
  public function get_input_extensao_do_arquivo() {
    return $this->input_extensao_do_arquivo;
  }


  public function test() {
    echo "<pre>";
    //print_r($this->dados_dfe_txt);
  }
}
