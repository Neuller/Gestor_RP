<?php 
session_start();
require_once "../../Classes/Conexao.php";
require_once "../../Classes/Pedidos.php";

$obj = new pedidos();

$idPedido = $_POST["idPedido"];
$nomeCliente = $_POST["nomeCliente"];
$idCaixa = $_POST["idCaixa"];

echo $obj -> RealizarEntrega($idPedido, $nomeCliente, $idCaixa);
?>