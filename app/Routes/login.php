<?php
route('/login', function () {	
    return ['action' => 'auth'];	
});
redirect();