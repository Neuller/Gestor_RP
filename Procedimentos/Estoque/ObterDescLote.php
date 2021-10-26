<?php 
require_once "../../Classes/Conexao.php";
require_once "../../Classes/Estoque.php";

$obj = new estoque();

echo json_encode($obj -> DescLote($_POST['idLote']));
?>