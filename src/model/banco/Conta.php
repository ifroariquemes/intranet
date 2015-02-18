<?php

namespace model\banco;

use lib\util\Object;

/**
 * @Entity 
 * @Table(name="banco_conta")
 */
class Conta extends Object {

    /** @Column(type="integer") @Id @GeneratedValue */
    private $id;

    /**
     * @OneToOne(targetEntity="model\servidor\Servidor") 
     * @JoinColumn(name="servidor_siape", referencedColumnName="siape")
     */
    private $servidor;

    /** @Column(type="integer") */
    private $saldo;

    /**
     * @OneToMany(targetEntity="model\banco\Transacao", mappedBy="conta")    
     * @OrderBy({"datahora" = "DESC"})
     */
    private $transacoes;

    function __construct() {
        $this->saldo = 0;
    }

    function getId() {
        return $this->id;
    }

    function getServidor() {
        return $this->servidor;
    }

    function getSaldo() {
        return $this->saldo;
    }

    function getTransacoes() {
        return $this->transacoes;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setServidor($servidor) {
        $this->servidor = $servidor;
        return $this;
    }

    function setSaldo($saldo) {
        $this->saldo = $saldo;
        return $this;
    }

    function setTransacoes($transacoes) {
        $this->transacoes = $transacoes;
        return $this;
    }
    
    function Depositar($aulas) {
        $this->saldo += $aulas;
        return $this;
    }
    
    function Retirar($aulas) {
        $this->saldo -= $aulas;
        return $this;
    }

}
