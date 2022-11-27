<?php
return [
  '/cidadao/cadastrar' => [
      'controller' => App\Controllers\CidadaoController::class,
      'action' => 'cadastrar',
      'name' => 'cadastrar',
  ],
  '/cidadao/excluir/:id' => [
      'controller' => App\Controllers\CidadaoController::class,
      'action' => 'deletar',
      'name' => 'excluir',
  ],
  '/cidadaos' => [
      'controller' => App\Controllers\CidadaoController::class,
      'action' => 'listar',
      'name' => 'listar',
  ],
  '/buscar' => [
      'controller' => App\Controllers\CidadaoController::class,
      'action' => 'buscar',
      'name' => 'buscar',
  ],
];