<?php
/**
 * Tabelas de Dados.
 *
 * @author https://github.com/drupalista-br/DFePhp/graphs/contributors
 * @version https://github.com/drupalista-br/DFePhp/releases
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 *
 */

namespace DFePhp\Ferramentas;

/**
 * Classe para criar tabelas de dados.
 */
class Tabelas {

  /**
   * Lista do IBGE com códigos numéricos das Unidades da Federação.
   * 
   * @return Array
   *   ( Chave ) Código Numero | ( Valor ) Nome do Estado
   */
  public function ibge_uf_codigos_numericos() {
    // TODO: Criar a lista.
    return array();
  }

  /**
   * Lista de Formas de Pagamento da NFe.
   * 
   * @return Array
   *   ( Chave ) Código do Pagamento | ( Valor ) Nome da Forma de Pagto.
   */
  public function nfe_formas_de_pagamento() {
    // Manual de Integração NFe 5.0
    return array (
      0 => 'Pagamento à vista',
      1 => 'Pagamento à prazo',
      2 => 'Outros',
    );
  }
}
