<?php

require 'conexao.php';
include "../src/cadastro/cadastroB.php";

function atualizarContadorCadastro()
{
    try {
        global $conn, $contador;


        $dia = date('d');
        $mes = date('m');
        $ano = date('Y');
        $sql2 = "SELECT total FROM cadastros_qtd ORDER BY total DESC LIMIT 1; ";
        $resultado2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($resultado2);
        $totalCadastros = $row2['total'] + $contador;

        $sql = "SELECT * FROM cadastros_qtd WHERE data_dia = '$dia' AND data_mes = '$mes' AND data_ano = '$ano' ";

        $resultado = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($resultado);
        $totalDia = $row["quantidade_dia"] + $contador;
        if (mysqli_num_rows($resultado) > 0) {

            $sql = "UPDATE cadastros_qtd SET quantidade_dia = '$totalDia', 
            total = '$totalCadastros'
        WHERE data_dia = '$dia' 
          AND data_mes = '$mes' 
          AND data_ano = '$ano'";
            $resultado = mysqli_query($conn, $sql);

        } else {
            $sql = "INSERT INTO cadastros_qtd (quantidade_dia, total, data_dia, data_mes, data_ano) VALUES ('$contador', '$contador','$dia', '$mes', '$ano')";
            $resultado = mysqli_query($conn, $sql);

        }
    }
    catch (Exception $e) {
        echo 'Erro: ' . $e->getMessage();
    }


}


?>
