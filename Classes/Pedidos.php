<?php 
class pedidos{
    public function CadastrarPedido($dados) {
        $c = new conectar();
        $conexao = $c -> conexao();
        $data = date('Y-m-d');

		$sql = "INSERT INTO estoque_pedidos (codigo, nome_cliente, id_caixa, observacoes, data_entrada, status) 
		VALUES ('$dados[0]', '$dados[1]', '$dados[2]', '$dados[3]', '$dados[4]', 'AGUARDANDO RETIRADA')";
        
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

    public function obterDadosPedido($id) {
        $c = new conectar();
		$conexao = $c -> conexao();

		$sql = "SELECT id_pedido , codigo, nome_cliente, id_caixa, observacoes, data_entrada, data_saida, status, data_saida_baixa, taxa_comissao
		FROM estoque_pedidos WHERE id_pedido = '$id'";

		$result = mysqli_query($conexao, $sql);
		$mostrar = mysqli_fetch_row($result);

		$dados = array(
			'id' => $mostrar[0],
			'codigo' => $mostrar[1],
			'nome_cliente' => $mostrar[2],
			'id_caixa' => $mostrar[3],
			'observacoes' => $mostrar[4],
			'data_entrada' => $mostrar[5],
			'data_saida' => $mostrar[6],
			'status' => $mostrar[7],
			'data_saida_baixa' => $mostrar[8],
			'taxa_comissao' => $mostrar[9]
		);

		return $dados;
    }

    public function AtualizarPedido($dados) {
        $c = new conectar();
        $conexao = $c -> conexao();

        $sql = "UPDATE estoque_pedidos SET nome_cliente = '$dados[1]', id_caixa = '$dados[2]', taxa_comissao = '$dados[3]', observacoes = '$dados[4]'
        WHERE id_pedido  = '$dados[0]'";
        
        return mysqli_query($conexao, $sql);
    }

    public function CancelarPedido($dados) {
        $c = new conectar();
        $conexao = $c -> conexao();

        $sql = "UPDATE estoque_pedidos SET status = 'PEDIDO CANCELADO'
        WHERE id_pedido  = '$dados[0]'";

        $result = mysqli_query($conexao, $sql);
        
        return $dados[0];
    }
}
?>