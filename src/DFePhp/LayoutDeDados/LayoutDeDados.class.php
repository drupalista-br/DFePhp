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
abstract class LayoutDeDados {
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

}
