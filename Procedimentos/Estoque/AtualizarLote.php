<?php 
require_once "../../Classes/Conexao.php";
require_once "../../Classes/Estoque.php";

$obj = new estoque();

$dados = array(		
$_POST['id'] = strtoupper($_POST['id']),
$_POST['descricao'] = strtoupper($_POST['descricao'])
);

echo $obj -> AtualizarCaixa($dados);
?>