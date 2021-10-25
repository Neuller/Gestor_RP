<!DOCTYPE html>
<html>

<head>
    <?php require_once "../../Classes/Conexao.php";
    $c = new conectar();
    $conexao = $c->conexao();
    $id = $_GET["id"];
    ?>
</head>

<body>
    <div class="container">
        <div class="cabecalho bgPrincipal">
            <div class="tituloForm">
                <h3><strong>VISUALIZAR PEDIDO</strong></h3>
            </div>
        </div>
        <div class="divFormulario">
            <div class="mx-auto">
                <form id="formulario">
                    <div>
                        <input type="text" hidden="" id="id" name="id">

                        <div class="col-md-6 col-sm-6 col-xs-6 itensForm">
                            <div>
                                <label>CÓDIGO</label>
                                <input type="text" readonly class="form-control input-sm text-uppercase" id="codigo" name="codigo">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6 itensForm">
                            <div>
                                <label>STATUS</label>
                                <input type="text" readonly class="form-control input-sm text-uppercase" id="status" name="status">
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 itensForm">
                            <div>
                                <label>NOME DO CLIENTE</label>
                                <input type="text" class="form-control input-sm text-uppercase" id="nomeCliente" name="nomeCliente">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6 itensForm">
                            <div>
                                <label>LOCALIZAÇÃO</label>
                                <select class="form-control input-sm" id="caixaSelect" name="caixaSelect">
                                    <option value="">SELECIONE UM LOTE</option>
                                    <?php
                                    $sql = "SELECT id_caixa, descricao FROM estoque_caixas ORDER BY id_caixa DESC";
                                    $result = mysqli_query($conexao, $sql);

                                    while ($caixa = mysqli_fetch_row($result)) :
                                    ?>
                                        <option value="<?php echo $caixa[0] ?>"><?php echo $caixa[1] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6 itensForm">
                            <div>
                                <label>TAXA DE COMISSÃO</label>
                                <input type="number" class="form-control input-sm text-uppercase" id="taxaComissao" name="taxaComissao">
                            </div>
                        </div>


                        <div class="col-md-6 col-sm-6 col-xs-6 itensForm">
                            <div>
                                <label>DATA DE ENTRADA</label>
                                <input type="date" readonly class="form-control input-sm text-uppercase" id="dataEntrada" name="dataEntrada">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6 itensForm">
                            <div>
                                <label>DATA DE SAÍDA</label>
                                <input type="date" readonly class="form-control input-sm text-uppercase" id="dataSaida" name="dataSaida">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6 itensForm">
                            <div>
                                <label>DATA DE BAIXA NO APP</label>
                                <input type="date" readonly class="form-control input-sm text-uppercase" id="dataBaixa" name="dataBaixa">
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 itensForm">
                            <div class="text-left">
                                <h4><strong>OBSERVAÇÕES </strong> <span class="glyphicon glyphicon-exclamation-sign ml-15"></span></h4>
                            </div>
                            <hr>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div>
                                <textarea type="text" class="form-control input-sm text-uppercase" id="observacao" name="observacao" maxlength="1000" rows="3" style="resize: none"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div>
                                <span class="btn btn-danger btn-lg btnLayout" id="btnCancelar" title="CANCELAR PEDIDO" onclick="cancelarPedido()">CANCELAR PEDIDO</span>
                                <span class="btn btn-warning btn-lg btnLayout" id="btnSalvar" title="SALVAR">SALVAR</span>
                                <span class="btn btn-danger btn-lg btnLayout" id="btnVoltar" title="VOLTAR" onclick="voltar()">VOLTAR</span>
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
        var id = "<?php echo @$id ?>";
        obterDadosPedido(id);
        validarForm("formulario");
        camposObrigatorios(["nomeCliente", "caixaSelect"], true);
        $("#caixaSelect").select2();
    }

    function setEvents() {
        $("#btnSalvar").click(function() {
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
                url: "./Procedimentos/Pedidos/AtualizarPedido.php",
                success: function(r) {
                    if (r > 0) {
                        alertify.success("PEDIDO ATUALIZADO");
                    } else {
                        alertify.error("NÃO FOI POSSÍVEL ATUALIZAR O PEDIDO");
                    }
                }
            });
        });
    }

    function obterDadosPedido(id) {
        $.ajax({
            type: "POST",
            data: "id=" + id,
            url: "./Procedimentos/Pedidos/ObterDadosPedido.php",
            success: function(r) {
                dado = jQuery.parseJSON(r);
                $("#id").val(dado["id"]);
                $("#codigo").val(dado["codigo"]);
                $("#nomeCliente").val(dado["nome_cliente"]);
                $("#caixaSelect").val(dado["id_caixa"]).change();
                $("#observacao").val(dado["observacoes"]);
                $("#dataEntrada").val(dado["data_entrada"]);
                $("#dataSaida").val(dado["data_saida"]);
                $("#status").val(dado["status"]);
                $("#taxaComissao").val(dado["taxa_comissao"]);
                $("#dataBaixa").val(dado["data_saida_baixa"]);
                verificaStatus(dado["status"]);
            }
        });
    }

    function verificaStatus(status) {
        console.log(status);
        if (status != "AGUARDANDO RETIRADA") {
            bloquearCampos(["caixaSelect", "nomeCliente", "observacao", "taxaComissao"], true);
            $("#btnSalvar").hide();
            $("#btnCancelar").hide();
        }
    }

    function voltar() {
        $("#conteudo").load("./Views/Principal/AcompanharPedidos.php");
    }

    function cancelarPedido() {
        var id = $("#id").val();
        alertify.confirm('ATENÇÃO', 'CONFIRMAR CANCELAMENTO DO PEDIDO?', function() {
            alertify.confirm().close();
            $.ajax({
                type: "POST",
                data: "id=" + id,
                url: "./Procedimentos/Pedidos/CancelarPedido.php",
                success: function(r) {
                    if (r > 0) {
                        $('#conteudo').load("./Views/Principal/AcompanharPedidos.php");
                        alertify.success("PEDIDO CANCELADO");
                    } else {
                        alertify.error("NÃO FOI POSSÍVEL CANCELAR O PEDIDO");
                    }
                }
            });
        }, function() {});
    }
</script>