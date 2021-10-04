<?php 
class pedidos{
    public function CadastrarPedido($dados) {
        $c = new conectar();
        $conexao = $c -> conexao();
        $data = date('Y-m-d');

		$sql = "INSERT INTO estoque_pedidos (codigo, nome_cliente, id_caixa, observacoes, data_entrada, status) 
		VALUES ('$dados[0]', '$dados[1]', '$dados[2]', '$dados[3]', '$data', 'AGUARDANDO RETIRADA')";
        
        return mysqli_query($conexao, $sql);
    }

    public function RealizarEntrega($id) {
        $c = new conectar();
        $conexao = $c -> conexao();
        $data = date('Y-m-d');

        $sql = "UPDATE estoque_pedidos SET status = 'PENDENTE BAIXA NO APP', data_saida = '$data'
		WHERE id_pedido = '$id'";

		echo mysqli_query($conexao, $sql);
    }

    public function RealizarBaixa($id) {
        $c = new conectar();
        $conexao = $c -> conexao();
        $data = date('Y-m-d');

        $sql = "UPDATE estoque_pedidos SET status = 'ENTREGA E BAIXA REALIZADA', data_saida_baixa = '$data'
		WHERE id_pedido = '$id'";

		echo mysqli_query($conexao, $sql);
    }
}
?>