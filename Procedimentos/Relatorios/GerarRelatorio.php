<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <?php require_once "../../Classes/Conexao.php";
            $c = new conectar();
            $conexao = $c -> conexao();
        ?>
    </head>

    <body>
        <?php
            // NOME DO ARQUIVO EXCEL
            $arquivo = "relatorio.xls";

            // CABECALHO
            $html = "";
		    $html .= "<table border='1'>";
            $html .= "<tr>";
            $html .= "<td><b>CODIGO</b></td>";
            $html .= "<td><b>NOME DO CLIENTE</b></td>";
            $html .= "<td><b>ID CAIXA</b></td>";
            $html .= "<td><b>OBSERVACOES</b></td>";
            $html .= "<td><b>DATA DE ENTRADA</b></td>";
            $html .= "<td><b>DATA DE SAIDA</b></td>";
            $html .= "<td><b>STATUS</b></td>";
            $html .= "<td><b>DATA DE BAIXA</b></td>";
            $html .= "<td><b>TAXA DE COMISSAO</b></td>";
            $html .= "</tr>";

            
            // LINHAS DO SQL
            $sql = "SELECT * FROM estoque_pedidos";
            $result = mysqli_query($conexao , $sql);
            
            while($row_result = mysqli_fetch_assoc($result)){
                $html .= "<tr>";
                $html .= "<td>".$row_result["codigo"]."</td>";
                $html .= "<td>".$row_result["nome_cliente"]."</td>";
                $html .= "<td>".$row_result["id_caixa"]."</td>";
                $html .= "<td>".$row_result["observacoes"]."</td>";
                $dataEntrada = date("d/m/Y", strtotime($row_result["data_entrada"]));
                $html .= "<td>".$dataEntrada."</td>";
                $dataSaida = date("d/m/Y", strtotime($row_result["data_saida"]));
                $html .= "<td>".$dataSaida."</td>";
                $html .= "<td>".$row_result["status"]."</td>";
                $dataBaixa = date("d/m/Y", strtotime($row_result["data_saida_baixa"]));
                $html .= "<td>".$dataBaixa."</td>";
                $html .= "<td>".$row_result["taxa_comissao"]."</td>";
                $html .= "</tr>";
                ;
            }

            // CONFIGURACOES PARA FORCAR O DOWNLOAD
            header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
            header ("Cache-Control: no-cache, must-revalidate");
            header ("Pragma: no-cache");
            header ("Content-type: application/x-msexcel");
            header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
            header ("Content-Description: PHP Generated Data" );

            // ENVIA O CONTEUDO DO ARQUIVO
            echo $html;
            exit; ?>
        ?>
    </body>
</html>