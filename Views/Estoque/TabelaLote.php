<?php
require_once "../../Classes/Conexao.php";
require_once "../../Classes/Utilitarios.php";

$c = new conectar();
$conexao = $c -> conexao();
$objUtils = new utilitarios();

$dataAtual = date('m');

$sql = "SELECT id_caixa , descricao
FROM estoque_caixas 
WHERE status NOT LIKE 'INATIVO'
ORDER BY id_caixa DESC";

$result = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html>
	<body>
		<div class="table-responsive">
			<table id="tblLote" class="table table-hover table-condensed table-bordered text-center table-striped">
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
                                <td>'.'<span class="btn btn-primary btn-md" data-toggle="modal" title="VISUALIZAR" data-target="#visualizarLote" onclick="visualizar('.$mostrar[0].')"">
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

<script>
	$(document).ready(function() {
		$("#tblLote").dataTable({
			language: {
				lengthMenu: "_MENU_ REGISTROS POR PÁGINA",
				zeroRecords: "NENHUM REGISTRO ENCONTRADO",
				info: "PÁGINA _PAGE_ DE _PAGES_",
				infoEmpty: "Nenhum registro foi encontrado",
				infoFiltered: "(FILTRADO DE _MAX_ REGISTROS NO TOTAL)",
				search: "PESQUISAR: ",
				paginate: {
					"first": "PRIMEIRO",
					"last": "ÚLTIMO",
					"next": "PRÓXIMO",
					"previous": "ANTERIOR"
				}
			}
		});
	});
</script>