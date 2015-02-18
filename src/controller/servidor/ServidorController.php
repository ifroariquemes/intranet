<?php

namespace controller\servidor;

use model\servidor\Servidor;
use model\banco\Conta;
use lib\util\Pagination;

class ServidorController {

    public static function manage() {
        global $_MyCookie;
        $_MyCookie->goBackTo('administrator');
        $servidores = Servidor::select('o')->orderBy('o.status, o.nome')->getQuery()->getResult();
        $_MyCookie->LoadView('servidor', 'Manage', Pagination::paginate($servidores));
    }

    public static function search() {
        global $_MyCookie;
        $servidor = Servidor::select('o')->where(Servidor::expr()->like('o.nome', '?1'))->orderBy('o.nome')
                        ->setParameter(1, sprintf('%%%s%%', filter_input(INPUT_POST, 'nome')))->getQuery()->getResult();
        $pages = Pagination::paginate($servidor);
        if (count($pages) > 0) {
            $_MyCookie->LoadView('servidor', 'Manage.table', $pages);
        }
    }

    public static function add() {
        global $_MyCookie;
        $_MyCookie->goBackTo('administrator', 'servidor');
        $servidor = new Servidor;
        $_MyCookie->LoadView('servidor', 'Edit', array('servidor' => $servidor, 'action' => 'Adicionar'));
    }

    public static function edit() {
        global $_MyCookie;
        $_MyCookie->goBackTo('administrator', 'servidor');
        $servidor = Servidor::select('o')->where('o.siape = ?1')
                        ->setParameter(1, $_MyCookie->getURLVariables(2))->getQuery()->getSingleResult();
        $_MyCookie->LoadView('servidor', 'Edit', array('action' => 'Editar', 'servidor' => $servidor));
    }
    
    public static function exists() {
        $servidor_exists = count(Servidor::select('o')->where('o.siape = ?1')
                        ->setParameter(1, filter_input(INPUT_POST, 'siape'))->getQuery()->getResult());
        if($servidor_exists && empty(filter_input(INPUT_POST, 'siape_check'))) {
            echo 'Este SIAPE já está cadastrado';
        }
    }

    public static function save() {        
        $servidor = (empty(filter_input(INPUT_POST, 'siape_check'))) ? new Servidor : Servidor::select('o')->where('o.siape = ?1')
                        ->setParameter(1, filter_input(INPUT_POST, 'siape'))->getQuery()->getSingleResult();
        $servidor
                ->setSIAPE(filter_input(INPUT_POST, 'siape'))
                ->setNome(filter_input(INPUT_POST, 'nome'))
                ->setTipo(filter_input(INPUT_POST, 'tipo'))
                ->setStatus(true)
                ->save();
        if(empty(filter_input(INPUT_POST, 'siape_check'))) {
           $conta = new Conta();
           $conta->setServidor($servidor)->save();
        }
        echo 'Servidor salvo com sucesso!';
    }
    
    public static function active() {
        Servidor::select('o')->where('o.siape = ?1')
                ->setParameter(1, filter_input(INPUT_POST, 'siape'))->getQuery()->getSingleResult()->setStatus(true)->save();
        echo 'Servidor ativado';
    }

    public static function deactive() {
        Servidor::select('o')->where('o.siape = ?1')
                ->setParameter(1, filter_input(INPUT_POST, 'siape'))->getQuery()->getSingleResult()->setStatus(false)->save();
        echo 'Servidor desativado';
    }

    public static function select($servidor) {
        global $_MyCookie;
        $servidores = Servidor::select('o')->where('o.status = 1')->orderBy('o.nome')->getQuery()->getResult();
        $siape = (empty($servidor)) ? null : $servidor->getSiape();
        $_MyCookie->LoadView('servidor', 'Select', array('servidores' => $servidores, 'siape' => $siape));
    }

}
