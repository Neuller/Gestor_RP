<?php 
session_start();

require_once "../../Classes/Conexao.php";
require_once "../../Classes/Pedidos.php";

$obj = new pedidos();

echo json_encode($obj -> obterDadosPedido($_POST['id']));
?>