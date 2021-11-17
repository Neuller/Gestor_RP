<?php
require_once "./Dependencias.php";
clearstatcache();
?>

<!DOCTYPE html>
<html lang="pt-br">

<body>
	<div class="container">
		<div class="container">
			<div id="menuPrincipal"></div>
		</div>

		<div id="conteudo"></div>
	</div>
</body>

</html>

<script type="text/javascript">
	$(document).ready(function() {
		$("#menuPrincipal").load("./Views/Menu/MenuPrincipal.php");
		$("#conteudo").load("./Views/Principal/PaginaPrincipal.php");
	});

	function backupManual() {
		alertify.confirm("BACKUP MANUAL", "GOSTARIA DE REALIZAR O BACKUP DA BASE ATUAL?", function() {
			alertify.confirm().close();
			$.ajax({
				url: "./Procedimentos/Configuracoes/BackupManual.php",
				success: function(r) {
					alertify.success("BACKUP REALIZADO COM SUCESSO");
				}
			});
		}, function() {}).set({
			labels: {
				ok: "SIM",
				cancel: "NÃO"
			}
		});
	}
</script>