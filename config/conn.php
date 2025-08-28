<?php
$mysql_host = $_ENV['DB_HOST'];
$mysql_usuario = $_ENV['DB_USUARIO'];
$mysql_senha = $_ENV['DB_SENHA'];
$mysql_schema = $_ENV['DB_SCHEMA'];
$con = mysqli_connect('p:' . $mysql_host, $mysql_usuario, $mysql_senha, $mysql_schema);

$sql = "SET NAMES 'utf8'";
mysqli_query($con, $sql);

$sql = 'SET character_set_connection=utf8';
mysqli_query($con, $sql);

$sql = 'SET character_set_client=utf8';
mysqli_query($con, $sql);

$sql = 'SET character_set_results=utf8';
$res = mysqli_query($con, $sql);
