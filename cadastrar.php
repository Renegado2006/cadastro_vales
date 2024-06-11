<?php
//incluir o conexao na pagina e todo o seu coteudo 
include_once 'conexao.php';


// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";
// exit;

//capturar os dados digitalizados no form e salva em variaveis
//para facilitar a manipulação dos dados

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_vale = $_POST['ID'];
    $descricao = $_POST['Descricao'];
    $data_vale = $_POST['Data Do Vale'];
    $valor = $_POST['Valor'];
    $data_cadastro = $_POST['Data do Cadastro'];

    //vamos abrir a conexao com o banco de dados
    $conexaoComBanco = abrirbanco();


    //vamos criar o SQL para realizar o insert dos dados
    $sql = "INSERT INTO pessoas
   (id_vale, descricao, data_vale, valor, data_cadastro)
   VALUES
   ('$id_vale', '$descricao', '$data_vale', '$valor', '$data_cadastro')";

    if ($conexaoComBanco->query($sql) === TRUE) {
        echo ":) sucesso ao cadastrar o contato :)";
    } else {
        echo ":( Erro ao cadastrar o contato :(";
    }

    fecharBanco($conexaoComBanco);
}
