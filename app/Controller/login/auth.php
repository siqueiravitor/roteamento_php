<?php

$_SESSION['idusuario'] = true;
$_SESSION['nome'] = "Vitor Siqueira";
$_SESSION['email'] = $_POST['email'];
$_SESSION['nivel'] = 1; // 1 - Admin | 2 - User

redirect('/dashboard');