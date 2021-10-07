<!DOCTYPE html>
<html>

<body>
    <div class="container">
        <div class="cabecalho bgPrincipal">
            <div class="tituloForm">
                <h3><strong>CADASTRAR CAIXA</strong></h3>
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
                <h3><strong>CAIXAS CADASTRADAS</strong></h3>
            </div>
            <hr>
        </div>

        <div>
            <div class="row">
                <div class="col-sm-12" align="center">
                    <div id="tabelaCaixas"></div>
                </div>
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
        validarForm("formularioCadastro");
        camposObrigatorios(["descricao"], true);
        $("#tabelaCaixas").load("./Views/Estoque/TabelaCaixas.php");
    }

    function setEvents() {
        $("#btnCadastrar").click(function() {
            var validator = $("#formularioCadastro").validate();
            validator.form();
            var checkValidator = validator.checkForm();

            if (checkValidator == false) {
                alertify.error("PREENCHA TODOS OS CAMPOS OBRIGATÓRIOS");
                return false;
            }

            dados = $("#formularioCadastro").serialize();

            $.ajax({
                type: "POST",
                data: dados,
                url: "./Procedimentos/Estoque/CadastrarCaixa.php",
                success: function(r) {
                    console.log(r);
                    if (r > 0) {
                        console.log(r);
                        $("#formularioCadastro")[0].reset();
                        $("#tabelaCaixas").load("./Views/Estoque/TabelaCaixas.php");
                        alertify.success("CADASTRO REALIZADO");
                    } else {
                        alertify.error("NÃO FOI POSSÍVEL CADASTRAR");
                    }
                }
            });
        });
    }

    function visualizar(id) {
        $("#conteudo").load("./Views/Estoque/VisualizarCaixa.php?id=" + id);
    }
</script>