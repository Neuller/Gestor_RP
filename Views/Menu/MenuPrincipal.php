<html>

<body>
    <nav class="navbar-expand navbar-light">
        <div id="navbar">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        CONFIGURAÇÕES
                    </a>
                    <ul class="dropdown-menu">
                        <li><a id="backup" href="#" onclick="backupManual()">BACKUP MANUAL</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        ESTOQUE
                    </a>
                    <ul class="dropdown-menu">
                        <li><a id="cadastrarLote" href="#">CADASTRAR LOTE</a></li>
                    </ul>
                </li>

                <li><a id="paginaPrincipal" href="#">PÁGINA INICIAL</a></li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        PEDIDOS
                    </a>
                    <ul class="dropdown-menu">
                        <li><a id="acompanharPedidos" href="#">ACOMPANHAR PEDIDOS</a></li>
                        <li><a id="cadastrarPedido" href="#">CADASTRAR PEDIDOS</a></li>
                        <li><a id="todosPedidos" href="#">TODOS OS PEDIDOS</a></li>
                        <li><a id="vincularPedidos" href="#">VINCULAR PEDIDOS</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        RELATÓRIOS
                    </a>
                    <ul class="dropdown-menu">
                        <li><a id="relatorioDiario" href="#">RELATÓRIO DIÁRIO</a></li>
                        <li><a id="relatorioSemanal" href="#">RELATÓRIO SEMANAL</a></li>
                        <li><a id="relatorioMensal" href="#">RELATÓRIO MENSAL</a></li>
                        <li><a id="relatorioPersonalizado" href="#">RELATÓRIO PERSONALIZADO</a></li>
                    </ul>
                </li>
            </ul>

            <form class="form-inline">
                <button type="button" id="btnReport" class="btn btn-md btn-danger" title="REPORTAR PROBLEMA" data-toggle="modal" data-target="#modalReport">
                    <span class="glyphicon glyphicon-exclamation-sign"></span>
                </button>
            </form>
        </div>
    </nav>
</body>

<!-- MODAL REPORTAR PROBLEMA -->
<div class="modal fade" id="modalReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body itensForm">
                ENVIE SUA DÚVIDA, SUGESTÃO OU RELATE UM PROBLEMA.
                <form id="formReport">
                    <div>
                        <textarea type="text" class="form-control input-sm text-uppercase" id="report" name="report" maxlength="1000" rows="3" style="resize: none"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">FECHAR</button>
                <button type="button" class="btn btn-primary" id="btnEnviarReport">ENVIAR</button>
            </div>
        </div>
    </div>
</div>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        validarForm("formReport");
        camposObrigatorios(["report"], true);
    });

    $("#paginaPrincipal").click(function(e) {
        $("#conteudo").load("./Views/Principal/PaginaPrincipal.php");
    });

    $("#cadastrarPedido").click(function(e) {
        $("#conteudo").load("./Views/Pedidos/CadastrarPedido.php");
    });

    $("#vincularPedidos").click(function(e) {
        $("#conteudo").load("./Views/Pedidos/VincularPedido.php");
    });

    $("#cadastrarLote").click(function(e) {
        $("#conteudo").load("./Views/Estoque/Lote.php");
    });

    $("#acompanharPedidos").click(function(e) {
        $("#conteudo").load("./Views/Principal/AcompanharPedidos.php");
    });

    $("#todosPedidos").click(function(e) {
        $("#conteudo").load("./Views/Pedidos/TodosPedidos.php");
    });

    $("#relatorioDiario").click(function(e) {
        $("#conteudo").load("./Views/Relatorios/RelatorioDiario.php");
    });

    $("#relatorioSemanal").click(function(e) {
        $("#conteudo").load("./Views/Relatorios/RelatorioSemanal.php");
    });

    $("#relatorioMensal").click(function(e) {
        $("#conteudo").load("./Views/Relatorios/RelatorioMensal.php");
    });

    $("#relatorioPersonalizado").click(function(e) {
        $("#conteudo").load("./Views/Relatorios/RelatorioPersonalizado.php");
    });

    $("#btnEnviarReport").click(function() {
        var validator = $("#formReport").validate();
        validator.form();
        var checkValidator = validator.checkForm();

        if (checkValidator == false) {
            alertify.error("PREENCHA TODOS OS CAMPOS OBRIGATÓRIOS");
            return false;
        }

        dados = $("#formReport").serialize();

        $.ajax({
            type: "POST",
            data: dados,
            url: "./Procedimentos/TI/ReportarProblema.php",
            success: function(r) {
                if (r > 0) {
                    $("#formReport")[0].reset();
                    $("#modalReport").modal("hide");
                    alertify.success("ENVIO REALIZADO");
                } else {
                    alertify.error("NÃO FOI POSSÍVEL ENVIAR");
                }
            }
        });
    });
</script>