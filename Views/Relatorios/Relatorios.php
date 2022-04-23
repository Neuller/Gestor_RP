<!DOCTYPE html>
<html>

<head>
    <?php require_once "../../Classes/Conexao.php";
    $c = new conectar();
    $conexao = $c -> conexao();
    ?>
</head>

<body>
    <div class="container">
        <div class="cabecalho bgPrincipal">
            <div class="tituloForm">
                <h3><strong>GERAR RELATÓRIO</strong></h3>
            </div>
        </div>
        <div>
            <div class="mx-auto">
                <form id="formulario">
                    <div>
                        <div class="col-md-6 col-sm-6 col-xs-6 itensForm">
                            <div>
                                <label>DE</label>
                                <input type="date" class="form-control input-sm text-uppercase" id="data1" name="data1">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6 itensForm">
                            <div>
                                <label>ATE</label>
                                <input type="date" class="form-control input-sm text-uppercase" id="data2" name="data2">
                            </div>
                        </div>
                    
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div>
                                <span class="btn btn-primary btn-lg btnLayout" id="btnGerar" title="GERAR">GERAR</span>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 itensForm">
                            <div class="row" id="tabelaRelatorios"></div>
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
        validarForm("formulario");
        campoObrigatorio(["data1", "data2"], true);
    });

    $("#btnGerar").click(function() {
        var validator = $("#formulario").validate();
        validator.form();
        var checkValidator = validator.checkForm();

        if (checkValidator == false) {
            alertify.error("PREENCHA TODOS OS CAMPOS OBRIGATÓRIOS");
            return false;
        } else if (getValor("data1") > getValor("data2")){
            alertify.error("DATA FORA DO PERMITIDO, VERIFIQUE OS CAMPOS");
            return false;
        } else {
            dados = $("#formulario").serialize();
            $("#tabelaRelatorios").load("./Views/Relatorios/TabelaRelatorios.php", dados);
        }
    });
</script>