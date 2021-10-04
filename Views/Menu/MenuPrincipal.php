<html>

<body>
    <nav class="navbar-expand navbar-light">
        <div id="navbar">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle itensMenu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        ESTOQUE
                    </a>
                    <ul class="dropdown-menu">
                        <li><a id="cadastrarCaixas" href="#">CADASTRAR CAIXAS</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle itensMenu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        PEDIDOS
                    </a>
                    <ul class="dropdown-menu">
                        <li><a id="cadastrarPedido" href="#">CADASTRAR PEDIDO</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function($) {
        initForm();
        setEvents();
    });

    function initForm() {
    }

    function setEvents() {
        $("#cadastrarPedido").click(function(e) {
            $('#conteudo').load("./Views/Pedidos/CadastrarPedido.php");
        });

        $("#cadastrarCaixas").click(function(e) {
            $('#conteudo').load("./Views/Estoque/CadastrarCaixa.php");
        });
    }
</script>