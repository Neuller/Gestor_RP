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
            <div class="text-center">
                <h3><strong>PEDIDOS EM ESTOQUE</strong></h3>
            </div>
        </div>

        <div class="row" id="tabelaPedidosEstoque"></div>
    </div>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function($) {
        initForm();
        setEvents();
    });

    function initForm() {
        $('#tabelaPedidosEstoque').load('./Views/Principal/TabelaPedidosEstoque.php');
    }

    function setEvents() {}

    function entregarPedido($id) {
        alertify.confirm('ATENÇÃO', 'CONFIRMAR ENTREGA DO PEDIDO?', function() {
            alertify.confirm().close();
            $.ajax({
                type: "POST",
                data: "idPedido=" + $id,
                url: "./Procedimentos/Pedidos/RealizarEntrega.php",
                success: function(r) {
                    if (r > 0) {
                        alertify.success("ENTREGA REALIZADA");
                    } else {
                        alertify.error("ERRO AO REALIZAR ENTREGA");
                    }
                }
            });
        }, function() {});
    }
</script>