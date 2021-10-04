<?php
class utilitarios
{
	public function data($data)
	{
		return date("d/m/Y", strtotime($data));
	}

	public function nomeEstoqueCaixa($id){
        $c = new conectar();
        $conexao = $c -> conexao();

        $sql = "SELECT descricao FROM estoque_caixas WHERE id_caixa = '$id'";

        $result = mysqli_query($conexao,$sql);
        $mostrar = mysqli_fetch_row($result);

        return $mostrar[0];
    }
}
