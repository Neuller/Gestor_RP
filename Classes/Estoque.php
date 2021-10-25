<?php 
class estoque{
    public function CadastrarCaixa($dados) {
        $c = new conectar();
        $conexao = $c -> conexao();

        $sql = "INSERT into estoque_caixas (descricao, status) 
        VALUES ('$dados[0]', 'ATIVO')";
        
        return mysqli_query($conexao, $sql);
    }

    public function AtualizarCaixa($dados) {
        $c = new conectar();
        $conexao = $c -> conexao();

        $sql = "UPDATE estoque_caixas SET descricao = '$dados[1]'
        WHERE id_caixa = '$dados[0]'";
        
        return mysqli_query($conexao, $sql);
    }

    public function InativarCaixa($dados) {
        $c = new conectar();
        $conexao = $c -> conexao();

        $sql = "UPDATE estoque_caixas SET status = 'INATIVO'
        WHERE id_caixa = '$dados[0]'";
        
        return mysqli_query($conexao, $sql);
    }

    public function obterDadosCaixa($id) {
        $c = new conectar();
		$conexao = $c -> conexao();

		$sql = "SELECT id_caixa, descricao
		FROM estoque_caixas WHERE id_caixa = '$id'";

		$result = mysqli_query($conexao, $sql);
		$mostrar = mysqli_fetch_row($result);

		$dados = array(
			'id' => $mostrar[0],
			'descricao' => $mostrar[1]
		);

		return $dados;
    }

    public function ConsultarCadastroLote($descricao) {
        $c = new conectar();
		$conexao = $c -> conexao();

		$sql = "SELECT id_caixa
		FROM estoque_caixas WHERE descricao = '$descricao'";

        $result = mysqli_query($conexao, $sql);
        $mostrar = mysqli_fetch_row($result);

        return $mostrar[0];
    }
}
?>