<?php 
require_once "../../Classes/Conexao.php";
require_once "../../Classes/Pedidos.php";

$obj = new pedidos();

$dados = array(		
$_POST['id'] = strtoupper($_POST['id']),
$_POST['taxaComissao'] = strtoupper($_POST['taxaComissao']),
$_POST['observacao'] = strtoupper($_POST['observacao'])
);

echo $obj -> AtualizarPedido($dados);
?>