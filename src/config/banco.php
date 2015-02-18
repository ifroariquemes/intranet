<?php

use lib\util\module;

return module\Module::createInstance()
                ->setName('Banco')
                ->setDescription('')
                ->addAuthor(module\Author::createInstance()
                        ->setName('Natanael Simões')
                        ->setEmail('natanael.simoes@ifro.edu.br'))
                ->setVersion('1.0')
                ->setCreationDate('2015-02-18')
                ->setLastReleaseDate('2015-02-18')
                ->setTile(module\Tile::createInstance()
                        ->setColor('blue')
                        ->setIcon('fa-clock-o'))
                ->setHome(module\Home::createInstance()
                        ->setControl('BancoController')
                        ->setAction('Manage'))
                ->addController(module\Controller::createInstance()
                        ->setName('BancoController'))
                ->addAccess('ADMINISTRATOR')
                ->addAccess('ENSINO');
