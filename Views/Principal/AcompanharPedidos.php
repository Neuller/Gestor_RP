<!DOCTYPE html>
<html>

<head>
    <?php require_once "../../Classes/Conexao.php";
    $c = new conectar();
    $conexao = $c->conexao();
    ?>
</head>

<body>
    <div class="container">
        <div>
            <div>
                <div class="text-center">
                    <h3><strong>PEDIDOS AGUARDANDO RETIRADA DO CLIENTE</strong></h3>
                </div>
            </div>

            <div class="row" id="tabelaPedidosEstoque"></div>
        </div>

        <div>
            <div>
                <div class="text-center">
                    <h3><strong>PEDIDOS AGUARDANDO BAIXA NO APLICATIVO</strong></h3>
                </div>
            </div>

            <div class="row" id="tabelaPedidosPendentesBaixa"></div>
        </div>

        <div>
            <div>
                <div class="text-center">
                    <h3><strong>TODOS OS PEDIDOS</strong></h3>
                </div>
            </div>

            <div class="row" id="tabelaTodosPedidos"></div>
        </div>
    </div>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        initForm();
        setEvents();
    });

    function initForm() {
        $('#tabelaPedidosEstoque').load('./Views/Principal/TabelaPedidosEstoque.php');
        $('#tabelaPedidosPendentesBaixa').load('./Views/Principal/TabelaPedidosPendentesBaixa.php');
        $('#tabelaTodosPedidos').load('./Views/Principal/tabelaTodosPedidos.php');
    }

    function setEvents() {}

    function entregarPedido($id) {
        alertify.confirm('ATENÇÃO', 'CONFIRMAR ENTREGA RÁPIDA DO PEDIDO?', function() {
            alertify.confirm().close();
            $.ajax({
                type: "POST",
                data: "idPedido=" + $id,
                url: "./Procedimentos/Pedidos/RealizarEntrega.php",
                success: function(r) {
                    if (r > 0) {
                        $('#tabelaPedidosEstoque').load('./Views/Principal/TabelaPedidosEstoque.php');
                        $('#tabelaPedidosPendentesBaixa').load('./Views/Principal/TabelaPedidosPendentesBaixa.php');
                        alertify.success("ENTREGA REALIZADA");
                    } else {
                        alertify.error("ERRO AO REALIZAR ENTREGA");
                    }
                }
            });
        }, function() {});
    }

    function baixaPedido($id) {
        alertify.confirm('ATENÇÃO', 'CONFIRMAR BAIXA DO PEDIDO?', function() {
            alertify.confirm().close();
            $.ajax({
                type: "POST",
                data: "idPedido=" + $id,
                url: "./Procedimentos/Pedidos/RealizarBaixaApp.php",
                success: function(r) {
                    if (r > 0) {
                        $('#tabelaPedidosEstoque').load('./Views/Principal/TabelaPedidosEstoque.php');
                        $('#tabelaPedidosPendentesBaixa').load('./Views/Principal/TabelaPedidosPendentesBaixa.php');
                        alertify.success("BAIXA NO PEDIDO REALIZADA");
                    } else {
                        alertify.error("ERRO AO REALIZAR BAIXA");
                    }
                }
            });
        }, function() {});
    }
</script>