<?php

namespace controller\banco;

use model\banco\Conta;
use model\banco\Transacao;
use lib\util\Pagination;

class BancoController {

    public static function manage() {
        global $_MyCookie;
        $_MyCookie->goBackTo('administrator');        
        $contas = Conta::select('o')->join('o.servidor', 's')->where('s.status = 1')->orderBy('s.nome')->getQuery()->getResult();
        $_MyCookie->LoadView('banco', 'Manage', Pagination::paginate($contas));
    }

    public static function search() {
        global $_MyCookie;
        $banco = Transacao::select('o')->where(Transacao::expr()->like('o.nome', '?1'))->orderBy('o.nome')
                        ->setParameter(1, sprintf('%%%s%%', filter_input(INPUT_POST, 'nome')))->getQuery()->getResult();
        $pages = Pagination::paginate($banco);
        if (count($pages) > 0) {
            $_MyCookie->LoadView('banco', 'Manage.table', $pages);
        }
    }

    public static function add() {
        global $_MyCookie;
        $_MyCookie->goBackTo('administrator', 'banco');
        $banco = new Transacao;
        $_MyCookie->LoadView('banco', 'Edit', array('banco' => $banco, 'action' => 'Adicionar'));
    }

    public static function edit() {
        global $_MyCookie;
        $_MyCookie->goBackTo('administrator', 'banco');
        $banco = Transacao::select('o')->where('o.siape = ?1')
                        ->setParameter(1, $_MyCookie->getURLVariables(2))->getQuery()->getSingleResult();
        $_MyCookie->LoadView('banco', 'Edit', array('action' => 'Editar', 'banco' => $banco));
    }

    public static function exists() {
        $banco_exists = count(Transacao::select('o')->where('o.siape = ?1')
                        ->setParameter(1, filter_input(INPUT_POST, 'siape'))->getQuery()->getResult());
        if ($banco_exists && empty(filter_input(INPUT_POST, 'siape_check'))) {
            echo 'Este SIAPE já está cadastrado';
        }
    }

    public static function save() {
        $banco = (empty(filter_input(INPUT_POST, 'siape_check'))) ? new Transacao : Transacao::select('o')->where('o.siape = ?1')
                        ->setParameter(1, filter_input(INPUT_POST, 'siape'))->getQuery()->getSingleResult();
        $banco
                ->setSIAPE(filter_input(INPUT_POST, 'siape'))
                ->setNome(filter_input(INPUT_POST, 'nome'))
                ->setTipo(filter_input(INPUT_POST, 'tipo'))
                ->setStatus(true)
                ->save();
        echo 'Transacao salvo com sucesso!';
    }

    public static function active() {
        Transacao::select('o')->where('o.siape = ?1')
                ->setParameter(1, filter_input(INPUT_POST, 'siape'))->getQuery()->getSingleResult()->setStatus(true)->save();
        echo 'Transacao ativado';
    }

    public static function deactive() {
        Transacao::select('o')->where('o.siape = ?1')
                ->setParameter(1, filter_input(INPUT_POST, 'siape'))->getQuery()->getSingleResult()->setStatus(false)->save();
        echo 'Transacao desativado';
    }

    public static function select($banco) {
        global $_MyCookie;
        $bancoes = Transacao::select('o')->where('o.status = 1')->orderBy('o.nome')->getQuery()->getResult();
        $siape = (empty($banco)) ? null : $banco->getSiape();
        $_MyCookie->LoadView('banco', 'Select', array('bancoes' => $bancoes, 'siape' => $siape));
    }

}
