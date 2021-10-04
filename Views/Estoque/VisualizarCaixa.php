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
        <div>
            <div class="text-center">
                <h3><strong>VISUALIZAR CAIXA</strong></h3>
            </div>
        </div>
        <div class="divFormulario">
            <div class="mx-auto">
                <form id="formulario">
                    <div>
                        <input type="text" hidden="" id="id" name="id">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div>
                                <label>DESCRIÇÃO</label>
                                <input type="text" class="form-control input-sm text-uppercase" id="descricao" name="descricao">
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div>
                                <span class="btn btn-warning btn-lg" id="btnSalvar" title="SALVAR">SALVAR</span>
                                <span class="btn btn-danger btn-lg" id="btnVoltar" title="VOLTAR" onclick="voltar()">VOLTAR</span>
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
        id = "<?php echo @$id ?>";
        obterDadosCaixa(id);
        validarForm("formulario");
        camposObrigatorios(["descricao"], true);
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
                url: "./Procedimentos/Estoque/AtualizarCaixa.php",
                success: function(r) {
                    if (r > 0) {
                        alertify.success("REGISTRO ATUALIZADO");
                    } else {
                        alertify.error("NÃO FOI POSSÍVEL ATUALIZAR REGISTRO");
                    }
                }
            });
        });
    }

    function obterDadosCaixa(id) {
        $.ajax({
            type: "POST",
            data: "id=" + id,
            url: "./Procedimentos/Estoque/ObterDadosCaixa.php",
            success: function(r) {
                dado = jQuery.parseJSON(r);
                $("#id").val(dado["id"]);
                $("#descricao").val(dado["descricao"]);
            }
        });
    }

    function voltar() {
        $("#conteudo").load("./Views/Estoque/Caixas.php");
    }
</script>