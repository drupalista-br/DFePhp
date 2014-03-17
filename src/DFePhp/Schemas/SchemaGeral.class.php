<?php
/**
 * Comporta os layout da entrada de dados de cada Tipo de Documento Fiscal
 * Eletrônico.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 */
namespace DFePhp\Schemas;

/**
 * Classe para criar os Layouts de Entrada de Dados dos DFe.
 */
abstract class SchemaGeral {
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
   * Lista todos os campos de dados do DFe.
   *
   * @param Bool $xml
   *   Retorna todos os campos do DFe estruturado em XML.
   * @param Bool $descricao
   *   Inclui a descrição do manual de integração para cada campo.
   * @return Array/Resource
   *   Todos os campos do DFe estruturados ou em XML ou em uma Array MakeDFe
   *   válida.
   */
  public function get_campos_do_dfe($xml = FALSE, $descricao = FALSE) {
    // TODO.
  }

}
