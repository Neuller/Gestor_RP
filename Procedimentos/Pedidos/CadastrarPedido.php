<?php 
session_start();
require_once "../../Classes/Conexao.php";
require_once "../../Classes/Pedidos.php";

$obj = new pedidos();

$dados = array(		
$_POST['codigo'] = strtoupper($_POST['codigo']),
$_POST['nomeCliente'] = strtoupper($_POST['nomeCliente']),
$_POST['caixaSelect'] = strtoupper($_POST['caixaSelect']),
$_POST['observacao'] = strtoupper($_POST['observacao'])
);

echo $obj -> CadastrarPedido($dados);
?>