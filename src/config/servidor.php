<?php

use lib\util\module;

return module\Module::createInstance()
                ->setName('Servidores')
                ->setDescription('')
                ->addAuthor(module\Author::createInstance()
                        ->setName('Natanael Simões')
                        ->setEmail('natanael.simoes@ifro.edu.br'))
                ->setVersion('1.0')
                ->setCreationDate('2015-02-18')
                ->setLastReleaseDate('2015-02-18')
                ->setTile(module\Tile::createInstance()
                        ->setColor('green')
                        ->setIcon('fa-group'))
                ->setHome(module\Home::createInstance()
                        ->setControl('ServidorController')
                        ->setAction('Manage'))
                ->addController(module\Controller::createInstance()
                        ->setName('ServidorController'))
                ->addAccess('ADMINISTRATOR')
                ->addAccess('ENSINO');
