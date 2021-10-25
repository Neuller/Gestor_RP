<?php 
require_once "../../Classes/Conexao.php";
require_once "../../Classes/Estoque.php";

$obj = new estoque();

$descricao = $_POST['descricao'];

echo json_encode($obj -> ConsultarCadastroLote($descricao));
?>