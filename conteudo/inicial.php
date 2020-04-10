<?php
    include("classe/conexao.php");

    $sql_code = "SELECT * FROM usuario"; //seleciona todos os campos da tabela usuário.
    $sql_query = $mysqli->query($sql_code) or die ($mysqli-erros); //executa a query
    $linha = $sql_query->fetch_assoc(); //vetor com os resultados.

    $sexo[1] = "Feminino";
    $sexo[2] = "Masculino";

    $niveldeacesso[1] = "Básico";
    $niveldeacesso[2] = "Admin";
    
?>

<h1>Cadastro de Usuários</h1>
<a href="index.php?p=cadastrar">Cadastrar um usuário</a><br><br>
<table border=1 cellpadding=10>
    <tr class=titulo>
        <td>Nome</td>
        <td>Sobrenome</td>
        <td>Sexo</td>
        <td>E-mail</td>
        <td>Nível de acesso</td>
        <td>Data de cadastro</td>
        <td>Ação</td>
    </tr>
    <?php do { ?>
    <tr><!--Aqui tenho uim loop que passa por todos os usuários cadastrados e exibe na tela-->
        <td><?php echo $linha['nome'];?></td>
        <td><?php echo $linha['sobrenome'];?></td>
        <td><?php echo $sexo[$linha['sexo']];?></td>
        <td><?php echo $linha['email'];?></td>
        <td><?php echo $niveldeacesso[$linha['nivelDeAcesso']];?></td>
        <td><?php
            $d = explode(" ", $linha['dataDeCadastro'] );//essa função divide a string em dois a partir dos espaços
            $data = explode("-", $d[0]); //essa divide a data em 3 para ordenar mdia mes e ano
            echo "$data[2]/$data[1]/$data[0] às $d[1]";//aqui por fim exibo dia, mes, ano e horario da forma correta.
        ?></td>
        <td>
            <a href="index.php?p=editar&usuario=<?php echo $linha['codigo'];?>">Editar</a>
            <a href="javascript: if(confirm('Tem certeza que deseja deletar o usuario <?php echo $linha['nome'];?>?'))
            location.href='index.php?p=deletar&usuario=<?php echo $linha['codigo'];?>';">Deletar</a>
        </td>
    </tr>
    <?php } while($linha = $sql_query->fetch_assoc()); ?>
 </table>
