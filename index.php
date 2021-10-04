<?php require_once "./Dependencias.php" ?>

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
	$(document).ready(function($) {
		initForm();
		setEvents();
	});

	function initForm() {
		$('#menuPrincipal').load('./Views/Menu/MenuPrincipal.php');
	}

	function setEvents() {

	}
</script>