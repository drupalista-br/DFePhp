<?php
/**
 * Contrutor de Documento Fiscal Eletrônico Específico.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp\LayoutDeDados\VersoesDosLayouts;

use DFePhp\LayoutDeDados\LayoutDeDados;

/**
 * Classe para construir o Documento Fiscal Eletrônico.
 */
class NFe500 extends LayoutDeDados {
  public function __construct() {
    return array(
      'webservices' => array(
        'homologacao' => array(),
        'producao' => array(),
      ),
      // A partir da página 148.
      'layout_dos_dados' => array(
        array(
          'tag_txt_cabecalho' => FALSE,
          'descricao_do_manual' => 'TAG raiz da NF-e',
          'ocorrencia' => '1-1',
          'tag_xml' => 'NFe',
          'valor' => FALSE,
          'atributos' => array(
            'xmlns' => array(
              'valor_padrao' => 'http://www.portalfiscal.inf.br/nfe',
              'requerido' => FALSE,
              'tipo' => 'URL',
              'tamanho' => '255',
              'casas_decimais' => FALSE,
              'metodos_antes' => FALSE,
              'metodos_depois' => FALSE,
              'descricao_do_manual' => 'TAG raiz da NF-e',
            ),
          ),
          'tag_xml_parentes' => FALSE,
          'tag_xml_da_linha_txt' => FALSE,
        ),
        array(
          // Linha 1.
          'tag_txt_cabecalho' => 'A',
          'descricao_do_manual' => 'Grupo que contém as informações da NF-e',
          'ocorrencia' => '1-1',
          'tag_xml' => 'infNFe',
          'valor' => FALSE,
          'atributos' => array(
            // Linha 2.
            'versao' => array(
              'valor_padrao' => '2.00',
              'requerido' => FALSE,
              'tipo' => 'N',
              'tamanho' => '1-4',
              'casas_decimais' => 2,
              'metodos_antes' => FALSE,
              'metodos_depois' => FALSE,
              'descricao_do_manual' => 'Versão do leiaute (v2.0)',
            ),
            // Linha 3.
            'Id' => array(
              'valor_padrao' => '',
              'requerido' => TRUE,
              'tipo' => 'C',
              'tamanho' => '47',
              'casas_decimais' => FALSE,
              'metodos_antes' => FALSE,
              'metodos_depois' => FALSE,
              'descricao_do_manual' => 'informar a chave de acesso da NF-e precedida do literal ‘NFe’, acrescentada ' .
                                        'a validação do formato (v2.0).',
            ),
          ),
          'tag_xml_parentes' => array('NFe'),
          'tag_xml_da_linha_txt' => FALSE,
        ),
        // Linha 5.
        array(
          'tag_txt_cabecalho' => 'B',
          'descricao_do_manual' => 'Grupo das informações de identificação da NF-e',
          'ocorrencia' => '1-1',
          'tag_xml' => 'ide',
          'valor' => FALSE,
          'atributos' => FALSE,
          'tag_xml_parentes' => array('NFe', 'infNFe'),
          'tag_xml_da_linha_txt' => array(
            // Linha 6.
            'cUF' => array(
              'descricao_do_manual' => 'Código da UF do emitente do Documento Fiscal. Utilizar a ' .
                                       'Tabela do IBGE de código de unidades da federação (Anexo ' .
                                       'IV - Tabela de UF, Município e País).',
              'ocorrencia' => '1-1',
              'valor' => array(
                'valor_padrao' => '',
                'requerido' => TRUE,
                'tipo' => 'N',
                'tamanho' => '2',
                'casas_decimais' => FALSE,
                'metodos_antes' => FALSE,
                'metodos_depois' => array(
                  array(
                    'class' => 'Validacoes',
                    'metodo_ou_funcao' => array(
                      'nome'=> 'is_ibge_unidade_uf_numerico',
                      'chamada' => self::CHAMADA_ESTATICA,
                      'parametros' => '',
                    ),
                  ),
                ),
              ),
              'atributos' => FALSE,
              'tag_xml_parentes' => array('NFe', 'infNFe', 'ide'),
            ),
            // Linha 7.
            'cNF' => array(
              'descricao_do_manual' => 'Código numérico que compõe a Chave de Acesso. Número aleatório ' .
                                        'gerado pelo emitente para cada NF-e para evitar acessos indevidos ' .
                                        'da NF-e.(v2.0)',
              'ocorrencia' => '1-1',
              'valor' => array(
                'valor_padrao' => '',
                'requerido' => TRUE,
                'tipo' => 'N',
                'tamanho' => '8',
                'casas_decimais' => FALSE,
                'metodos_antes' => FALSE,
                'metodos_depois' => FALSE,
              ),
              'atributos' => FALSE,
              'tag_xml_parentes' => array('NFe', 'infNFe', 'ide'),
            ),
            // Linha 8.
            'NatOp' => array(
              'descricao_do_manual' => 'Informar a natureza da operação de que decorrer a ' .
                                        'saída ou a entrada, tais como: venda, compra, transferência, ' .
                                        'devolução, importação, consignação, remessa (para fins de demonstração, ' .
                                        'de industrialização ou outra), conforme previsto na alínea "i", inciso I, ' .
                                        'art. 19 do CONVÊNIO S/No, de 15 de dezembro de 1970.',
              'ocorrencia' => '1-1',
              'valor' => array(
                'valor_padrao' => 'VENDA DE MERCADORIA',
                'requerido' => self::OPCIONAL,
                'tipo' => 'C',
                'tamanho' => '1-60',
                'casas_decimais' => FALSE,
                'metodos_antes' => FALSE,
                'metodos_depois' => FALSE,
              ),
              'atributos' => FALSE,
              'tag_xml_parentes' => array('NFe', 'infNFe', 'ide'),
            ),
            // Linha 9.
            'intPag' => array(
              'descricao_do_manual' => 'Indicador da forma de pagamento: ' .
                                        '0 – pagamento à vista; ' .
                                        '1 – pagamento à prazo; ' .
                                        '2 – outros.',
              'ocorrencia' => '1-1',
              'valor' => array(
                'valor_padrao' => 0,
                'requerido' => self::OPCIONAL,
                'tipo' => 'N',
                'tamanho' => '1',
                'casas_decimais' => FALSE,
                'metodos_antes' => FALSE,
                'metodos_depois' => array(
                  'class' => 'Validacoes',
                  'metodo_ou_funcao' => array(
                    array(
                      'nome'=> 'regex',
                      'chamada' => self::CHAMADA_ESTATICA,
                      'parametros' => array(
                        'regex' => '^[0-2]{1}$',
                      ),
                    ),
                  ),
                ),
              ),
              'atributos' => FALSE,
              'tag_xml_parentes' => array('NFe', 'infNFe', 'ide'),
            ),
            'mod' => array(
              'descricao_do_manual' => 'Utilizar o código 55 para identificação da NF-e, emitida ' .
                                        'em substituição ao modelo 1 ou 1A.',
              'ocorrencia' => '1-1',
              'valor' => array(
                'valor_padrao' => '55',
                'requerido' => self::OPCIONAL,
                'tipo' => 'N',
                'tamanho' => '1',
                'casas_decimais' => FALSE,
                'metodos_antes' => FALSE,
                'metodos_depois' => FALSE,
              ),
              'atributos' => FALSE,
              'tag_xml_parentes' => array('NFe', 'infNFe', 'ide'),
            ),
            'serie' => array(
              'descricao_do_manual' => 'Série do Documento Fiscal, preencher com zeros na hipótese ' .
                                        'de a NF-e não possuir série. (v2.0) Série 890-899 de uso exclusivo ' .
                                        'para emissão de NF-e avulsa, pelo contribuinte com seu certificado ' .
                                        'digital, através do site do Fisco (procEmi=2). (v2.0) ' .
                                        'Serie 900-999 – uso exclusivo de NF-e emitidas no SCAN. (v2.0)',
              'ocorrencia' => '1-1',
              'valor' => array(
                'valor_padrao' => '',
                'requerido' => TRUE,
                'tipo' => 'N',
                'tamanho' => '1-3',
                'casas_decimais' => FALSE,
                'metodos_antes' => FALSE,
                'metodos_depois' => FALSE,
              ),
              'atributos' => FALSE,
              'tag_xml_parentes' => array('NFe', 'infNFe', 'ide'),
            ),
            'nNF' => array(
              'descricao_do_manual' => 'Número do Documento Fiscal.',
              'ocorrencia' => '1-1',
              'valor' => array(
                'valor_padrao' => '',
                'requerido' => TRUE,
                'tipo' => 'N',
                'tamanho' => '1-9',
                'casas_decimais' => FALSE,
                'metodos_antes' => FALSE,
                'metodos_depois' => FALSE,
              ),
              'atributos' => FALSE,
              'tag_xml_parentes' => array('NFe', 'infNFe', 'ide'),
            ),
            'dEmi' => array(
              'descricao_do_manual' => 'Data de emissão do Documento Fiscal',
              'ocorrencia' => '1-1',
              'valor' => array(
                'valor_padrao' => '',
                'requerido' => TRUE,
                'tipo' => 'D',
                'tamanho' => '10',
                'casas_decimais' => FALSE,
                'metodos_antes' => FALSE,
                'metodos_depois' => FALSE,
              ),
              'atributos' => FALSE,
              'tag_xml_parentes' => array('NFe', 'infNFe', 'ide'),
            ),
            'dSaiEnt' => array(
              'descricao_do_manual' => 'Data de Saída ou da Entrada da Mercadoria/Produto',
              'ocorrencia' => '0-1',
              'valor' => array(
                'valor_padrao' => '',
                'requerido' => FALSE,
                'tipo' => 'D',
                'tamanho' => '10',
                'casas_decimais' => FALSE,
                'metodos_antes' => FALSE,
                'metodos_depois' => FALSE,
              ),
              'atributos' => FALSE,
              'tag_xml_parentes' => array('NFe', 'infNFe', 'ide'),
            ),
            'hSaiEnt' => array(
              'descricao_do_manual' => 'Hora de Saída ou da Entrada da Mercadoria/Produto',
              'ocorrencia' => '0-1',
              'valor' => array(
                'valor_padrao' => '',
                'requerido' => FALSE,
                'tipo' => 'H',
                'tamanho' => '8',
                'casas_decimais' => FALSE,
                'metodos_antes' => FALSE,
                'metodos_depois' => FALSE,
              ),
              'atributos' => FALSE,
              'tag_xml_parentes' => array('NFe', 'infNFe', 'ide'),
            ),
            'tpNF' => array(
              'descricao_do_manual' => 'Tipo de Operação',
              'ocorrencia' => '1-1',
              'valor' => array(
                'valor_padrao' => '',
                'requerido' => FALSE,
                'tipo' => 'N',
                'tamanho' => '1',
                'casas_decimais' => FALSE,
                'metodos_antes' => FALSE,
                'metodos_depois' => array(
                  'class' => 'Validacoes',
                  'metodo_ou_funcao' => array(
                    array(
                      'nome'=> 'regex',
                      'chamada' => self::CHAMADA_ESTATICA,
                      'parametros' => array(
                        'regex' => '^[0-1]{1}$',
                      ),
                    ),
                  ),
                ),
              ),
              'atributos' => FALSE,
              'tag_xml_parentes' => array('NFe', 'infNFe', 'ide'),
            ),
            'cMunFG' => array(
              'descricao_do_manual' => 'Informar o município de ocorrência do fato gerador do ICMS. ' .
                                        'Utilizar a Tabela do IBGE (Anexo IX - Tabela de UF, Município ' .
                                        'e País',
              'ocorrencia' => '1-1',
              'valor' => array(
                'valor_padrao' => '',
                'requerido' => FALSE,
                'tipo' => 'N',
                'tamanho' => '7',
                'casas_decimais' => FALSE,
                'metodos_antes' => FALSE,
                'metodos_depois' => array(
                  'class' => 'Validacoes',
                  'metodo_ou_funcao' => array(
                    array(
                      'nome'=> 'is_ibge_cod_municipio',
                      'chamada' => self::CHAMADA_ESTATICA,
                      'parametros' => '',
                    ),
                  ),
                ),
              ),
              'atributos' => FALSE,
              'tag_xml_parentes' => array('NFe', 'infNFe', 'ide'),
            ),
          ),
        ),
        array(
          'tag_txt_cabecalho' => 'B13',
          'descricao_do_manual' => 'Grupo com as informações das NF/NF-e /NF de produtor/ Cupom Fiscal ' .
                                    'referenciadas. Esta informação será utilizada nas hipóteses ' .
                                    'previstas na legislação. (Ex.: Devolução de Mercadorias, Substituição ' .
                                    'de NF cancelada, Complementação de NF, etc.). (v.2.0)',
          'ocorrencia' => '0-N',
          'tag_xml' => 'NFref', // B12a
          'valor' => FALSE,
          'atributos' => FALSE,
          'tag_xml_parentes' => array('NFe', 'infNFe', 'ide'),
          'tag_xml_da_linha_txt' => array(
            'refNFe' => array(
              'descricao_do_manual' => 'Utilizar esta TAG para referenciar uma Nota Fiscal Eletrônica emitida ' .
                                        'anteriormente, vinculada a NF-e atual.',
              'ocorrencia' => '1-1',
              'valor' => array(
                'valor_padrao' => '',
                'requerido' => TRUE,
                'tipo' => 'N',
                'tamanho' => '44',
                'casas_decimais' => FALSE,
                'metodos_antes' => FALSE,
                'metodos_depois' => FALSE,
              ),
              'atributos' => FALSE,
              'tag_xml_parentes' => array('NFe', 'infNFe', 'ide', 'NFref'),
            ),
          ),
        ),
        array(
          // Linha 18.
          'tag_txt_cabecalho' => 'B14',
          'descricao_do_manual' => 'Grupo de informação da NF modelo 1/1A referenciada',
          'ocorrencia' => '1-1',
          'tag_xml' => 'refNF',
          'valor' => FALSE,
          'atributos' => FALSE,
          'tag_xml_parentes' => array('NFe', 'infNFe', 'ide', 'NFref'),
          'tag_xml_da_linha_txt' => array(
            // Linha 19.
            'cUF' => array(
              'descricao_do_manual' => 'Utilizar a Tabela do IBGE (Anexo IX - Tabela de UF, Município e País)',
              'ocorrencia' => '1-1',
              'valor' => array(
                'valor_padrao' => '',
                'requerido' => TRUE,
                'tipo' => 'N',
                'tamanho' => '2',
                'casas_decimais' => FALSE,
                'metodos_antes' => FALSE,
                'metodos_depois' => FALSE,
              ),
              'atributos' => FALSE,
              'tag_xml_parentes' => array('NFe', 'infNFe', 'ide', 'NFref', 'refNF'),
            ),
            // Linha 20.
            'AAMM' => array(
              'descricao_do_manual' => 'Ano e Mês de emissão da NF-e',
              'ocorrencia' => '1-1',
              'valor' => array(
                'valor_padrao' => '',
                'requerido' => TRUE,
                'tipo' => 'N',
                'tamanho' => '4',
                'casas_decimais' => FALSE,
                'metodos_antes' => FALSE,
                'metodos_depois' => FALSE,
              ),
              'atributos' => FALSE,
              'tag_xml_parentes' => array('NFe', 'infNFe', 'ide', 'NFref', 'refNF'),
            ),
            // 
          ),
        ),
        
      ),
    );
  }
}
