<?php
use App\Controller\FuncionariosController;
require_once('vendor/autoload.php');
require_once('src/config/env.php');

$controller = new FuncionariosController();

$action = $_GET['a'] ?? 'index';

$controller->{$action}();