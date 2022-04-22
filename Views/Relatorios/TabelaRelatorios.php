<?php
require_once "../../Classes/Conexao.php";
require_once "../../Classes/Utilitarios.php";

$c = new conectar();
$conexao = $c -> conexao();
$objUtils = new utilitarios();

$data1 = $_GET["data1"];
$data2 = $_GET["data2"];

$sql = "SELECT codigo, nome_cliente, id_caixa, data_entrada, data_saida, status, data_saida_baixa, taxa_comissao
FROM estoque_pedidos 
WHERE data_entrada >= '$data1' AND data_entrada <= '$data2'
ORDER BY id_pedido DESC";

$result = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>

<body>
	<div class="table-responsive">
		<table id="tableRelatorios" class="table table-hover table-condensed table-bordered text-center table-striped">
			<thead>
				<tr>
					<td>CÓDIGO</td>
					<td>NOME DO CLIENTE</td>
					<td>LOCALIZAÇÃO</td>
					<td>STATUS</td>
					<td>COMISSÃO</td>
					<td>DATA DE ENTRADA</td>
					<td>DATA DE SAÍDA</td>
					<td>DATA DE BAIXA</td>
				</tr>
			</thead>
			<tbody>
				<?php
				while ($mostrar = mysqli_fetch_array($result)) {
					echo
					'<tr>
						<td>' . $mostrar[0] . '</td>
						<td>' . $mostrar[1] . '</td>
						<td>' . $objUtils -> nomeEstoqueCaixa($mostrar[2]) . '</td>
						<td>' . $mostrar[5] . '</td>
						<td>' . $mostrar[7] . '</td>
                        <td>' . $objUtils -> data($mostrar[3]) . '</td>
                        <td>' . $objUtils -> data($mostrar[4]) . '</td>
                        <td>' . $objUtils -> data($mostrar[6]) . '</td>
						</span>' . '</td>					
					</tr>';
				}
				?>
			</tbody>
		</table>
	</div>
</body>

</html>

<script>
	$(document).ready(function() {
        $("#tableRelatorios").dataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf'
            ],
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