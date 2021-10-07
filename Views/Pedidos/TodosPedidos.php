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
        $("#tabelaTodosPedidos").load("./Views/Pedidos/tabelaTodosPedidos.php");
    }

    function setEvents() {}

    function visualizarPedido(id) {
        $("#conteudo").load("./Views/Pedidos/VisualizarPedido.php?id=" + id + "?page=todosPedidos");
    }
</script>