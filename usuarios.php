<?php
        include('cabecalho.php');
        $id_principal = $_GET['id'];
        $string_conexao = 
        "pgsql:host=pgsql.projetoscti.com.br;
            dbname=projetoscti10; user=projetoscti10; password=eq42B156";

        $conn = new PDO($string_conexao);

        if(!$conn)
        {
            echo "Não conectado";
            exit;
        }
        $varSQL = "SELECT *
                FROM usuario";
        
        $select = $conn->query($varSQL);

        echo"<main style='overflow-y:scroll; overflow-x:scroll; padding:1vh; flex-direction:column    ;'>";
        echo"<center><h2><span style='color: #81013f;'>Usuarios<br><br></h2></center>
                <div>
                <table border=1 color=white>
                <th>Id</th><th>Nome</th><th>Email</th><th>Senha</th>
                <th>Admin</th><th>Telefone</th><th>Alterar</th><th>Excluir</th><th>Definir admin</th>";
            while($linha = $select->fetch())
            {
                echo"<tr>";
                echo"<td>";
                echo $linha["id_usuario"] ;
                echo"</td>";
                echo"<td>";
                echo $linha["nome"] ;
                echo"</td>";
                echo"<td>";
                echo $linha["email"] ;
                echo"</td>";
                echo"<td>";
                echo $linha["senha"] ;
                echo"</td>";
                echo"<td>";
                echo $linha["admin"] ;
                echo"</td>";
                echo"<td>";
                echo $linha["telefone"] ;
                echo"</td>";
                /*Aqui são passados 2 ids por Get, o primeiro como o id do campo que será alterado, e o segundo como o id do administrador que 
                está fazendo a mudança, oq vai permitir a volta para o perfil com os dados do admin*/ 
                echo"<td>";
                echo "<a href='AlterarUsuarios.php?id=".$linha['id_usuario']."&idprincipal=".$id_principal."'>Alterar dados</a>";
                echo"</td>";

                echo"<td>";
                echo "<a href='ExcluirUsuarios.php?id=".$linha['id_usuario']."&idprincipal=".$id_principal."'>Excluir dados</a>";
                echo"</td>";

                echo"<td>";
                echo "<a href='Admin.php?id=".$linha['id_usuario']."&idprincipal=".$id_principal."'>Definir admin</a>";
                echo"</td>";

                echo"</tr>";
                
            }
        echo" </table></div>";
        echo"<div><input type=button class='buttonGen' onclick='admBt(4, ".$id_principal.")'  value='Voltar' text-align: center></div>";
        echo"</main>";
        include('rodape.php');
    
?>