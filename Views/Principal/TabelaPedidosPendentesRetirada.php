<?php
require_once "../../Classes/Conexao.php";
require_once "../../Classes/Pedidos.php";
require_once "../../Classes/Utilitarios.php";

$c = new conectar();
$conexao = $c -> conexao();
$obj = new pedidos();
$objUtils = new utilitarios();


$sql = "SELECT id_pedido , codigo, nome_cliente, id_caixa, observacoes, data_entrada, data_saida, status
FROM estoque_pedidos 
WHERE status NOT LIKE 'PENDENTE BAIXA NO APP'
AND status NOT LIKE 'ENTREGA E BAIXA REALIZADA'
ORDER BY id_pedido DESC";

$result = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>

<body>
	<div class="table-responsive">
		<table id="tabelaPedidosAguardandoRetirada" class="table table-hover table-condensed table-bordered text-center table-striped">
			<thead>
				<tr>
					<td>CÓDIGO</td>
					<td>NOME DO CLIENTE</td>
					<td>LOCALIZAÇÃO</td>
					<td>STATUS</td>
					<td>VISUALIZAR</td>
					<td>ENTREGA RÁPIDA</td>
				</tr>
			</thead>
			<tbody>
				<?php
				while ($mostrar = mysqli_fetch_array($result)) {
					echo
					'
						<tr>
						<td>' . $mostrar[1] . '</td>
						<td>' . $mostrar[2] . '</td>
						<td>' . $objUtils -> nomeEstoqueCaixa($mostrar[3]) . '</td>
						<td>' . $mostrar[7] . '</td>
						<td>' . '<span class="btn btn-primary btn-lg" data-toggle="modal" data-target="#visualizarPedido" title="VISUALIZAR" onclick="visualizarPedido('.$mostrar[0].')">
						<span class="glyphicon glyphicon-search"></span>
						</span>' . '</td>		
                        <td>' . '<span class="btn btn-success btn-lg" data-toggle="modal" data-target="#entregaRapida" title="ENTREGA RÁPIDA" onclick="entregaRapida('.$mostrar[0].')">
						<span class="glyphicon glyphicon-ok-sign"></span>
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
		$("#tabelaPedidosAguardandoRetirada").dataTable({
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