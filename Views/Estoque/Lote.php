<!DOCTYPE html>
<html>

<body>
    <div class="container">
        <div class="cabecalho bgPrincipal">
            <div class="tituloForm">
                <h3><strong>CADASTRAR LOTE</strong></h3>
            </div>
        </div>

        <div class="mx-auto">
            <form id="formularioCadastro">
                <div>
                    <div class="col-md-12 col-sm-12 col-xs-12 itensForm">
                        <div>
                            <label>DESCRIÇÃO</label>
                            <input type="text" class="form-control input-sm text-uppercase" id="descricao" name="descricao">
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

    <div class="container">
        <div class="cabecalho bgPrincipal">
            <div class="tituloForm">
                <h3><strong>LOTES CADASTRADOS</strong></h3>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-sm-12" align="center">
                <div id="tabelaLote"></div>
            </div>
        </div>
    </div>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        validarForm("formularioCadastro");
        campoObrigatorio(["descricao"], true);
        $("#tabelaLote").load("./Views/Estoque/tabelaLote.php");
    });

    $("#btnCadastrar").click(function() {
        var validator = $("#formularioCadastro").validate();
        validator.form();
        var checkValidator = validator.checkForm();

        if (checkValidator == false) {
            alertify.error("PREENCHA TODOS OS CAMPOS OBRIGATÓRIOS");
            return false;
        } else {
            dados = $("#formularioCadastro").serialize();
            $.ajax({
                type: "POST",
                data: dados,
                url: "./Procedimentos/Estoque/ConsultarCadastroLote.php",
                success: function(r) {
                    retorno = parseInt(jQuery.parseJSON(r));
                    if (retorno > 0) {
                        alertify.error("ITEM JÁ CADASTRADO");
                        $("#descricao").val("");
                        return false;
                    } else {
                        $.ajax({
                            type: "POST",
                            data: dados,
                            url: "./Procedimentos/Estoque/CadastrarLote.php",
                            success: function(r) {
                                if (r > 0) {
                                    $("#formularioCadastro")[0].reset();
                                    $("#tabelaLote").load("./Views/Estoque/tabelaLote.php");
                                    alertify.success("SUCESSO");
                                } else {
                                    alertify.error("ERRO, CONTATE O ADMINISTRADOR");
                                }
                            }
                        });
                    }
                }
            });
        }
    });

    function visualizar(id) {
        $("#conteudo").load("./Views/Estoque/VisualizarLote.php?id=" + id);
    }
</script>