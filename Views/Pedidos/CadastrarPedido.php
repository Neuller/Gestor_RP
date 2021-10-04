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
                <h3><strong>CADASTRAR PEDIDO</strong></h3>
            </div>
        </div>
        <!-- FORMULÁRIO -->
        <div class="divFormulario">
            <div class="mx-auto">
                <form id="formulario">
                    <div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div>
                                <label>CÓDIGO</label>
                                <input type="number" class="form-control input-sm text-uppercase" id="codigo" name="codigo">
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div>
                                <label>NOME DO CLIENTE</label>
                                <input type="text" class="form-control input-sm text-uppercase" id="nomeCliente" name="nomeCliente">
                            </div>
                        </div>

                        <div class="col-md-8 col-sm-8 col-xs-8 itensFormulario">
                            <div>
                                <label>LOCALIZAÇÃO</label>
                                <select class="form-control input-sm" id="caixaSelect" name="caixaSelect">
                                    <option value="">SELECIONE UMA CAIXA</option>
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

                        <div class="col-md-12 col-sm-12 col-xs-12 separador">
                            <div class="text-left">
                                <h4><strong>OBSERVAÇÕES </strong> <span class="glyphicon glyphicon-exclamation-sign ml-15"></span></h4>
                            </div>
                            <hr>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 itensFormulario">
                            <div>
                                <textarea type="text" class="form-control input-sm text-uppercase" id="observacao" name="observacao" maxlength="1000" rows="3" style="resize: none"></textarea>
                            </div>
                        </div>

                        <!-- BOTÕES -->
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div>
                                <span class="btn btn-primary btn-lg" id="btnCadastrar" title="CADASTRAR">CADASTRAR</span>
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
        camposObrigatorios(["codigo", "nomeCliente", "caixaSelect"], true);
    }

    function setEvents() {
        $('#btnCadastrar').click(function() {
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
                        alertify.success("CADASTRO REALIZADO");
                    } else {
                        alertify.error("NÃO FOI POSSÍVEL CADASTRAR");
                    }
                }
            });
        });
    }
</script>