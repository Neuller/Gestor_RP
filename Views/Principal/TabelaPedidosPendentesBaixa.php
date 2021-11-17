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
WHERE status LIKE 'PENDENTE BAIXA NO APP'
ORDER BY id_pedido DESC";

$result = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>

<body>
	<div class="table-responsive">
		<table id="tabelaPedidosPendentesBaixa" class="table table-hover table-condensed table-bordered text-center table-striped">
			<thead>
				<tr>
					<td>CÓDIGO</td>
					<td>NOME DO CLIENTE</td>
					<td>STATUS</td>
					<td>CONFIRMAR BAIXA</td>
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
						<td>' . $mostrar[7] . '</td>	
                        <td>' . '<span class="btn btn-success btn-md" data-toggle="modal" data-target="#baixaPedido" title="CONFIRMAR BAIXA" onclick="baixaPedido('.$mostrar[0].')">
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
	});
</script>