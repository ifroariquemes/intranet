<?php

namespace model\servidor;

use lib\util\Object;

/**
 * @Entity 
 * @Table(name="servidor")
 */
class Servidor extends Object {

    /** @Column(type="string") @Id */
    private $siape;

    /** @Column(type="string") */
    private $nome;

    /** @Column(type="string") */
    private $tipo;

    /** @Column(type="boolean") */
    private $status;

    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
        return $this;
    }

    function getSiape() {
        return $this->siape;
    }

    function getNome() {
        return $this->nome;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setSiape($siape) {
        $this->siape = $siape;
        return $this;
    }

    function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
        return $this;
    }

}
