<?php
require_once "../../Classes/Conexao.php";
require_once "../../Classes/Utilitarios.php";

$c = new conectar();
$conexao = $c -> conexao();
$objUtils = new utilitarios();

$dataAtual = date('m');

$sql = "SELECT id_caixa , descricao
FROM estoque_caixas 
ORDER BY id_caixa DESC";

$result = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html>
	<body>
		<div class="table-responsive">
			<table id="tabela" class="table table-hover table-condensed table-bordered text-center table-striped">
				<thead>
					<tr>
						<td>DESCRIÇÃO</td>
						<td>VISUALIZAR</td>
					</tr>
				</thead> 
				<tbody>
					<?php
						while($mostrar = mysqli_fetch_array($result))
						{
							echo 
							'
							<tr>
                                <td>'.$mostrar[1].'</td>
                                <td>'.'<span class="btn btn-primary btn-md" data-toggle="modal" title="VISUALIZAR" data-target="#visualizarCaixa" onclick="visualizar('.$mostrar[0].')"">
                                <span class="glyphicon glyphicon-search"></span>
                                </span>'.'</td>									
							</tr>
							';
						}
					?>
				</tbody>
			</table>
		</div>
	</body>
</html>
