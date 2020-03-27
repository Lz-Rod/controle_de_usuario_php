<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de usuários</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class=principal>
    <?php 
        if(isset($_GET['p'])) { /*essa sessão servirá para buscar a página colocando a extensão no fim da url e caso ela não exista retornará o erro 404*/
            $pagina = $_GET['p'].".php";
            if(is_file("conteudo/$pagina")){
                include("conteudo/$pagina");
            }else{
                include("conteudo/404.php");
            }
                
        }else{
            include("conteudo/inicial.php");
        }
    ?>
    </div>
    
</body>
</html>