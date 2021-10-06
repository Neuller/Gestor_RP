<?php 
session_start();
require_once "../../Classes/Conexao.php";
require_once "../../Classes/TI.php";

$obj = new ti();

$dados = array(		
$_POST['report'] = strtoupper($_POST['report'])
);

echo $obj -> ReportarProblema($dados);
?>