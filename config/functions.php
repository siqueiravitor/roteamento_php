<?php
/**
 * Define uma rota para a aplicação.
 *
 * @param string $route A rota a ser definida.
 * @param callable $function A função a ser executada quando a rota for acessada.
 * @return void
 * @throws Exception Se a rota ou a função não forem válidas. // Não implementado
 * @example
 * route('/inicio', function() {
 *    return ['view' => 'home'];
 * });
 */ 
function route($route, $function)
{
    $url = rtrim($_SERVER['REQUEST_URI'], '/');
    $removeToken = strtok($url, '?');
    $trimToken = trim($removeToken, '/');
    $explodeUri = explode('/', $trimToken);
    $base = $explodeUri[0];

    $return = $function();
    $view = $return['view'] ?? null;
    $action = $return['action'] ?? null;

    if($url != $route){
        return;
    }
    
    // debug(
    //     'action: '.$action, 
    //     'base: '. $base,
    //     'view: '.$view, 
    //     'rota: '.$route, 
    //     'url: '. $url,
    //     $url == $route
    // );
    
    if (!$action && (urldecode($url) === urldecode($route) || urldecode($route) === 'index')) {
        call_page($base, $view);
    }
    
    call_action($base, $action);
}
function call_page($base, $arquivo)
{
    $file = VIEW . "{$base}/{$arquivo}.php";
    if (!file_exists($file)) {
        include_once VIEW . "erro/404.php";
        exit;
    }

    match ($base) {
        'login' => include_once VIEW . 'login/index.php',
        default => include_once $file
    };
    exit;
}
function call_action($base, $arquivo)
{
    $file = CONTROLLER . "{$base}/{$arquivo}.php";
    if (file_exists($file)) {
        exit(include_once $file);
    }
}
function redirect($url = '/')
{
    exit(header("Location: {$url}"));
}
function debug(...$array)
{
    echo "<PRE>";
    print_R($array);
    exit();
}
