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
        <div class="cabecalho bgPrincipal">
            <div class="tituloForm">
                <h3><strong>VINCULAR PEDIDOS</strong></h3>
            </div>
        </div>
        <div>
            <div class="mx-auto">
                <form id="formulario">
                    <div>
                        <div class="col-md-12 col-sm-12 col-xs-12 itensForm">
                            <div>
                                <label>SELECIONE UM CLIENTE</label>
                                <select class="form-control input-sm" id="clienteSelect" name="clienteSelect">
                                    <option value="">SELECIONE UM CLIENTE</option>
                                    <?php
                                    $sql = "SELECT id_pedido, codigo, nome_cliente FROM estoque_pedidos WHERE status LIKE 'AGUARDANDO RETIRADA' GROUP BY nome_cliente ORDER BY nome_cliente DESC";
                                    $result = mysqli_query($conexao, $sql);

                                    while ($mostrar = mysqli_fetch_row($result)) :
                                    ?>
                                        <option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1] ?> - <?php echo $mostrar[2] ?></option>
                                    <?php endwhile; ?>
                                </select>
                                <input type="hidden" class="form-control input-sm text-uppercase" id="AUX_nomeCliente" name="AUX_nomeCliente">
                            </div>
                        </div>

                        <div id="groupCliente">
                            <div class="col-md-4 col-sm-4 col-xs-4 itensForm">
                                <div>
                                    <label>CÓDIGO</label>
                                    <input type="number" class="form-control input-sm text-uppercase" id="codigo" name="codigo">
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-4 itensForm">
                                <div>
                                    <label>LOCALIZAÇÃO</label>
                                    <input type="text" readonly class="form-control input-sm text-uppercase" id="lote" name="lote">
                                    <input type="hidden" class="form-control input-sm text-uppercase" id="AUX_lote" name="AUX_lote">
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-4 itensForm">
                                <div>
                                    <label>DATA DE ENTRADA</label>
                                    <input type="date" class="form-control text-uppercase input-sm" id="dataEntrada" name="dataEntrada">
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 itensForm">
                                <div class="text-left">
                                    <h4><strong>OBSERVAÇÕES </strong> <span class="glyphicon glyphicon-exclamation-sign ml-15"></span></h4>
                                </div>
                                <hr>
                                <div>
                                    <textarea type="text" class="form-control input-sm text-uppercase" id="observacao" name="observacao" maxlength="1000" rows="3" style="resize: none"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div>
                                    <span class="btn btn-primary btn-lg btnLayout" id="btnVincular" title="VINCULAR">VINCULAR</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
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

    function initForm() {
        validarForm("formulario");
        mostrarCampo(["groupCliente"], false);
        $("#clienteSelect").select2();
    }

    function setEvents() {
        $("#btnVincular").click(function() {
            var validator = $("#formulario").validate();
            validator.form();
            var checkValidator = validator.checkForm();

            if (checkValidator == false) {
                alertify.error("PREENCHA TODOS OS CAMPOS OBRIGATÓRIOS");
                return false;
            }

            dados = $("#formulario").serialize();

            $.ajax({
                type: "POST",
                data: dados,
                url: "./Procedimentos/Pedidos/VincularPedido.php",
                success: function(r) {
                    if (r > 0) {
                        $("#conteudo").load("./Views/Pedidos/VincularPedido.php");
                        alertify.success("VÍNCULO ENTRE PEDIDOS REALIZADO");
                    } else {
                        $("#conteudo").load("./Views/Pedidos/VincularPedido.php");
                        alertify.error("NÃO FOI POSSÍVEL VINCULAR");
                    }
                }
            });
        });

        $("#dataEntrada").change(function() {
            var dataEntrada = $("#dataEntrada").val();
            var dataAtual = moment().format('YYYY-MM-DD');
            if (dataEntrada > dataAtual) {
                alertify.alert("ATENÇÃO", "DATA DE ENTRADA NÃO PODE SER MAIOR QUE A DATA ATUAL.");
                $("#dataEntrada").val("");
            }
        });

        $("#clienteSelect").change(function() {
            var cliente = $("#clienteSelect").val();
            if (cliente != "") {
                mostrarCampo(["groupCliente"], true);
                campoObrigatorio(["clienteSelect", "codigo", "dataEntrada"], true);
                $.ajax({
                    type: "POST",
                    data: "id=" + cliente,
                    url: "./Procedimentos/Pedidos/ObterDadosPedido.php",
                    success: function(r) {
                        dado = jQuery.parseJSON(r);
                        $("#AUX_nomeCliente").val(dado.nome_cliente);
                        $.ajax({
                            type: "POST",
                            data: "idLote=" + dado.id_caixa,
                            url: './Procedimentos/Estoque/ObterDescLote.php',
                        }).then(function(data) {
                            var lote = JSON.parse(data);
                            $("#lote").val(lote);
                            $("#AUX_lote").val(dado.id_caixa);
                        });
                    }
                });
            } else {
                mostrarCampo(["groupCliente"], false);
            }
        });
    }
</script>