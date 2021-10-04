<?php 
session_start();
require_once "../../Classes/Conexao.php";
require_once "../../Classes/Pedidos.php";

$obj = new pedidos();

$id = $_POST["idPedido"];

echo $obj -> RealizarBaixa($id);
?>