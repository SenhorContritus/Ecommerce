<?php
    include('cabecalho.php');
    $id_principal = $_GET['id'];
    echo"<main><center><div>
        <form method ='post' action=''>
        <label for=''><h2>Adicionar produtos</h2></label><br><br>

        <label for='nome'><h2>Nome:</h2></label>
        <input type='text' name='nome'><br><br>

        <label for='cor'><h2>Cor:</h2></label>
        <input type='text' name='cor'><br><br> 

        <label for='descricao'><h2>Descrição:</h2></label>
        <input type='text' name='descricao'><br><br> 

        <label for='valor_unitario'><h2>Preço Unitário:</h2></label>
        <input type='number' step='0.5' min='0.5' name='valor_unitario'><br><br>

        <label for='qtde_estoque'><h2>Estoque:</h2></label>
        <input type='number' name='qtde_estoque' min='1'><br><br>


        <input type='button' class='buttonGen' onclick='admBt(4,".$usuario.")' value='Voltar'>
        </form></center></div></main>";

        if($_POST){
            include("util.php");
            $conn = conecta();

            $val=$_POST['valor_unitario'];
            $qtd=$_POST['qtde_estoque'];

            $varSQL = "INSERT INTO produto (nome, descricao, valor_unitario, qtde_estoque, cor)
                     VALUES (:nome, :descricao, :valor_unitario, :qtde_estoque, :cor)";

            $insert = $conn->prepare($varSQL);
            $insert->bindParam(':nome', $_POST['nome']);
            $insert->bindParam(':descricao', $_POST['descricao']);
            $insert->bindParam(':valor_unitario', $val);
            $insert->bindParam(':qtde_estoque', $qtd);
            $insert->bindParam(':cor', $_POST['cor']);

            if($insert->execute()>0){
                echo"<br>Dados salvos";
            }
            echo"<br><a href='produtos.php?id=".$id_principal."'>Voltar para o inicio</a>";


        }
        include('rodape.php');
?>