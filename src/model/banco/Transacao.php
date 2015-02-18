<?php

namespace model\banco;

use lib\util\Object;

/**
 * @Entity 
 * @Table(name="banco_transacao")
 */
class Transacao extends Object {

    const TIPO_DEPOSITO = 'DEPÓSITO';
    const TIPO_RETIRADA = 'RETIRADA';

    /** @Column(type="integer") @Id @GeneratedValue */
    private $id;

    /**
     * @ManyToOne(targetEntity="model\banco\Conta", inversedBy="transacoes", cascade={"merge"})
     * @JoinColumn(name="conta_id", referencedColumnName="id")
     */
    private $conta;

    /** @Column(type="string") */
    private $tipo; // Entrada ou Saída

    /** @Column(type="integer") */
    private $aulas;        

    /** @Column(type="datetime") */
    private $datahora;

    /** @Column(type="string", nullable=true) */
    private $observacao;

    function __construct() {
        $this->datahora = new \DateTime();
    }

    function getId() {
        return $this->id;
    }

    function getConta() {
        return $this->conta;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getAulas() {
        return $this->aulas;
    }

    function getDatahora() {
        return $this->datahora->format('d/m/Y h:i:s');
    }

    function getObservacao() {
        return $this->observacao;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setConta($conta) {
        $this->conta = $conta;
        return $this;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
        return $this;
    }

    function setAulas($aulas) {
        $this->aulas = $aulas;
        return $this;
    }

    function setDatahora($datahora) {
        $this->datahora = $datahora;
        return $this;
    }

    function setObservacao($observacao) {
        $this->observacao = $observacao;
        return $this;
    }

}
