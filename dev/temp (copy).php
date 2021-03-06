<?php

NOTA FISCAL|qtd notas fiscais no arquivo|
  A|versão do schema|id|
    B|cUF|cNF|NatOp|intPag|mod|serie|nNF|dEmi|dSaiEnt|hSaiEnt|tpNF|cMunFG|TpImp|TpEmis|cDV|tpAmb|finNFe|procEmi|VerProc|dhCont|xJust|
      [0 a N] {
        [seleção entre B13 ou B14 ou B20a ou B20i ou B20j] {
          B13|refNFe|
          
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
  A - indica que o campo é um atributo do Elemento
  anterior;
  E - indica que o campo é um Elemento;
  CE – indica que o campo é um Elemento que deriva
  de uma Escolha (Choice);
  G – indica que o campo é um Elemento de Grupo;
  CG - indica que o campo é um Elemento de Grupo
  que deriva de uma Escolha (Choice);
  ID – indica que o campo é um ID da XML 1.0;
  RC – indica que o campo é uma key constraint
      (Restrição de Chave) para garantir a unicidade e
      presença do valor;

Campo Tipo
  N – campo numérico;
  C – campo alfanumérico;
  D – campo data;

Coluna Ocorrência: x-y, onde x indica a ocorrência mínima e y a ocorrência máxima;

Coluna tamanho: x-y, onde x indica o tamanho mínimo e y o tamanho máximo; a existência de um único valor indica que o campo tem tamanho fixo, devendo-se
informar a quantidade de caracteres exigidos, preenchendo-se os zeros não significativos; tamanhos separados por vírgula indicam que o campo deve ter um dos
tamanhos fixos da lista;

coluna dec: indica a quantidade máxima de casas decimais do campo;



