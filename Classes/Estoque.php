<?php 
class estoque{
    public function CadastrarCaixa($dados) {
        $c = new conectar();
        $conexao = $c -> conexao();

        $sql = "INSERT into estoque_caixas (descricao) 
        VALUES ('$dados[0]')";
        
        return mysqli_query($conexao, $sql);
    }
}
?>