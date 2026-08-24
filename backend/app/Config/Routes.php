<?php

/**
 * Camada: ROUTE
 * Responsabilidade: mapear endpoints HTTP para métodos do Controller.
 * Não contém lógica de negócio nem validação — apenas roteamento.
 */

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->group('api/solicitacoes', function ($routes) {
    $routes->get('/', 'SolicitacaoController::index');       // Listar todas
    $routes->get('(:num)', 'SolicitacaoController::show/$1'); // Buscar uma
    $routes->post('/', 'SolicitacaoController::create');      // Criar nova
    $routes->put('(:num)', 'SolicitacaoController::update/$1'); // Atualizar status
    $routes->delete('(:num)', 'SolicitacaoController::delete/$1'); // Cancelar
});
