<?php
/**
 * Arquivo que contém a classe Constantes em Ferramentas.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp\Ferramentas;

/**
 * Classe para declarar todas as constantes usadas nesta biblioteca.
 */
class Constantes {
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
  const PASTA_XML_NAO_ASSINADOS = '1_xml_sem_assinaturas';

  /**
   * Pasta para armazenar os arquivos XMLs somente assinados.
   */
  const PASTA_XML_ASSINADOS = '2_xml_assinados';

  /**
   * Pasta para armazenar os arquivos XMLs Autorizados.
   */
  const PASTA_XML_AUTORIZADOS = '3_xml_autorizados';

  /**
   * Pasta para armazenar os arquivos XMLs NÃO Autorizados.
   */
  const PASTA_XML_NAO_AUTORIZADOS = '4_xml_nao_autorizados';

  /**
   * Pasta para armazenar os arquivos XMLs Cancelados.
   */
  const PASTA_XML_CANCELADOS = '5_xml_cancelados';
}