<h1>Cadastrar Usuário</h1>
<a href="index.php?p=inicial">< Voltar</a>
<form action="index.php?p=cadastrar" method="POST">
    <p><label for="nome">Nome</label>
    <input type="text" name="nome" value="" required></p>

    <p><label for="sobrenome">Sobrenome</label>
    <input type="text" name="sobrenome" value="" required></p>

    <p><label for="email">E-mail</label>
    <input type="email" name="email" value="" required></p>

    <p><label for="sexo">Sexo</label>
    <select name="sexo">
    <option value="1">Feminino</option>
    <option value="2">Masculino</option>
    </select></p>

    <p><label for="nivelDeAcesso">Nível de acesso</label>
    <select name="nivelDeAcesso">
    <option value="1">Básico</option>
    <option value="2">Administrador</option>
    </select></p>

    <p><label for="senha">Senha</label>
    <input type="password" name="senha" value="" required></p>

    <p><label for="rsenha">Repita a senha</label>
    <input type="password" name="rsenha" value="" required></p>

    <input type="submit" value="Salvar" name="confirmar">  
</form>