<?php 
class pedidos{
    public function CadastrarPedido($dados) {
        $c = new conectar();
        $conexao = $c -> conexao();
        $data = date('Y-m-d');

		$sql = "INSERT INTO estoque_pedidos (codigo, nome_cliente, id_caixa, observacoes, data_entrada, status) 
		VALUES ('$dados[0]', '$dados[1]', '$dados[2]', '$dados[3]', '$data', 'PENDENTE')";
        
        return mysqli_query($conexao, $sql);
    }

    public function RealizarEntrega($id) {
        $c = new conectar();
        $conexao = $c -> conexao();
        $data = date('Y-m-d');

        $sql = "UPDATE estoque_pedidos SET status = 'ENTREGA REALIZADA', data_saida = '$data'
		WHERE id_pedido = '$id'";

		echo mysqli_query($conexao, $sql);
    }
}
?>