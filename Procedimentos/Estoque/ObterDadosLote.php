<?php 
session_start();

require_once "../../Classes/Conexao.php";
require_once "../../Classes/Estoque.php";

$obj = new estoque();

echo json_encode($obj -> obterDadosLote($_POST['id']));
?>