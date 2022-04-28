<!DOCTYPE html>
<html>

<head>
    <?php require_once "../../Classes/Conexao.php";
    $c = new conectar();
    $conexao = $c -> conexao();
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
                                <input type="text" readonly class="form-control input-sm text-uppercase" id="nomeCliente" name="nomeCliente">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6 itensForm">
                            <div>
                                <label>LOCALIZAÇÃO</label>
                                <input type="hidden" class="form-control input-sm text-uppercase" id="loteAnterior" name="loteAnterior">
                                <select class="form-control input-sm" id="lote" name="lote">
                                    <option value="">SELECIONE UM LOTE</option>
                                    <?php
                                    $sql = "SELECT id_caixa, descricao FROM estoque_caixas WHERE status LIKE 'VAZIO' ORDER BY id_caixa DESC";
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
                        
                        <div class="col-md-6 col-sm-6 col-xs-6 itensForm">
                            <div>
                                <label>VALOR DO PEDIDO</label>
                                <input type="number" class="form-control input-sm text-uppercase" id="valorPedido" name="valorPedido">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6 itensForm">
                            <div>
                                <label>TAXA DE COMISSÃO</label>
                                <input type="number" class="form-control input-sm text-uppercase" id="taxaComissao" name="taxaComissao">
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
                                <span class="btn btn-warning btn-lg btnLayout" id="btnSalvar" title="SALVAR">SALVAR</span>
                                <span class="btn btn-warning btn-lg btnLayout" id="btnSalvarPedidoEntregue" title="SALVAR">SALVAR</span>
                                <span class="btn btn-danger btn-lg btnLayout" id="btnCancelar" title="CANCELAR PEDIDO" onclick="cancelarPedido()">CANCELAR PEDIDO</span>
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
        var id = "<?php echo @$id ?>";
        obterDadosPedido(id);
        validarForm("formulario");
        campoObrigatorio(["taxaComissao"], true);
    });

    $("#btnSalvar").click(function() {
        var validator = $("#formulario").validate();
        validator.form();
        var checkValidator = validator.checkForm();

        if (checkValidator == false) {
            alertify.error("PREENCHA TODOS OS CAMPOS OBRIGATÓRIOS");
            return false;
        }else{
            dados = $("#formulario").serialize();
            $.ajax({
                type: "POST",
                data: dados,
                url: "./Procedimentos/Pedidos/AtualizarPedido.php",
                success: function(r) {
                    if (r > 0) {
                        alertify.success("SUCESSO");
                    } else {
                        alertify.error("ERRO, CONTATE O ADMINISTRADOR");
                    }
                }
            });
        }
    });

    $("#btnSalvarPedidoEntregue").click(function() {
        var validator = $("#formulario").validate();
        validator.form();
        var checkValidator = validator.checkForm();

        if (checkValidator == false) {
            alertify.error("PREENCHA TODOS OS CAMPOS OBRIGATÓRIOS");
            return false;
        }else{
            dados = $("#formulario").serialize();
            $.ajax({
                type: "POST",
                data: dados,
                url: "./Procedimentos/Pedidos/AtualizarPedidoEntregue.php",
                success: function(r) {
                    if (r > 0) {
                        alertify.success("SUCESSO");
                    } else {
                        alertify.error("ERRO, CONTATE O ADMINISTRADOR");
                    }
                }
            });
        }
    });

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
                $.ajax({
                    type: "POST",
                    data: "idLote=" + dado.id_caixa,
                    url: "./Procedimentos/Estoque/ObterDescLote.php",
                }).then(function(data) {
                    var lote = JSON.parse(data);
                    $("#loteAnterior").val(dado.id_caixa);
                    $("#lote").append("<option value="+ dado.id_caixa +">" + lote + "</option>");
                    $("#lote").val(dado.id_caixa).change();
                });
                $("#observacao").val(dado["observacoes"]);
                $("#dataEntrada").val(dado["data_entrada"]);
                $("#dataSaida").val(dado["data_saida"]);
                $("#status").val(dado["status"]);
                $("#taxaComissao").val(dado["taxa_comissao"]);
                $("#valorPedido").val(dado["valor_pedido"]);
                $("#dataBaixa").val(dado["data_saida_baixa"]);
                verificaStatus(dado["status"]);
            }
        });
    }

    function verificaStatus(status) {
        if (status != "AGUARDANDO RETIRADA") {
            bloquearCampo(["observacao", "lote", "valorPedido"], true);
            mostrarCampo(["btnSalvar", "btnCancelar"], false);
            mostrarCampo(["btnSalvarPedidoEntregue"], true);
        }else{
            mostrarCampo(["btnSalvarPedidoEntregue"], false);
            bloquearCampo(["lote", "valorPedido"], false);
        }
    }

    function voltar() {
        $("#conteudo").load("./Views/Principal/AcompanharPedidos.php");
    }

    function cancelarPedido() {
        let id = $("#id").val();
        let lote = $("#lote").val();
        alertify.confirm("ATENÇÃO", "CONFIRMAR CANCELAMENTO?", function() {
            alertify.confirm().close();
            $.ajax({
                type: "POST",
                data: {id : id, lote : lote},
                url: "./Procedimentos/Pedidos/CancelarPedido.php",
                success: function(r) {
                    if (r > 0) {
                        $("#conteudo").load("./Views/Principal/AcompanharPedidos.php");
                        alertify.success("SUCESSO");
                    } else {
                        alertify.error("ERRO, CONTATE O ADMINISTRADOR");
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

    
    $("#valorPedido").change(function() {
        calcularTaxaComissao();
    });

    function calcularTaxaComissao(){
        let valorPedido = $("#valorPedido").val();
        let taxaComissao = $("#taxaComissao").val();
        if(parseFloat(valorPedido) >= 20){
            $("#taxaComissao").val(1);
        } else if (parseFloat(valorPedido) < 20){
            var porcentagem5 = 5 / 100 * parseFloat(valorPedido);
            $("#taxaComissao").val(porcentagem5.toFixed(2));
        } else {
            $("#taxaComissao").val(0);
        }
    }
</script>