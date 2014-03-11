<?php
/**
 * Contrutor do Documento Fiscal Eletrônico.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp;

/**
 * Classe para construir o Documento Fiscal Eletrônico.
 */
class MakeDFe {

  /**
   * Tipo da entrada de dados. Arquivo XML.
   */
  const ARQUIVO_INPUT_EXTENSAO_XML = 1;

  /**
   * Tipo da entrada de dados. Arquivo TXT.
   */
  const ARQUIVO_INPUT_EXTENSAO_TXT = 2;

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
   * Tipo de entrada de dados. 
   */
  private $extensao_do_arquivo_input;

  /**
   * Layout do DFe a ser gerado. 
   */
  private $layout_do_dfe;
  
  /**
   * Array com os dados estruturados do DFe sendo gerado.
   */
  private $array_do_dfe;

  /**
   * XML do DFe sendo gerado.
   */
  private $xml_do_dfe;

  /**
   * XML do DFe sendo gerado.
   */
  private $txt_do_dfe;

  /**
   * Caminho físico da biblioteca.
   */
  private $path_das_pastas_dfe;

  /**
   * Nome do arquivo que contém/conterá o DFe.
   */
  private $nome_do_arquivo;

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
    $this->path_das_pastas_dfe = $this->get_path_to('arquivosDfe');
  }

  private function transforma_array2xml() {
    
  }

  private function transforma_array2txt() {
    
  }

  /**
   * Lê arquivo TXT e extrai conteúdo.
   *
   * @param String $nome_do_arquivo
   *   Nome do arquivo a ser lido.
   *
   * @param String $path
   *   Caminho físico do diretório onde o arquivo está arquivado.
   */
  private function transforma_txt2array() {
    $path_das_pastas_dfe = $this->path_das_pastas_dfe;
    $nome_do_arquivo = $this->nome_do_arquivo;

    $handle = fopen($path_das_pastas_dfe . DIRECTORY_SEPARATOR . $nome_do_arquivo, "r");
    if ($handle) {
      $txt = array();
      $primeiro_loop = TRUE;
      $segundo_loop = TRUE;
      $qtde_dfe = 0;
      $dfe_seq = 0;
      
      while (($linha = fgets($handle)) !== false) {
        $linha_explode = explode('|', $linha);
        
        if($primeiro_loop) {
          $qtde_dfe = $linha_explode[1];

          $txt['config'] = array(
            'qtde_dfe' => $linha_explode[1],
            'tag_1a_linha' => $linha_explode[0],
          );
          $primeiro_loop = FALSE;
        }
        else {
          if ($segundo_loop) {
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

          $txt["dfe_$dfe_seq"]["linha_$num_linha"] = $linha_explode;
          $num_linha += 1;
        }
      }
    }
    $this->txt_do_dfe = $txt;
  }

  private function transforma_txt2xml() {
    
  }

  private function transforma_xml2array() {
    
  }

  private function transforma_xml2txt() {
    
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
  private function get_path_to($file_path = '') {
    $lib_path = DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
    return realpath(__DIR__ . $lib_path . $file_path);
  }



  public function test() {

    echo "<pre>";

    $nome_do_arquivo = 'REGISTROSCTE.txt';


  }
  
  /**
   * Define nova localização física da pasta contendo os DFe(s).
   *
   * @param String $novo_path
   *   Caminho físico da pasta pai onde ficam armazenadas as pastas que contém
   *   os arquivos dos DFe.
   */
  public function set_path_das_pastas_dfe($novo_path) {
    $this->path_das_pastas_dfe = $novo_path;
  }

  /**
   * Envia array com os dados do(s) DFe(s).
   *
   * @param Array $data_input
   *   Array estruturada com os dados do(s) DFe(s).
   */
  public function set_dfe_data_input($data_input) {
    $this->data_input = $data_input;
  }

  /**
   * Envia a localização do arquivo que contém o(s) DFe(s).
   *
   * @param String $nome_do_arquivo
   *   Nome do arquivo que contém os dados do(s) DFe(s).
   */
  public function set_dfe_file_input($nome_do_arquivo) {
    $this->nome_do_arquivo = $nome_do_arquivo;

    $extensao = explode('.', $nome_do_arquivo);
    $extensao = strtolower($extensao[1]);

    switch($extensao) {
      case self::ARQUIVO_INPUT_EXTENSAO_TXT:
        $this->extensao_do_arquivo_input = self::ARQUIVO_INPUT_EXTENSAO_TXT;
      break;
      case self::ARQUIVO_INPUT_EXTENSAO_XML:
        $this->extensao_do_arquivo_input = self::ARQUIVO_INPUT_EXTENSAO_XML;
      break;
    }
  }
}
