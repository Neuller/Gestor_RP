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
            <div class="cabecalho bgPrincipal">
                <div class="tituloForm">
                    <h3><strong>PEDIDOS AGUARDANDO RETIRADA DO CLIENTE</strong></h3>
                </div>
            </div>

            <div class="row" id="tabelaPedidosPendentesRetirada"></div>
        </div>
        <div>
            <div class="cabecalho bgPrincipal">
                <div class="tituloForm">
                    <h3><strong>PEDIDOS AGUARDANDO BAIXA NO APLICATIVO</strong></h3>
                </div>
            </div>

            <div class="row" id="tabelaPedidosPendentesBaixa"></div>
        </div>
    </div>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        $("#tabelaPedidosPendentesRetirada").load("./Views/Principal/TabelaPedidosPendentesRetirada.php");
        $("#tabelaPedidosPendentesBaixa").load("./Views/Principal/TabelaPedidosPendentesBaixa.php");
    });

    function entregaRapida(idPedido, idCaixa) {
        alertify.confirm("ATENÇÃO", "CONFIRMAR ENTREGA RÁPIDA DO PEDIDO?", function() {
            alertify.confirm().close();
            $.ajax({
                type: "POST",
                data: "id=" + idPedido,
                url: "./Procedimentos/Pedidos/ObterDadosPedido.php",
                success: function(r) {
                    dado = jQuery.parseJSON(r);
                    $.ajax({
                        type: "POST",
                        data: {
                            idPedido: idPedido,
                            nomeCliente: dado.nome_cliente,
                            idCaixa: idCaixa
                        },
                        url: "./Procedimentos/Pedidos/RealizarEntrega.php",
                        success: function(r) {
                            if (r > 0) {
                                $("#tabelaPedidosPendentesRetirada").load("./Views/Principal/tabelaPedidosPendentesRetirada.php");
                                $("#tabelaPedidosPendentesBaixa").load("./Views/Principal/TabelaPedidosPendentesBaixa.php");
                                alertify.success("ENTREGA REALIZADA");
                            } else {
                                $("#tabelaPedidosPendentesRetirada").load("./Views/Principal/tabelaPedidosPendentesRetirada.php");
                                $("#tabelaPedidosPendentesBaixa").load("./Views/Principal/TabelaPedidosPendentesBaixa.php");
                                alertify.error("ERRO AO REALIZAR ENTREGA, CONTATE O ADMINISTRADOR");
                            }
                        }
                    });
                }
            });
        }, function() {}).set({
            labels: {
                ok: "SIM",
                cancel: "NÃO"
            }
        });
    }

    function baixaPedido(id) {
        alertify.confirm("ATENÇÃO", "CONFIRMAR BAIXA DO PEDIDO?", function() {
            alertify.confirm().close();
            $.ajax({
                type: "POST",
                data: "idPedido=" + id,
                url: "./Procedimentos/Pedidos/RealizarBaixaApp.php",
                success: function(r) {
                    if (r > 0) {
                        $("#tabelaPedidosPendentesRetirada").load("./Views/Principal/tabelaPedidosPendentesRetirada.php");
                        $("#tabelaPedidosPendentesBaixa").load("./Views/Principal/TabelaPedidosPendentesBaixa.php");
                        alertify.success("BAIXA DO PEDIDO REALIZADA");
                    } else {
                        $("#tabelaPedidosPendentesRetirada").load("./Views/Principal/tabelaPedidosPendentesRetirada.php");
                        $("#tabelaPedidosPendentesBaixa").load("./Views/Principal/TabelaPedidosPendentesBaixa.php");
                        alertify.error("ERRO AO REALIZAR BAIXA, CONTATE O ADMINISTRADOR");
                    }
                }
            });
        }, function() {}).set({
            labels: {
                ok: "SIM",
                cancel: "NÃO"
            }
        });
    }

    function visualizarPedido(id) {
        $("#conteudo").load("./Views/Pedidos/VisualizarPedido.php?id=" + id);
    }
</script>