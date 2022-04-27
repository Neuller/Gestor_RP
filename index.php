<?php
require_once "./Dependencias.php";
clearstatcache();
?>

<!DOCTYPE html>
<html lang="pt-br">

<body>
	<div class="navbar navbar-light">
		<div class="container">
			<!-- <div class="logo" id="logo">
				<a class="navbar-brand" href="#"><img class="img-responsive img-thumbnail" src="./Img/Logo.png" title="GESTOR - RETIRADA DE PEDIDOS" width="200px" height="150px"></a>
			</div> -->

			<div id="menuPrincipal"></div>
		</div>

		<div>
			<img src="./Img/Banner.png" class="img-fluid" style="max-width: 100%">
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
	
    $("#logo").click(function(e) {
        $("#conteudo").load("./Views/Principal/PaginaPrincipal.php");
    });

	function backupManual() {
		alertify.confirm("BACKUP MANUAL", "GOSTARIA DE REALIZAR O BACKUP DA BASE ATUAL?", function() {
			alertify.confirm().close();
			$.ajax({
				url: "./Procedimentos/Configuracoes/BackupManual.php",
				success: function(r) {
					alertify.success("SUCESSO");
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