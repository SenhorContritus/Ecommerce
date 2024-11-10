<?php
    include("cabecalho.php");
    include("util.php");
    $conn=conecta();
    $id_usuario=$_GET['id'];
    $id_principal=$_GET['idprincipal'];
    $varSQL="SELECT * 
             FROM usuario
             WHERE id_usuario= :id_usuario";
    
    $select = $conn->prepare($varSQL);
    $select->bindParam(':id_usuario',$id_usuario);
    $select->execute();
    $linha= $select->fetch();

    $nome = $linha['nome'];
    $email = $linha['email'];
    $senha = $linha['senha'];
    $admin = $linha['admin'];
    $telefone = $linha['telefone'];
//ovo
    echo
    "
        <main id='registro'>
        <h2 style='color: #d326da;'>Registro</h2>
        <div style='height:70vh;width:60vh;'>
        <form action='' method='post'>
        <label for='' style:;>Alterar usuario</label><br>
        <br>

        <label for='nome'>Nome:</label>
        <input style='width:60%;' type='text' name='nome' value='$nome'><br><br>

        <label for='email'>Email:</label>
        <input style='width:60%;' type='text' name='email' value='$email'><br><br> 

        <label for='senha'>Senha:</label>
        <input style='width:59%;' type='text' name='senha' value='$senha'><br><br>

        <label for='telefone'>Telefone:</label>
        <input style='width:56%;' type='text' name='telefone' value='$telefone'><br><br>

        <input class='buttonGen' type='submit' value='Salvar'>
        </form>
        </div>
        </main>
        ";

        if ( $_POST ) {
            $conn = conecta();
            $varSQL = "SELECT email
                        FROM usuario
                        WHERE email = :email";

            $select = $conn->prepare($varSQL);
            $select->bindParam(':email', $_POST['email']);
            $select->execute();
            $linha;
            $flag = false;
            //Verificação para garantir que 1 email vai existir em apenas 1 cadastro
            while($linha = $select->fetch()) // se ele achar o email na tabela, ele entra aqui, caso contrário ele nem roda essa parte, é como se nem tivesse em que dar fetch
            {
                $e = $linha['email'];
                if($e != $email){
                    $flag=true;   
                }
                
            }

            if(!$flag){
                $varSQL =
                "UPDATE usuario
                    SET 
                    nome = :nome, email = :email, 
                    senha = :senha, telefone = :telefone  
                WHERE id_usuario = :id_usuario";

                $update = $conn->prepare($varSQL);
                $update->bindParam(':nome', $_POST['nome']);
                $update->bindParam(':email', $_POST['email']);
                $update->bindParam(':senha', $_POST['senha']);
                $update->bindParam(':telefone', $_POST['telefone']);
                $update->bindParam(':id_usuario', $id_usuario);
                
                if($update->execute()>0){
                    echo"Alteração concluída";
                    header('location: perfil.php');
                }
                if($id_principal == NULL){
                    echo "<br><a href='perfil.php?id=".$id_usuario."'>Voltar para o meu perfil</a>";
                    header('location: perfil.php');
                }
                else{
                    echo "<br><a href='usuarios.php?id=".$id_principal."'>Voltar </a>"; 
                    header('location: perfil.php');
                }
            }
            else{
                echo"<script>alert('Email já cadastrado');</script>";
            }
            
        }
        include('rodape.php');
?>