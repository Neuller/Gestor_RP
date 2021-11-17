<?php
require_once "../../Classes/Conexao.php";
require_once "../../Classes/Pedidos.php";

$c = new conectar();
$conexao = $c->conexao();
$obj = new pedidos();

$sqlAguardandoRetirada = "SELECT COUNT(id_pedido) FROM estoque_pedidos WHERE status = 'AGUARDANDO RETIRADA'";
$sqlTotalPedidos = "SELECT COUNT(id_pedido) FROM estoque_pedidos";
$sqlPedidosEntregues = "SELECT COUNT(id_pedido) FROM estoque_pedidos WHERE status = 'ENTREGA E BAIXA REALIZADA' OR status = 'PENDENTE BAIXA NO APP'";
$sqlPedidosCancelados = "SELECT COUNT(id_pedido) FROM estoque_pedidos WHERE status = 'PEDIDO CANCELADO'";

$rSQlPedidosEstoque = mysqli_query($conexao, $sqlAguardandoRetirada);
$rSQlTotalPedidos = mysqli_query($conexao, $sqlTotalPedidos);
$rSQLPedidosEntregues = mysqli_query($conexao, $sqlPedidosEntregues);
$rSQLPedidosCancelados = mysqli_query($conexao, $sqlPedidosCancelados);
?>

<!DOCTYPE html>
<html lang="pt-br">

<body>
    <div class="container">
        <div class="cabecalho bgPrincipal">
            <div class="tituloForm">
                <h3><strong>GESTOR - RETIRADA DE PEDIDOS</strong></h3>
            </div>
        </div>

        <div class="linha">
            <div class="card coluna-20">
                <div class="card-body">
                    <h5 class="card-title">TOTAL DE PEDIDOS</h5>
                    <h6 class="card-subtitle mb-2 text-muted" style="color: red">CANCELADOS</h6>
                    <?php
                    while ($mostrar = mysqli_fetch_array($rSQLPedidosCancelados)) {
                        echo
                        '
						<p class="card-text">' . $mostrar[0] . '</p>
						';
                    }
                    ?>
                </div>
            </div>

            <div class="card coluna-20">
                <div class="card-body">
                    <h5 class="card-title">TOTAL DE PEDIDOS</h5>
                    <h6 class="card-subtitle mb-2 text-muted" style="color: orange">EM ESTOQUE</h6>
                    <?php
                    while ($mostrar = mysqli_fetch_array($rSQlPedidosEstoque)) {
                        echo
                        '
						<p class="card-text">' . $mostrar[0] . '</p>
						';
                    }
                    ?>
                </div>
            </div>

            <div class="card coluna-20">
                <div class="card-body">
                    <h5 class="card-title">TOTAL DE PEDIDOS</h5>
                    <h6 class="card-subtitle mb-2 text-muted" style="color: green">ENTREGUES</h6>
                    <?php
                    while ($mostrar = mysqli_fetch_array($rSQLPedidosEntregues)) {
                        echo
                        '
						<p class="card-text">' . $mostrar[0] . '</p>
						';
                    }
                    ?>
                </div>
            </div>

            <div class="card coluna-20">
                <div class="card-body">
                    <h5 class="card-title">TOTAL DE PEDIDOS</h5>
                    <h6 class="card-subtitle mb-2 text-muted" style="font-weight: bold; color: black;">GERAL</h6>
                    <?php
                    while ($mostrar = mysqli_fetch_array($rSQlTotalPedidos)) {
                        echo
                        '
						<p class="card-text">' . $mostrar[0] . '</p>
						';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        initForm();
        setEvents();
    });

    function initForm() {}

    function setEvents() {

    }
</script>