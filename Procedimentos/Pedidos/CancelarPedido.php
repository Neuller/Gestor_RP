<?php 
require_once "../../Classes/Conexao.php";
require_once "../../Classes/Pedidos.php";

$obj = new pedidos();

$dados = array(		
$_POST["id"] = strtoupper($_POST["id"]),
$_POST["lote"] = strtoupper($_POST["lote"]),
);

echo $obj -> CancelarPedido($dados);
?>