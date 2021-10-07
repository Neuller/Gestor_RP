<?php 
require_once "../../Classes/Conexao.php";
require_once "../../Classes/Estoque.php";

$obj = new estoque();

$dados = array(		
$_POST['id'] = strtoupper($_POST['id'])
);

echo $obj -> InativarCaixa($dados);
?>