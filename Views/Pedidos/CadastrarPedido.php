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
                <h3><strong>CADASTRAR PEDIDO</strong></h3>
            </div>
        </div>
        <div>
            <div class="mx-auto">
                <form id="formulario">
                    <div>
                        <div class="col-md-6 col-sm-6 col-xs-6 itensForm">
                            <div>
                                <label>CÓDIGO</label>
                                <input type="number" class="form-control input-sm text-uppercase" id="codigo" name="codigo">
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
                                <label>DATA DE ENTRADA</label>
                                <input type="date" class="form-control text-uppercase input-sm" id="dataEntrada" name="dataEntrada">
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
                                <span class="btn btn-primary btn-lg btnLayout" id="btnCadastrar" title="CADASTRAR">CADASTRAR</span>
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
        camposObrigatorios(["codigo", "nomeCliente", "caixaSelect", "dataEntrada"], true);
        $("#caixaSelect").select2();
    }

    function setEvents() {
        $("#btnCadastrar").click(function() {
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
                url: "./Procedimentos/Pedidos/CadastrarPedido.php",
                success: function(r) {
                    if (r > 0) {
                        $("#formulario")[0].reset();
                        $("#caixaSelect").val("").change();
                        alertify.success("CADASTRO REALIZADO");
                    } else {
                        alertify.error("NÃO FOI POSSÍVEL CADASTRAR");
                    }
                }
            });
        });

        $("#dataEntrada").change(function() {
            var dataEntrada = $("#dataEntrada").val();
            var dataAtual = moment().format('YYYY-MM-DD')
            if (dataEntrada > dataAtual) {
                alertify.alert("ATENÇÃO", "DATA DE ENTRADA NÃO PODE SER MAIOR QUE A DATA ATUAL.");
                $("#dataEntrada").val("");
            }
        });
    }
</script>