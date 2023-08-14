<?php

use Glowie\Controllers\Front;
use Glowie\Core\Http\Rails;
use Glowie\Controllers\Main;

// LISTAGEM DE PESSOAS E CONTATOS
Rails::addRoute('/', Front::class, 'index');
Rails::addRoute('visualizar/:id', Front::class, 'visualizar');

// REST API - ENDPOINT PESSOAS
Rails::addRoute('pessoas', Main::class, 'pessoas');
Rails::addRoute('pessoas/:id', Main::class, 'pessoas');

// REST API - ENDPOINT CONTATOS
Rails::addRoute('contatos/:id', Main::class, 'contatos');
