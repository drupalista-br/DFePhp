<?php
/**
 * Arquivo que contém a classe Txt201 em NFe.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */

namespace DFePhp\Schemas\NFe;

use DFePhp\Schemas\SchemaGeral;

/**
 * Classe para construir o Layout TXT da NFe conforme o Manual 2.0.1.
 *
 * @see http://goo.gl/9JIIvx
 */
class Txt201 extends SchemaGeral {
  
  /**
   * Construtor automático.
   */
  public function __construct() {
    $this->set_txt_layout();
  }
  
  /**
   * Informações sobre a versão / release do manual do contribuinte.
   */
  public static function registro() {
    return array (
      'website' => 'http://www.emissornfe.fazenda.sp.gov.br',
      'versao' => '2.0.1',
      // YYYY-MM-DD
      'data_do_release' => '2013-05-15',
      'manual' => 'resources/docs/Nfe/[Emissor_NF-e]_Manual_de_layout_TXT-NF-e_v2.0.1.pdf',
    );
  }

  /**
   * As instruções para se gerar o arquivo txt.
   */
  private function set_txt_layout() {
    $this->txt_layout = array (
      'NOTA FISCAL' => array(
        'tag_xml_parente' => FALSE,
        'linha_txt' => array('@parameter::qtd notas fiscais no arquivo'),
      ),
      'A' => array(
        'tag_xml_parente' => array('NFe', 'infNFe'),
        'linha_txt' => array('@attribute::versao', '@attribute::Id'),
      ),
      'B' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'ide'),
        'linha_txt' => array('cUF', 'cNF', 'NatOp', 'intPag', 'mod', 'serie', 'nNF', 'dEmi', 'dSaiEnt', 'hSaiEnt', 'tpNF', 'cMunFG', 'TpImp', 'TpEmis', 'cDV', 'tpAmb', 'finNFe', 'procEmi', 'VerProc', 'dhCont', 'xJust'),
      ),
      'B13' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'ide', 'NFref'),
        'linha_txt' => array('refNFe'),
      ),
      'B14' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'ide', 'NFref', 'refNF'),
        'linha_txt' => array('cUF', 'AAMM', 'CNPJ', 'Mod', 'serie', 'nNF'),
      ),
      'B20a' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'ide', 'NFref', 'refNFP'),
        'linha_txt' => array('cUF', 'AAMM', 'IE', 'mod', 'serie', 'nNF'),
      ),
      'B20d' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'ide', 'NFref', 'refNFP'),
        'linha_txt' => array('CNPJ'),
      ),
      'B20e' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'ide', 'NFref', 'refNFP'),
        'linha_txt' => array('CPF'),
      ),
      'B20i' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'ide', 'NFref', 'refCTe'),
        'linha_txt' => array('refCTe'),
      ),
      'B20j' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'ide', 'NFref', 'refECF'),
        'linha_txt' => array('mod', 'nECF', 'nCOO'),
      ),
      'C' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'emit'),
        'linha_txt' => array('XNome', 'XFant', 'IE', 'IEST', 'IM', 'CNAE', 'CRT'),
      ),
      'C02' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'emit'),
        'linha_txt' => array('CNPJ'),
      ),
      'C02a' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'emit'),
        'linha_txt' => array('CPF'),
      ),
      'C05' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'emit', 'enderEmit'),
        'linha_txt' => array('XLgr', 'Nro', 'Cpl', 'Bairro', 'CMun', 'XMun', 'UF', 'CEP', 'cPais', 'xPais', 'fone'),
      ),
      'D' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'avulsa'),
        'linha_txt' => array('CNPJ', 'xOrgao', 'matr', 'xAgente', 'fone', 'UF', 'nDAR', 'dEmi', 'vDAR', 'repEmi', 'dPag'),
      ),
      'E' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'dest'),
        'linha_txt' => array('xNome', 'IE', 'ISUF', 'email'),
      ),
      'E02' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'dest'),
        'linha_txt' => array('CNPJ'),
      ),
      'E03' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'dest'),
        'linha_txt' => array('CPF'),
      ),
      'E05' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'dest', 'enderDest'),
        'linha_txt' => array('xLgr', 'nro', 'xCpl', 'xBairro', 'cMun', 'xMun', 'UF', 'CEP', 'cPais', 'xPais', 'fone'),
      ),
      'F' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'retirada'),
        'linha_txt' => array('CNPJ', 'XLgr', 'Nro', 'XCpl', 'XBairro', 'CMun', 'XMun', 'UF'),
      ),
      'F02' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'retirada'),
        'linha_txt' => array('CNPJ'),
      ),
      'F02a' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'retirada'),
        'linha_txt' => array('CPF'),
      ),
      'G' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'entrega'),
        'linha_txt' => array('CNPJ', 'XLgr', 'Nro', 'XCpl', 'XBairro', 'CMun', 'XMun', 'UF'),
      ),
      'G02' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'entrega'),
        'linha_txt' => array('CNPJ'),
      ),
      'G02a' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'entrega'),
        'linha_txt' => array('CPF'),
      ),
      'H' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det'),
        'linha_txt' => array('@attribute::nItem', 'infAdProd'),
      ),
      'I' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'prod'),
        'linha_txt' => array('CProd', 'CEAN', 'XProd', 'NCM', 'EXTIPI', 'CFOP', 'UCom', 'QCom', 'VUnCom', 'VProd', 'CEANTrib', 'UTrib', 'QTrib', 'VUnTrib', 'VFrete', 'VSeg', 'VDesc', 'vOutro', 'indTot', 'xPed', 'nItemPed'),
      ),
      'I18' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'prod', 'DI'),
        'linha_txt' => array('NDI', 'DDI', 'XLocDesemb', 'UFDesemb', 'DDesemb', 'CExportador'),
      ),
      'I25' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'prod', 'DI', 'adi'),
        'linha_txt' => array('NAdicao', 'NSeqAdic', 'CFabricante', 'VDescDI'),
      ),
      'J' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'prod', 'veicProd'),
        'linha_txt' => array('TpOp', 'Chassi', 'CCor', 'XCor', 'Pot', 'cilin', 'pesoL', 'pesoB', 'NSerie', 'TpComb', 'NMotor', 'CMT', 'Dist', 'anoMod', 'anoFab', 'tpPint', 'tpVeic', 'espVeic', 'VIN', 'condVeic', 'cMod', 'cCorDENATRAN', 'lota', 'tpRest'),
      ),
      'K' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'prod', 'med'),
        'linha_txt' => array('NLote', 'QLote', 'DFab', 'DVal', 'VPMC'),
      ),
      'L' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'prod', 'arma'),
        'linha_txt' => array('TpArma', 'NSerie', 'NCano', 'Descr'),
      ),
      'L101' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'prod', 'comb'),
        'linha_txt' => array('CProdANP', 'CODIF', 'QTemp', 'UFCons'),
      ),
      'L105' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'prod', 'comb', 'CIDE'),
        'linha_txt' => array('QBCProd', 'VAliqProd', 'VCIDE'),
      ),
      'M' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto'),
        'linha_txt' => array('vTotTrib'),
      ),
      'N02' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'ICMS', 'ICMS00'),
        'linha_txt' => array('Orig', 'CST', 'ModBC', 'VBC', 'PICMS', 'VICMS'),
      ),
      'N03' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'ICMS', 'ICMS10'),
        'linha_txt' => array('Orig', 'CST', 'ModBC', 'VBC', 'PICMS', 'VICMS', 'ModBCST', 'PMVAST', 'PRedBCST', 'VBCST', 'PICMSST', 'VICMSST'),
      ),
      'N04' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'ICMS', 'ICMS20'),
        'linha_txt' => array('Orig', 'CST', 'ModBC', 'PRedBC', 'VBC', 'PICMS', 'VICMS'),
      ),
      'N05' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'ICMS', 'ICMS30'),
        'linha_txt' => array('Orig', 'CST', 'ModBCST', 'PMVAST', 'PRedBCST', 'VBCST', 'PICMSST', 'VICMSST'),
      ),
      'N06' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'ICMS', 'ICMS40'),
        'linha_txt' => array('Orig', 'CST', 'vICMS', 'motDesICMS'),
      ),
      'N07' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'ICMS', 'ICMS51'),
        'linha_txt' => array('Orig', 'CST', 'ModBC', 'PRedBC', 'VBC', 'PICMS', 'VICMS'),
      ),
      'N08' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'ICMS', 'ICMS60'),
        'linha_txt' => array('Orig', 'CST', 'VBCST', 'VICMSST'),
      ),
      'N09' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'ICMS', 'ICMS70'),
        'linha_txt' => array('Orig', 'CST', 'ModBC', 'PRedBC', 'VBC', 'PICMS', 'VICMS', 'ModBCST', 'PMVAST', 'PRedBCST', 'VBCST', 'PICMSST', 'VICMSST'),
      ),
      'N10' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'ICMS', 'ICMS90'),
        'linha_txt' => array('Orig', 'CST', 'ModBC', 'PRedBC', 'VBC', 'PICMS', 'VICMS', 'ModBCST', 'PMVAST', 'PRedBCST', 'VBCST', 'PICMSST', 'VICMSST'),
      ),
      'N10a' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'ICMS', 'ICMSPart'),
        'linha_txt' => array('Orig', 'CST', 'ModBC', 'PRedBC', 'VBC', 'PICMS', 'VICMS', 'ModBCST', 'PMVAST', 'PRedBCST', 'VBCST', 'PICMSST', 'VICMSST', 'pBCOp', 'UFST'),
      ),
      'N10b' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'ICMS', 'ICMSST'),
        'linha_txt' => array('Orig', 'CST', 'vBCSTRet', 'vICMSSTRet', 'vBCSTDest', 'vICMSSTDest'),
      ),
      'N10c' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'ICMS', 'ICMSSN101'),
        'linha_txt' => array('Orig', 'CSOSN', 'pCredSN', 'vCredICMSSN'),
      ),
      'N10d' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'ICMS', 'ICMSSN102'),
        'linha_txt' => array('Orig', 'CSOSN'),
      ),
      'N10e' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'ICMS', 'ICMSSN201'),
        'linha_txt' => array('Orig', 'CSOSN', 'modBCST', 'pMVAST', 'pRedBCST', 'vBCST', 'pICMSST', 'vICMSST', 'pCredSN', 'vCredICMSSN'),
      ),
      'N10f' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'ICMS', 'ICMSSN202'),
        'linha_txt' => array('Orig', 'CSOSN', 'modBCST', 'pMVAST', 'pRedBCST', 'vBCST', 'pICMSST', 'vICMSST'),
      ),
      'N10g' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'ICMS', 'ICMSSN500'),
        'linha_txt' => array('Orig', 'CSOSN', 'modBCST', 'vBCSTRet', 'vICMSSTRet'),
      ),
      'N10h' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'ICMS', 'ICMSSN900'),
        'linha_txt' => array('Orig', 'CSOSN', 'modBC', 'vBC', 'pRedBC', 'pICMS', 'vICMS', 'modBCST', 'pMVAST', 'pRedBCST', 'vBCST', 'pICMSST', 'vICMSST', 'pCredSN', 'vCredICMSSN'),
      ),
      'O' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'IPI'),
        'linha_txt' => array('ClEnq', 'CNPJProd', 'CSelo', 'QSelo', 'CEnq'),
      ),
      'O07' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'IPI', 'IPITrib'),
        'linha_txt' => array('CST', 'VIPI'),
      ),
      'O10' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'IPI', 'IPITrib'),
        'linha_txt' => array('VBC', 'PIPI'),
      ),
      'O11' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'IPI', 'IPITrib'),
        'linha_txt' => array('QUnid', 'VUnid'),
      ),
      'O08' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'IPI', 'IPINT'),
        'linha_txt' => array('CST'),
      ),
      'P' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'II'),
        'linha_txt' => array('VBC', 'VDespAdu', 'VII', 'VIOF'),
      ),
      'U' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'ISSQN'),
        'linha_txt' => array('VBC', 'VAliq', 'VISSQN', 'CMunFG', 'CListServ', 'cSitTrib'),
      ),
      'Q02' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'PIS', 'PISAliq'),
        'linha_txt' => array('CST', 'VBC', 'PPIS', 'VPIS'),
      ),
      'Q03' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'PIS', 'PISQtde'),
        'linha_txt' => array('CST', 'QBCProd', 'VAliqProd', 'VPIS'),
      ),
      'Q04' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'PIS', 'PISNT'),
        'linha_txt' => array('CST'),
      ),
      'Q05' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'PIS', 'PISOutr'),
        'linha_txt' => array('CST', 'VPIS'),
      ),
      'Q07' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'PIS', 'PISOutr'),
        'linha_txt' => array('VBC', 'PPIS'),
      ),
      'Q10' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'PIS', 'PISOutr'),
        'linha_txt' => array('QBCProd', 'VAliqProd'),
      ),
      'R' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'PISST'),
        'linha_txt' => array('VPIS'),
      ),
      'R02' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'PISST'),
        'linha_txt' => array('VBC', 'PPIS'),
      ),
      'R04' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'PISST'),
        'linha_txt' => array('QBCProd', 'VAliqProd'),
      ),
      'S02' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'COFINS', 'COFINSAliq'),
        'linha_txt' => array('CST', 'VBC', 'PCOFINS', 'VCOFINS'),
      ),
      'S03' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'COFINS', 'COFINSQtde'),
        'linha_txt' => array('CST', 'QBCProd', 'VAliqProd', 'VCOFINS'),
      ),
      'S04' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'COFINS', 'COFINSNT'),
        'linha_txt' => array('CST'),
      ),
      'S05' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'COFINS', 'COFINSOutr'),
        'linha_txt' => array('CST', 'VCOFINS'),
      ),
      'S07' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'COFINS', 'COFINSOutr'),
        'linha_txt' => array('VBC', 'PCOFINS'),
      ),
      'S09' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'COFINS', 'COFINSOutr'),
        'linha_txt' => array('QBCProd', 'VAliqProd'),
      ),
      'T' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'COFINSST'),
        'linha_txt' => array('VCOFINS'),
      ),
      'T02' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'COFINSST'),
        'linha_txt' => array('VBC', 'PCOFINS'),
      ),
      'T04' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'det', 'imposto', 'COFINSST'),
        'linha_txt' => array('QBCProd', 'VAliqProd'),
      ),
      'W02' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'total', 'ICMSTot'),
        'linha_txt' => array('vBC', 'vICMS', 'vBCST', 'vST', 'vProd', 'vFrete', 'vSeg', 'vDesc', 'vII', 'vIPI', 'vPIS', 'vCOFINS', 'vOutro', 'vNF', 'vTotTrib'),
      ),
      'W17' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'total', 'ISSQNtot'),
        'linha_txt' => array('VServ', 'VBC', 'VISS', 'VPIS', 'VCOFINS'),
      ),
      'W23' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'total', 'retTrib'),
        'linha_txt' => array('VRetPIS', 'VRetCOFINS', 'VRetCSLL', 'VBCIRRF', 'VIRRF', 'VBCRetPrev', 'VRetPrev'),
      ),
      'X' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'transp'),
        'linha_txt' => array('ModFrete'),
      ),
      'X03' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'transp', 'transporta'),
        'linha_txt' => array('XNome', 'IE', 'XEnder', 'UF', 'XMun'),
      ),
      'X04' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'transp', 'transporta'),
        'linha_txt' => array('CNPJ'),
      ),
      'X05' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'transp', 'transporta'),
        'linha_txt' => array('CPF'),
      ),
      'X11' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'transp', 'retTransp'),
        'linha_txt' => array('VServ', 'VBCRet', 'PICMSRet', 'VICMSRet', 'CFOP', 'CMunFG'),
      ),
      'X18' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'transp', 'veicTransp'),
        'linha_txt' => array('Placa', 'UF', 'RNTC'),
      ),
      'X22' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'transp', 'reboque'),
        'linha_txt' => array('Placa', 'UF', 'RNTC'),
      ),
      'X26' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'transp', 'vol'),
        'linha_txt' => array('QVol', 'Esp', 'Marca', 'NVol', 'PesoL', 'PesoB'),
      ),
      'X33' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'transp', 'vol', 'lacres'),
        'linha_txt' => array('NLacre'),
      ),
      'Y02' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'cobr', 'fat'),
        'linha_txt' => array('NFat', 'VOrig', 'VDesc', 'VLiq'),
      ),
      'Y07' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'cobr', 'dup'),
        'linha_txt' => array('NDup', 'DVenc', 'VDup'),
      ),
      'Z' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'infAdic'),
        'linha_txt' => array('InfAdFisco', 'InfCpl'),
      ),
      'Z04' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'infAdic', 'obsCont'),
        'linha_txt' => array('@attribute::XCampo', 'XTexto'),
      ),
      'Z07' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'infAdic', 'obsFisco'),
        'linha_txt' => array('@attribute::XCampo', 'XTexto'),
      ),
      'Z10' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'infAdic', 'procRef'),
        'linha_txt' => array('NProc', 'IndProc'),
      ),
      'ZA' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'exporta'),
        'linha_txt' => array('UFEmbarq', 'XLocEmbarq'),
      ),
      'ZB' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'compra'),
        'linha_txt' => array('XNEmp', 'XPed', 'XCont'),
      ),
      'ZC01' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'cana'),
        'linha_txt' => array('safra', 'ref', 'qTotMes', 'qTotAnt', 'qTotGer', 'vFor', 'vTotDed', 'vLiqFor'),
      ),
      'ZC04' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'cana', 'forDia'),
        'linha_txt' => array('@attribute::dia', 'qtde'),
      ),
      'ZC10' => array(
        'tag_xml_parente' => array('NFe', 'infNFe', 'cana', 'deduc'),
        'linha_txt' => array('xDed', 'vDed'),
      ),
    );
  }
}
