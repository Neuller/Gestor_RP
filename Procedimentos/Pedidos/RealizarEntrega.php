<?php 
session_start();
require_once "../../Classes/Conexao.php";
require_once "../../Classes/Pedidos.php";

$obj = new pedidos();

$idPedido = $_POST["idPedido"];
$idCaixa = $_POST["idCaixa"];
$nomeCliente = $_POST["nomeCliente"];

echo $obj -> RealizarEntrega($idPedido, $idCaixa, $nomeCliente);
?>