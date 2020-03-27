<?php
error_reporting(0);
?>

<?php

    include("classe/conexao.php");

    if(isset($_POST['confirmar'])){
        // 1 - Registro dos dados
        if(!isset($_SESSION)) /*isso faz que se nao haver uma sessão para registros, que seja criada.*/
            session_start();

        foreach($_POST as $chave => $valor) /* esse foreach vai percorrer todos os posts e pegar os valores e chaves dele em loop*/
            $_SESSION[$chave] = $mysqli->real_escape_string($valor); /*essa função mysql deixa o codigo mais seguro contra ataques*/
            
        // 2 - Validação dos dados
        if(strlen($_SESSION['nome']) == 0)
            $erro[] = "Preencha o nome.";

        if(strlen($_SESSION['sobrenome']) == 0)
            $erro[] = "Preencha o sobrenome";

        if(substr_count($_SESSION['email'], '@') != 1 || substr_count($_SESSION['email'], '.') < 1 || substr_count($_SESSION['email'], '.') > 2)
            $erro[] = "Preencha o e-mail corretamente";

        if(strlen($_SESSION['senha']) < 8 || strlen($_SESSION['senha']) > 16)
            $erro[] = "Preencha sua senha corretamente";

        if(strcmp($_SESSION['senha'], $_SESSION['rsenha']) != 0)
            $erro[] = "As senhas precisam ser idênticas";

        // 3 - Inserção no banco e redirecionamento

            /*if(count($erro) == 0){ essa linha dava erro, por isso precisei declarar um array para o count*/
            
            $pkCount = (is_array($erro) ? count($erro) : 0);
            if ($pkCount == 0) {

                $senha = md5(md5($_SESSION['senha']));/*faz a criptografia da senha*/

                $sql_code = "INSERT INTO usuario (
                    nome,
                    sobrenome,
                    email,
                    senha,
                    sexo,
                    nivelDeAcesso,
                    dataDeCadastro)
                    VALUES(
                    '$_SESSION[nome]',
                    '$_SESSION[sobrenome]',
                    '$_SESSION[email]',
                    '$senha',
                    '$_SESSION[sexo]',
                    '$_SESSION[nivelDeAcesso]',
                    NOW()
                    )";
                
                $confirma = $mysqli->query($sql_code) or die ($mysqli->error);

                if($confirma){/* se for verdadeiro ele apaga todas as variaveis sql criadas*/
                    unset($_SESSION[nome],
                    $_SESSION[sobrenome],
                    $_SESSION[email],
                    $_SESSION[senha],
                    $_SESSION[sexo],
                    $_SESSION[nivelDeAcesso],
                    $_SESSION[dataDeCadastro]);

                    echo "<script> location.href='index.php?p=inicial';</script>";
                } else {
                    $erro[] = $confirma;
                }
                    
            }
    }

?>

<h1>Cadastrar Usuário</h1>

<?php

    $pkCount = (is_array($erro) ? count($erro) : 0);
    if ($pkCount > 0) {

    //*if(count() > 0) {*/
        echo "<div class='erro'>";
        foreach($erro as $valor)
            echo "$valor <br>";
        echo "</div>";
    }

?>

<a href="index.php?p=inicial">< Voltar</a>
<form action="index.php?p=cadastrar" method="POST">
    <p><label for="nome">Nome</label>
    <input type="text" name="nome" required></p>

    <p><label for="sobrenome">Sobrenome</label>
    <input type="text" name="sobrenome" required></p>

    <p><label for="email">E-mail</label>
    <input type="email" name="email" required></p>

    <p><label for="sexo">Sexo</label>
    <select name="sexo">
    <option value="1" >Feminino</option>
    <option value="2" >Masculino</option>
    </select></p>

    <p><label for="nivelDeAcesso">Nível de acesso</label>
    <select name="nivelDeAcesso">
    <option value="1" >Básico</option>
    <option value="2" >Administrador</option>
    </select></p>

    <p><label for="senha">Senha</label>
    A senha deve conter entre 8 a 16 caracteres.
    <input type="password" name="senha" value="" required></p>

    <p><label for="rsenha">Repita a senha</label>
    <input type="password" name="rsenha" value="" required></p>

    <input type="submit" value="Salvar" name="confirmar">  
</form>