<?php
require_once '../config/load.php';
require_once '../config/conn.php';
require_once '../config/functions.php';

$requestUri = $_SERVER['REQUEST_URI'];
$removeToken = strtok($requestUri, '?');
$trimToken = trim($removeToken, '/');
$rota = explode('/', $trimToken)[0];
$rota = empty($rota) ? 'index.php' : $rota . '.php';

$page = __DIR__ . ROTAS . $rota;
if (file_exists($page)) {
    require_once $page;
} else {
    $page = __DIR__ . ROTAS . 'index.php';
    require_once $page;

    // Redireciona para a página inicial se a rota não existir
    redirect(); 
}

if (isset($_SESSION['idusuario'])) {
    redirect('/dashboard');
}

require_once VIEW . '/index.php';
