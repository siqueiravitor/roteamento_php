<?php
route('/unidades/cadastrar', function () {	
    return ['view' => 'cadastrar'];	
});
route('/unidades/registrar', function () {	
    return ['action' => 'registrar'];	
});
route('/unidades', function () {
    return ['view' => 'index'];	
});
redirect();
