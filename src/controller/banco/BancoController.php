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
        $contas = Conta::select('o')->join('o.servidor', 's')->where(Transacao::expr()->like('s.nome', '?1'))->orderBy('s.nome')
                        ->setParameter(1, sprintf('%%%s%%', filter_input(INPUT_POST, 'nome')))->getQuery()->getResult();
        $pages = Pagination::paginate($contas);
        if (count($pages) > 0) {
            $_MyCookie->LoadView('banco', 'Manage.table', $pages);
        }
    }

    public static function addDeposito() {
        global $_MyCookie;
        $_MyCookie->goBackTo('administrator', 'banco');
        $conta = Conta::select('o')->where('o.id = ?1')->setParameter(1, $_MyCookie->getURLVariables(2))->getQuery()->getSingleResult();
        $transacao = new Transacao;
        $_MyCookie->LoadView('banco', 'Deposito', array('transacao' => $transacao, 'conta' => $conta, 'action' => 'Depositar'));
    }

    public static function editDeposito() {
        global $_MyCookie;
        $_MyCookie->goBackTo('administrator', 'banco');
        $transacao = Transacao::select('o')->where('o.id = ?1')
                        ->setParameter(1, $_MyCookie->getURLVariables(2))->getQuery()->getSingleResult();
        $_MyCookie->LoadView('banco', 'Deposito', array('transacao' => $transacao, 'conta' => $transacao->getConta(), 'action' => 'Editar depósito'));
    }

    public static function saveDeposito() {
        $conta = Conta::select('c')->where('c.id = ?1')->setParameter(1, filter_input(INPUT_POST, 'conta'))->getQuery()->getSingleResult();
        $transacao = (empty(filter_input(INPUT_POST, 'transacao'))) ? new Transacao : Transacao::select('o')->where('o.id = ?1')
                        ->setParameter(1, filter_input(INPUT_POST, 'transacao'))->getQuery()->getSingleResult();
        if (!empty($transacao->getId())) {
            $conta->Retirar($transacao->getAulas());
        }
        $transacao
                ->setConta($conta)
                ->setTipo(Transacao::TIPO_DEPOSITO)
                ->setAulas(filter_input(INPUT_POST, 'aulas'))
                ->setObservacao(filter_input(INPUT_POST, 'observacao'))
                ->save();
        $conta->Depositar($transacao->getAulas())->save();
        echo 'Transação salva com sucesso!';
    }

    public static function addRetirada() {
        global $_MyCookie;
        $_MyCookie->goBackTo('administrator', 'banco');
        $conta = Conta::select('o')->where('o.id = ?1')->setParameter(1, $_MyCookie->getURLVariables(2))->getQuery()->getSingleResult();
        $transacao = new Transacao;
        $_MyCookie->LoadView('banco', 'Retirada', array('transacao' => $transacao, 'conta' => $conta, 'action' => 'Retirar'));
    }

    public static function editRetirada() {
        global $_MyCookie;
        $_MyCookie->goBackTo('administrator', 'banco');
        $transacao = Transacao::select('o')->where('o.id = ?1')
                        ->setParameter(1, $_MyCookie->getURLVariables(2))->getQuery()->getSingleResult();
        $_MyCookie->LoadView('banco', 'Retirada', array('transacao' => $transacao, 'conta' => $transacao->getConta(), 'action' => 'Editar depósito'));
    }

    public static function saveRetirada() {
        $conta = Conta::select('c')->where('c.id = ?1')->setParameter(1, filter_input(INPUT_POST, 'conta'))->getQuery()->getSingleResult();
        $transacao = (empty(filter_input(INPUT_POST, 'transacao'))) ? new Transacao : Transacao::select('o')->where('o.id = ?1')
                        ->setParameter(1, filter_input(INPUT_POST, 'transacao'))->getQuery()->getSingleResult();
        if (!empty($transacao->getId())) {
            $conta->Depositar($transacao->getAulas());
        }
        $transacao
                ->setConta($conta)
                ->setTipo(Transacao::TIPO_RETIRADA)
                ->setAulas(filter_input(INPUT_POST, 'aulas'))
                ->setObservacao(filter_input(INPUT_POST, 'observacao'))
                ->save();
        $conta->Retirar($transacao->getAulas())->save();
        echo 'Transação salva com sucesso!';
    }

    public static function deleteTransacao() {
        $transacao = Transacao::select('o')->where('o.id = ?1')
                        ->setParameter(1, filter_input(INPUT_POST, 'transacao'))->getQuery()->getSingleResult();
        $conta = $transacao->getConta();
        if ($transacao->getTipo() == Transacao::TIPO_DEPOSITO) {
            $conta->Retirar($transacao->getAulas());
        } else {
            $conta->Depositar($transacao->getAulas());
        }
        $transacao->delete();
        echo 'Transação deletada com sucesso!';
    }

    public static function transacoes() {
        global $_MyCookie;
        $_MyCookie->goBackTo('administrator', 'banco');
        $transacoes = Transacao::select('o')->join('o.conta', 'c')->where('c.id = ?1')->orderBy('o.datahora', 'DESC')
                        ->setParameter(1, $_MyCookie->getURLVariables(2))->getQuery()->getResult();
        $conta = $transacoes[0]->getConta();
        $_MyCookie->LoadView('banco', 'Transacoes', array('conta' => $conta, 'transacoes' => Pagination::paginate($transacoes)));
    }

    public static function searchTransacoes() {
        global $_MyCookie;
        $_MyCookie->goBackTo('administrator', 'banco');
        $transacoes = Transacao::select('o')->join('o.conta', 'c')->where('c.id = ?1')->andWhere('o.datahora >= ?2')->andWhere('o.datahora <= ?3')->orderBy('o.datahora', 'DESC')
                        ->setParameter(1, filter_input(INPUT_POST, 'conta'))
                        ->setParameter(2, filter_input(INPUT_POST, 'data') . ' 00:00:00')
                        ->setParameter(3, filter_input(INPUT_POST, 'data') . ' 23:59:59')->getQuery()->getResult();
        $_MyCookie->LoadView('banco', 'Transacoes.table', Pagination::paginate($transacoes));
    }

    public static function declaracao() {
        global $_MyCookie;
        $transacao = Transacao::select('o')->where('o.id = ?1')
                        ->setParameter(1, $_MyCookie->getURLVariables(2))->getQuery()->getSingleResult();
        if ($transacao->getTipo() == Transacao::TIPO_DEPOSITO) {
            $_MyCookie->LoadView('banco', 'Declaracao.Deposito', $transacao);
        } else {
            $_MyCookie->LoadView('banco', 'Declaracao.Retirada', $transacao);
        }
    }

}
