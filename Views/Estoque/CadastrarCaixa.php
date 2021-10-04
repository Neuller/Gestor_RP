<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <div class="container">
        <div>
            <div class="text-center">
                <h3><strong>CADASTRAR CAIXA</strong></h3>
            </div>
        </div>
        <!-- FORMULÁRIO -->
        <div class="divFormulario">
            <div class="mx-auto">
                <form id="formulario">
                    <div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div>
                                <label>DESCRIÇÃO</label>
                                <input type="text" class="form-control input-sm text-uppercase" id="descricao" name="descricao">
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
    $(document).ready(function($) {
        initForm();
        setEvents();
    });

    function initForm() {}

    function setEvents() {
        $('#btnCadastrar').click(function() {});
    }
</script>