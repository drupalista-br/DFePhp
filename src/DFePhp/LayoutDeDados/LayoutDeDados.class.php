<?php
/**
 * Comporta os layout da entrada de dados de cada Tipo de Documento Fiscal
 * Eletrônico.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp\LayoutDeDados;

/**
 * Classe para criar os Layouts de Entrada de Dados dos DFe.
 */
class LayoutDeDados {
  /**
   * Quando o valor de entrada é requerido mas, caso não seja enviado, o valor
   * padrão será usado.
   */
  const OPCIONAL = 2;

  /**
   * O método informado em 'metodos_antes' ou 'metodos_depois' será chamado de
   * forma estática.
   */
  const CHAMADA_ESTATICA = 1;

  /**
   * O método informado em 'metodos_antes' ou 'metodos_depois' será chamado de
   * forma normal após a instanciação do objeto.
   */
  const CHAMADA_NORMAL = 2;

  /**
   * Layout do DFe a ser gerado. 
   */
  protected $layout_escolhido;

  /**
   * Seleciona a estrutura de dados do documento fiscal a ser gerado.
   *
   * @param String $versao
   *   A versão do manual de integração do DFe desejado.
   * @return Array
   *   O layout da estrutura de dados de um DFe específico.
   */
  protected function seleciona_layout() {

    $estrutura_dos_documentos_fiscais = [

      'CTe_2.0.0' => [
        'documentacao' => '',
        'webservices' => [
          // TODO.
        ],
        'estrutura_de_dados' => [
          // TODO.
        ],
      ],
    ];

    $this->layout_escolhido = $estrutura_dos_documentos_fiscais;
    
    
  $class = new \ReflectionClass($this);
  $methods = $class->getMethods(\ReflectionMethod::IS_PRIVATE);
  echo '<pre>';
  print_r($methods);
  print_r(get_declared_classes());
    
  }

  /**
   * 
   */
  private function NFe_5() {
    return array(
      'NFe_5.0.0' => array(
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
      ),
    );
  }
  
  /**
   * 
   */
  private function CTe_2() {
  
  }

}

/*
        B|cUF|cNF|||||||||||TpImp|TpEmis|cDV|tpAmb|finNFe|procEmi|VerProc|dhCont|xJust|
          [0 a N] {
            [seleção entre  ou B14 ou B20a ou B20i ou B20j] {
              
              [ou]
              
              B14|cUF|AAMM(ano mês)|CNPJ|Mod|serie|nNF|
    
              [ou]
              
              B20a|cUF|AAMM|IE|mod|serie|nNF|
                [seleção entre B20d ou B20e] {
                  B20d|CNPJ|
  
                  [ou]
  
                  B20e|CPF|
                }
                
              [ou]
    
              B20i|refCTe|
    
              [ou]
    
              B20j|mod|nECF|nCOO|
            }
          }
        C|XNome|XFant|IE|IEST|IM|CNAE|CRT|
          [seleção entre C02 ou C02a] {
            C02|CNPJ|
            
            [ou]
            
            C02a|CPF|
          }
          C05|XLgr|Nro|Cpl|Bairro|CMun|XMun|UF|CEP|cPais|xPais|fone|
        [0 ou 1] {
          D|CNPJ|xOrgao|matr|xAgente|fone|UF|nDAR|dEmi|vDAR|repEmi|dPag|
        }
        E|xNome|IE|ISUF|email|
          [seleção entre E02 ou E03] {
            E02|CNPJ|
    
            [ou]
            
            E03|CPF|
          }
          E05|xLgr|nro|xCpl|xBairro|cMun|xMun|UF|CEP|cPais|xPais|fone|
        [0 ou 1] {
          F|CNPJ|XLgr|Nro|XCpl|XBairro|CMun|XMun|UF|
            [seleção entre F02 ou F02a] {
              F02|CNPJ
    
              [ou]
    
              F02a|CPF
            }
        }
        [0 ou 1] {
          G|CNPJ|XLgr|Nro|XCpl|XBairro|CMun|XMun|UF|
            [seleção entre G02 ou G02a] {
              G02|CNPJ
              
              [ou]
              
              G02a|CPF
            }
        }
        [1 a 990] {
          H|nItem|infAdProd|
            I|CProd|CEAN|XProd|NCM|EXTIPI|CFOP|UCom|QCom|VUnCom|VProd|CEANTrib|UTrib|QTrib|VUnTrib|VFrete|VSeg|VDesc|vOutro|indTot|xPed|nItemPed|
              [0 a N] {
                I18|NDI|DDI|XLocDesemb|UFDesemb|DDesemb|CExportador|
                  [1 a N] {
                    I25|NAdicao|NSeqAdic|CFabricante|VDescDI|
                  }
              }
            [0 ou 1 – apenas se veículo] {
              J|TpOp|Chassi|CCor|XCor|Pot|cilin|pesoL|pesoB|NSerie|TpComb|NMotor|CMT|Dist|anoMod|anoFab|tpPint|tpVeic|espVeic|VIN|condVeic|cMod|cCorDENATRAN|lota|tpRest|
            }
            [0 a N – apenas se medicamento] {
              K|NLote|QLote|DFab|DVal|VPMC|
            }
            [0 a N – apenas se armamento] {
              L|TpArma|NSerie|NCano|Descr|
            }
            [0 a N – apenas se combustível] {
              L01|CProdANP|CODIF|QTemp|UFCons|
                [0 ou 1] {
                  L105|QBCProd|VAliqProd|VCIDE|
                }
              }
            M|
              N|
                [Seleção entre N02 ou N03 ou N04 ou N05 ou N06 ou N07 ou N08 ou N09 ou N10 ou N10a ou N10b ou N10c ou N10d ou N10e ou N10f ou N10g ou N10h] {
                  N02|Orig|CST|ModBC|VBC|PICMS|VICMS|
                  
                  [ou]
                  
                  N03|Orig|CST|ModBC|VBC|PICMS|VICMS|ModBCST|PMVAST|PRedBCST|VBCST|PICMSST|VICMSST|
                  
                  [ou]
                  
                  N04|Orig|CST|ModBC|PRedBC|VBC|PICMS|VICMS|
                  
                  [ou]
                  
                  N05|Orig|CST|ModBCST|PMVAST|PRedBCST|VBCST|PICMSST|VICMSST|
                  
                  [ou]
                  
                  N06|Orig|CST|vICMS|motDesICMS|
                  
                  [ou]
                  
                  N07|Orig|CST|ModBC|PRedBC|VBC|PICMS|VICMS|
                  
                  [ou]
                  
                  N08|Orig|CST|VBCST|VICMSST|
                  
                  [ou]
                  
                  N09|Orig|CST|ModBC|PRedBC|VBC|PICMS|VICMS|ModBCST|PMVAST|PRedBCST|VBCST|PICMSST|VICMSST|
                  
                  [ou]
                  
                  N10|Orig|CST|ModBC|PRedBC|VBC|PICMS|VICMS|ModBCST|PMVAST|PRedBCST|VBCST|PICMSST|VICMSST|
                  
                  [ou]
                  
                  N10a|Orig|CST|ModBC|PRedBC|VBC|PICMS|VICMS|ModBCST|PMVAST|PRedBCST|VBCST|PICMSST|VICMSST|pBCOp|UFST|
                  
                  [ou]
                  
                  N10b|Orig|CST|vBCSTRet|vICMSSTRet|vBCSTDest|vICMSSTDest|
                  
                  [ou]
                  
                  N10c|Orig|CSOSN|pCredSN|vCredICMSSN|
                  
                  [ou]
                  
                  N10d|Orig|CSOSN|
                  
                  [ou]
                  
                  N10e|Orig|CSOSN|modBCST|pMVAST|pRedBCST|vBCST|pICMSST|vICMSST|pCredSN|vCredICMSSN|
                  
                  [ou]
                  
                  N10f|Orig|CSOSN|modBCST|pMVAST|pRedBCST|vBCST|pICMSST|vICMSST|
                  
                  [ou]
                  
                  N10g|Orig|CSOSN|modBCST|vBCSTRet|vICMSSTRet|
                  
                  [ou]
                  
                  N10h|Orig|CSOSN|modBC|vBC|pRedBC|pICMS|vICMS|modBCST|pMVAST|pRedBCST|vBCST|pICMSST|vICMSST|pCredSN|vCredICMSSN|
                }
              [0 ou 1] {
                O|ClEnq|CNPJProd|CSelo|QSelo|CEnq|
                  [seleção entre O07 ou O08] {
                    O07|CST|VIPI|
                      [seleção entre O010 ou O11] {
                        O10|VBC|PIPI|
                        
                        [ou]
                        
                        O11|QUnid|VUnid|
                      }
                      
                    [ou]
                      
                    O08|CST|
                  }
              }
              [0 ou 1] {
                P|VBC|VDespAdu|VII|VIOF|
              }
              [0 ou 1] {
                U|VBC|VAliq|VISSQN|CMunFG|CListServ|cSitTrib|
              }
              Q|
                [Seleção entre Q02 ou Q03 ou Q04 ou Q05] {
                  Q02|CST|VBC|PPIS|VPIS|
                  
                  [ou]
                  
                  Q03|CST|QBCProd|VAliqProd|VPIS|
                  
                  [ou]
                  
                  Q04|CST|
                  
                  [ou]
                  
                  Q05|CST|VPIS|
                    [Seleção entre Q07 ou Q010] {
                      Q07|VBC|PPIS|
                      
                      [ou]
                      
                      Q10|QBCProd|VAliqProd|
                    }
                }
              R|VPIS|
                [Seleção entre R02 ou R04] {
                  R02|VBC|PPIS|
                  
                  [ou]
                  
                  R04|QBCProd|VAliqProd|
                }
              S|
                [Seleção entre S02 ou S03 ou S04 ou S05] {
                  S02|CST|VBC|PCOFINS|VCOFINS|
                  
                  [ou]
                  
                  S03|CST|QBCProd|VAliqProd|VCOFINS|
                  
                  [ou]
                  
                  S04|CST|
                  
                  [ou]
                  
                  S05|CST|VCOFINS|
                    [Seleção entre S07 ou S09] {
                      S07|VBC|PCOFINS|
                      
                      [ou]
                      
                      S09|QBCProd|VAliqProd|
                    }
                }
              [0 ou 1] {
                T|VCOFINS|
                  [Seleção entre T02 ou T04] {
                    T02|VBC|PCOFINS|
                    
                    [ou]
                    
                    T04|QBCProd|VAliqProd|
                  }
              }
          }
        W|
          W02|vBC|vICMS|vBCST|vST|vProd|vFrete|vSeg|vDesc|vII|vIPI|vPIS|vCOFINS|vOutro|vNF|
          [0 ou 1] {
            W17|VServ|VBC|VISS|VPIS|VCOFINS|
          }
          W23|VRetPIS|VRetCOFINS|VRetCSLL|VBCIRRF|VIRRF|VBCRetPrev|VRetPrev|
        X|ModFrete|
          X03|XNome|IE|XEnder|UF|XMun|
            [Seleção entre X04 ou X05] {
              X04|CNPJ|
              
              [ou]
              
              X05|CPF|
            }
            [0 ou 1] {
              X11|VServ|VBCRet|PICMSRet|VICMSRet|CFOP|CMunFG|
            }
            [0 ou 1] {
              X18|Placa|UF|RNTC|
            }
            [0 a 2] {
              X22|Placa|UF|RNTC|
            }
            [0 a N] {
              X26|QVol|Esp|Marca|NVol|PesoL|PesoB|
              [0 a N] {
                X33|NLacre|
              }
            }
        [0 ou 1] {
          Y|
            [0 ou 1] {
              Y02|NFat|VOrig|VDesc|VLiq|
            }
            [0 a N] {
              Y07|NDup|DVenc|VDup|
            }
        [0 ou 1] {
          Z|InfAdFisco|InfCpl|
            [0 a 10] {
              Z04|XCampo|XTexto|
            }
            [0 a 10] {
              Z07|XCampo|XTexto|
            }
            [0 a N] {
              Z10|NProc|IndProc|
            }
        }
        [0 ou 1] {
          ZA|UFEmbarq|XLocEmbarq|
        }
        [0 ou 1] {
          ZB|XNEmp|XPed|XCont|
        }
        [0 ou 1] {
          ZC01|safra|ref|qTotMes|qTotAnt|qTotGer|vFor|vTotDed|vLiqFor|
            [1 a 31] {
              ZC04|dia|qtde|
            }
            [0 a 10] {
              ZC10|xDed|vDed|
            }
        }



Campo Ele
  A - indica que o campo é um atributo do Elemento anterior;
  E - indica que o campo é um Elemento;
  CE – indica que o campo é um Elemento que deriva de uma Escolha (Choice);
  G – indica que o campo é um Elemento de Grupo;
  CG - indica que o campo é um Elemento de Grupo que deriva de uma Escolha (Choice);
  ID – indica que o campo é um ID da XML 1.0;
  RC – indica que o campo é uma key constraint (Restrição de Chave) para garantir a unicidade e
      presença do valor;

Campo Tipo
  N – campo numérico;
  C – campo alfanumérico ( max 60 posicoes );
  D – campo data;
  H – hora;
  URL – Endereço da web; 

Coluna Ocorrência: x-y, onde x indica a ocorrência mínima e y a ocorrência máxima;

Coluna tamanho: x-y, onde x indica o tamanho mínimo e y o tamanho máximo; a existência de um único valor indica que o campo tem tamanho fixo, devendo-se
informar a quantidade de caracteres exigidos, preenchendo-se os zeros não significativos; tamanhos separados por vírgula indicam que o campo deve ter um dos
tamanhos fixos da lista;

coluna dec: indica a quantidade máxima de casas decimais do campo;


4. Regras de preenchimento dos campos da Nota Fiscal Eletrônica:
* Campos que representam códigos (CNPJ, CPF, CEP, CST, NCM, EAN, etc.) devem ser informados com o tamanho fixo previsto, sem formatação
  e com o preenchimento dos zeros não significativos;
* Campos numéricos que representam valores e quantidades são de tamanho variável, respeitando o tamanho máximo previsto para o campo e a
  quantidade de casas decimais. O preenchimento de zeros não significativos causa erro de validação do Schema XML. Os campos numéricos
  devem ser informados sem o separador de milhar, com uso do ponto decimal para indicar a parte fracionária se existente respeitando-se a
  quantidade de dígitos prevista no leiaute;
* O uso de caracteres acentuados e símbolos especiais para o preenchimento dos campos alfanuméricos devem ser evitados. Os espaços
  informados no início e no final do campo alfanumérico também devem ser evitados;
* As datas devem ser informadas no formato “AAAA-MM-DD”;
  A forma e a obrigatoriedade de preenchimento dos campos da Nota Fiscal Eletrônica estão previstas na legislação aplicável para a operação que
  se pretende realizar;
* Inexistindo conteúdo (valor zero ou vazio) para um campo não obrigatório, a TAG deste campo não deverá ser informada no arquivo da NF-e;
* Tratando-se de operações com o exterior, uma vez que o campo CNPJ é obrigatório não informar o conteúdo deste campo;
* No caso das pessoas desobrigadas de inscrição no CNPJ/MF, deverá ser informado o CPF da pessoa, exceto nas operações com o exterior;


*/

function teste() {
  echo 'test';
}

