<?php 
class ti{
    public function ReportarProblema($dados) {
        $c = new conectar();
        $conexao = $c -> conexao();

        $sql = "INSERT into erros (descricao) 
        VALUES ('$dados[0]')";
        
        return mysqli_query($conexao, $sql);
    }
}
?>