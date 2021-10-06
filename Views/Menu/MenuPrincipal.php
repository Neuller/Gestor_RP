<html>

<body>
    <nav class="navbar-expand navbar-light">
        <div id="navbar">
            <ul class="nav navbar-nav">
               <li><a id="acompanharPedidos" href="#">ACOMPANHAR PEDIDOS</a></li>
               <li><a id="cadastrarPedido" href="#">CADASTRAR PEDIDOS</a></li>
               <li><a id="todosPedidos" href="#">TODOS OS PEDIDOS</a></li>

                <li class="dropdown">
                    <a class="dropdown-toggle itensMenu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        ESTOQUE
                    </a>
                    <ul class="dropdown-menu">
                        <li><a id="estoqueCaixas" href="#">CAIXAS</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        initForm();
        setEvents();
    });

    function initForm() {}

    function setEvents() {
        $("#cadastrarPedido").click(function(e) {
            $('#conteudo').load("./Views/Pedidos/CadastrarPedido.php");
        });

        $("#estoqueCaixas").click(function(e) {
            $('#conteudo').load("./Views/Estoque/Caixas.php");
        });

        $("#acompanharPedidos").click(function(e) {
            $('#conteudo').load("./Views/Principal/AcompanharPedidos.php");
        });

        $("#todosPedidos").click(function(e) {
            $('#conteudo').load("./Views/Pedidos/TodosPedidos.php");
        });
    }
</script>