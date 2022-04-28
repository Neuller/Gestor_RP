<?php 
require_once "../../Classes/Conexao.php";
require_once "../../Classes/Pedidos.php";

$obj = new pedidos();

$dados = array(		
$_POST["id"] = strtoupper($_POST["id"]),
$_POST["lote"] = strtoupper($_POST["lote"]),
$_POST["taxaComissao"] = strtoupper($_POST["taxaComissao"]),
$_POST["observacao"] = strtoupper($_POST["observacao"]),
$_POST["loteAnterior"] = strtoupper($_POST["loteAnterior"]),
$_POST["valorPedido"] = strtoupper($_POST["valorPedido"])
);

echo $obj -> AtualizarPedido($dados);
?>