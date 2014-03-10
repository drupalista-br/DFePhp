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
   * Tipo da entrada de dados. Arquivo TXT ou XML.
   */
  const TIPO_INPUT_ARQUIVO = 1;

  /**
   * Tipo da entrada de dados. Array estruturada.
   */
  const TIPO_INPUT_ARRAY = 2;

  /**
   * Tipo de entrada de dados. 
   */
  private $tipo_de_input;

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
  private $path_dos_arquivos_dfe;

  /**
   * Nome do arquivo que contém/conterá o DFe.
   */
  private $nome_do_arquivo;

  /**
   * Define a versão do layout da estrutura de dados do DFe.
   * 
   * @param String $versao_do_layout
   *   Versão do Layout para gerar o DFe.
   *
   * @param Array/String $input_data
   *   Opcional:
   *   String | Nome do arquivo que contém a DFe.
   *   Array | Os dados da DFe.
   *
   * @param String $path_dos_arquivos_dfe
   *   Opcional: O caminho físico da pasta onde os arquivos DFe estão/serão armazenados.
   */
  public function __construct($versao_do_layout = '', $input_data = '', $path_dos_arquivos_dfe = '') {
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

    $this->input_datainput_data($input_data, $path_dos_arquivos_dfe);
  }

  /**
   *
   */
  private function set_input_data($input_data = '') {
    
    if (!empty($input_data)) {
      $this->input_data = $input_data;
    }

    if (is_string($this->input_data)) {
      $this->nome_do_arquivo = $input_data;
      $this->tipo_de_input = self::TIPO_INPUT_ARQUIVO;
    }
    else {
      $this->array_do_dfe = $input_data;
      $this->tipo_de_input = self::TIPO_INPUT_ARRAY;
    }

  }

  /**
   *
   */
  private function set_path_dos_arquivos_dfe($path_dos_arquivos_dfe = '') {
    // Define o Path padrão.
    $this->path_dos_arquivos_dfe = $this->get_path_to('arquivosDfe' . DIRECTORY_SEPARATOR . 'txts');

    if (!empty($path_dos_arquivos_dfe)) {
      $this->path_dos_arquivos_dfe = $path_dos_arquivos_dfe;
    }
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
    $path_dos_arquivos_dfe = $this->path_dos_arquivos_dfe;
    $nome_do_arquivo = $this->nome_do_arquivo;

    $handle = fopen($path_dos_arquivos_dfe . DIRECTORY_SEPARATOR . $nome_do_arquivo, "r");
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

  /**
   *
   *
   *
   * @param String $tipo_do_input
   *   array: A entrada de dados é uma array, assim será gerado o XML e o TXT.
   *   arquivo: A entrada de dados é um arquivo ( TXT ou XML ).
   */
  public function entrada_de_dados($input_data, $path_dos_arquivos_dfe = '') {

    switch($this->tipo_de_input) {
      case self::TIPO_INPUT_ARQUIVO:
        $extensao = explode('.', $input_data);
        $extensao = strtolower($extensao[1]);
  
        switch($extensao) {
          case 'txt':
            $this->transforma_txt2array();
          break;
          case 'xml':
            $this->transforma_txt2xml();
          break;
        }
      break;
      case self::TIPO_INPUT_ARRAY:
        
      break;
    }
  }



  public function test() {

    echo "<pre>";

    $nome_do_arquivo = 'REGISTROSCTE.txt';

    $this->transforma_txt2array($nome_do_arquivo);

    print_r($this->txt_do_dfe);


    return $this->layout_do_dfe;
  }
}
