<?php 
class pedidos{
    public function CadastrarPedido($dados) {
        $c = new conectar();
        $conexao = $c -> conexao();

		$sql = "INSERT INTO estoque_pedidos (codigo, nome_cliente, id_caixa, observacoes, data_entrada, status) 
		VALUES ('$dados[0]', '$dados[1]', '$dados[2]', '$dados[3]', '$dados[4]', 'AGUARDANDO RETIRADA')";

        $sql_lote = "UPDATE estoque_caixas SET status = 'OCUPADO' WHERE id_caixa = '$dados[2]'";

        mysqli_query($conexao, $sql_lote);
        
        return mysqli_query($conexao, $sql);
    }

    public function atualizarLote($id) {
        $c = new conectar();
        $conexao = $c -> conexao();

        $sql = "UPDATE estoque_caixas SET status = 'OCUPADO'
		WHERE id_caixa = '$id'";

		echo mysqli_query($conexao, $sql);
    }

    public function RealizarEntrega($idPedido, $nomeCliente, $idCaixa) {
        $c = new conectar();
        $conexao = $c -> conexao();
        $data = date('Y-m-d');

        $sql = "UPDATE estoque_pedidos SET status = 'PENDENTE BAIXA NO APP', data_saida = '$data'
		WHERE id_pedido = '$idPedido'";

        $pedidosVinculo = pedidos::verificarVinculo($nomeCliente, $idCaixa);

        if($pedidosVinculo == false){
            pedidos::atualizarLotePVazio($idCaixa);
        }

		return mysqli_query($conexao, $sql);
    }

    public function atualizarLotePVazio($caixa){
        $c = new conectar();
        $conexao = $c -> conexao();

        $sql_lote = "UPDATE estoque_caixas SET status = 'VAZIO' WHERE id_caixa = '$caixa' OR descricao = '$caixa'";

        return mysqli_query($conexao, $sql_lote);
    }

    public function verificarVinculo($nomeCliente, $idCaixa){
        $c = new conectar();
		$conexao = $c -> conexao();

		$sql = "SELECT * FROM estoque_pedidos WHERE nome_cliente = '$nomeCliente' AND id_caixa = '$idCaixa' AND status = 'AGUARDANDO RETIRADA'";

		$result = mysqli_query($conexao, $sql);

        if($result -> num_rows > 1){
            return true;
        }else{
            return false;
        }
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

        $sql = "UPDATE estoque_pedidos SET id_caixa = '$dados[1]', taxa_comissao = '$dados[2]', observacoes = '$dados[3]'
        WHERE id_pedido  = '$dados[0]'";

        $sql_lote_ocupado = "UPDATE estoque_caixas SET status = 'OCUPADO' WHERE id_caixa = '$dados[1]'";
        mysqli_query($conexao, $sql_lote_ocupado);

        $sql_consulta_lote = "SELECT * FROM estoque_pedidos WHERE id_caixa = '$dados[4]'";

		$result = mysqli_query($conexao, $sql_consulta_lote);

        if($result -> num_rows <= 1){
            $sql_lote_vazio = "UPDATE estoque_caixas SET status = 'VAZIO' WHERE id_caixa = '$dados[4]'";
            mysqli_query($conexao, $sql_lote_vazio);
        }

        return mysqli_query($conexao, $sql);
    }

    public function AtualizarPedidoEntregue($dados) {
        $c = new conectar();
        $conexao = $c -> conexao();

        $sql = "UPDATE estoque_pedidos SET taxa_comissao = '$dados[1]'
        WHERE id_pedido  = '$dados[0]'";
        
        return mysqli_query($conexao, $sql);
    }

    public function CancelarPedido($dados) {
        $c = new conectar();
        $conexao = $c -> conexao();

        $sql = "UPDATE estoque_pedidos SET status = 'PEDIDO CANCELADO'
        WHERE id_pedido  = '$dados[0]'";

        $result = mysqli_query($conexao, $sql);

        pedidos::atualizarLotePVazio($dados[1]);
        
        return $dados[0];
    }
}
?>