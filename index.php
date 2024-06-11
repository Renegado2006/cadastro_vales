<?php
//incluir o conexao na pagina e todo o seu coteudo 
include_once 'conexao.php';


if (isset($_GET['acao']) && $_GET['acao'] == 'excluir') {
    $id = $_GET['id'];

    if ($id > 0) {
        //abrir a conexao com o banco
        $conexaoComBanco = abrirbanco();
        //preparar um sql de exclusao
        $sql = "DELETE FROM pessoas WHERE id = $id";
        //executar comando no banco 
        if ($conexaoComBanco->query($sql) === TRUE) {
            // echo 'contato excluido com sucesso';
            echo "<script>alert ('contato excluido com sucesso !')</script>";
        } else {
            echo "contato excluido com sucesso :(";
        }
    }
    fecharBanco($conexaoComBanco);
}

 ?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>agenda</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
  
        <header class="cabecalho">
        
               <nav class="menu">
                <ul>
                    <li><a href="index.php">Home</a></li> 
                    <li><a href="cadastrar.php">cadastrar</a></li>
                </ul>
            </nav>
        </header>
        <h1 id="titulo-principal">Agenda de contatos</h1>
        <section>
                    <h2 id="titulo-secundario">Listar Contatos</h2>


            <table border="1" class="tabela-listar">
                <thead>

                        <tr>
                            <td>Id</td>
                            <td>Nome</td>
                            <td>Sobrenome</td>
                            <td>Nascimento</td>
                            <td>Endereco</td>
                            <td>Telefone</td>
                            <td>Ações</td>
                        </tr>

                </thead>

                <tbody>
                    <?php
                    //abrir a conexao com o banco de dados
                    $conexaoComBanco = abrirbanco();
                    //Preparar a consulta SQL para selecionar dados no BD
                    $sql = "SELECT id, nome, sobrenome, nascimento, endereco, telefone
            From pessoas";
                    // executar o query (o SQL do banco)
                    $result = $conexaoComBanco->query($sql);

                    //visualizar oque esta oque esta acontecendo por tras

                    // echo "<pre>";
                    // print_r($registros);
                    // echo "</pre>";
                    // exit;
                    //$registros = $result->fetch_assoc();
                    //verificar se a query retornou registros
                    if ($result->num_rows > 0) {
                        //ha registro no banco
                        while ($registro = $result->fetch_assoc()) {
                    ?>
                            <tr class="tabela-nomes">
                                <td><?= $registro['id'] ?></td>
                                <td><?= $registro['nome'] ?></td>
                                <td><?= $registro['sobrenome'] ?></td>
                                <td><?= date("d/m/Y", strtotime($registro['nascimento'])) ?></td>
                                <td><?= $registro['endereco'] ?></td>
                                <td><?= $registro['telefone'] ?></td>
                                <td>

                                    
                                        <a href="editar.php?acao=editar&id=<?= $registro['id'] ?>">
                                            <button class="btn-editar">Editar</button></a>
                                        <a href="?acao=excluir&id=<?= $registro['id'] ?>" onclick="confirm('tem certezaque deseja excluir');">
                                            <button class="btn-excluir">Excluir</button></a>
                                   
                                </td>
                            </tr>
<?php



                        }
                    } else {
?>
<!-- nao tem registro no banco -->

<tr>
    <td colspan='7'>Nenhum Resgistro no banco de dados</td>
</tr>
<?php
                    }

                    fecharBanco($conexaoComBanco);
                    //criar um laço de repetição para preencher a tabela
?>

</tbody>
</table>

</section>
</body>

</html>