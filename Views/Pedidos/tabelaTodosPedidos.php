<?php
require_once "../../Classes/Conexao.php";
require_once "../../Classes/Pedidos.php";
require_once "../../Classes/Utilitarios.php";

$c = new conectar();
$conexao = $c -> conexao();
$obj = new pedidos();
$objUtils = new utilitarios();


$sql = "SELECT id_pedido , codigo, nome_cliente, id_caixa, observacoes, data_entrada, data_saida, status, data_saida_baixa
FROM estoque_pedidos 
ORDER BY id_pedido DESC";

$result = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>

<body>
	<div class="table-responsive">
		<table id="tblTodosPedidos" class="table table-hover table-condensed table-bordered text-center table-striped">
			<thead>
				<tr>
					<td>CÓDIGO</td>
					<td>NOME DO CLIENTE</td>
					<td>DATA DE ENTREGA</td>
					<td>VISUALIZAR</td>
				</tr>
			</thead>
			<tbody>
				<?php
				while ($mostrar = mysqli_fetch_array($result)) {
					if ($mostrar[6] != null) {
						$data = date('d/m/Y', strtotime($mostrar[6]));
					} else {
						$data = "";
					}
					echo
					'
						<tr>
						<td>' . $mostrar[1] . '</td>
						<td>' . $mostrar[2] . '</td>
						<td>' . $data . '</td>
						<td>' . '<span class="btn btn-primary btn-md" data-toggle="modal" data-target="#visualizarPedido" title="VISUALIZAR" onclick="visualizarPedido(' . $mostrar[0] . ')">
						<span class="glyphicon glyphicon-search"></span>
						</span>' . '</td>				
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
		$('#tblTodosPedidos').dataTable({
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