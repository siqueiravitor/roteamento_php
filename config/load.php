<?php
require_once(__DIR__ . "/../vendor/autoload.php");
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '../.env');
$dotenv->safeLoad();

$mostrarErros = $_ENV['ERROS'];
if ($mostrarErros) {
    ini_set('display_errors', $mostrarErros);
    error_reporting(E_ERROR | E_PARSE | E_WARNING | E_ALL);
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Erros no MySql deverão ser tratados corretamente
}

ini_set('session.cookie_secure', '1');
ini_set('session.cookie_httponly', '1');
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

define('ROTAS', '/../app/Routes/');
define('VIEW', '../app/View/');
define('CONTROLLER', '../app/Controller/');

session_start();