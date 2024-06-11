<?php
//incluir o conexao na pagina e todo o seu coteudo 
include_once 'conexao.php';


if (isset($_GET['acao'])&& $_GET['acao'] == 'atualizar'){

    //if ternario
    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    //vamos abrir a conexao com o banco de dados
    $conexaoComBanco = abrirbanco();

    $sql = "select * from vales WHERE id = ?";
    //preparar o sql para consultar o id no banco de dados
    $pegardados = $conexaoComBanco->prepare($sql);
    //substituir o ????????
    $pegardados->bind_param("i", $id);
    //executar o sql que preparamos
    $pegardados->execute();
    $result = $pegardados->get_result ();

    if($result->num_rows == 1){
        $registro = $result->fetch_assoc();
       //para aparecer os detalhes ->  dd($registro);

    }else {
        echo "nenhum registro encontrado";
        exit;
    }
    
    $pegardados->close();
    fecharBanco($conexaoComBanco);


}


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id_vale = $_POST['ID'];
    $descricao = $_POST['Descricao'];
   $data_vale = $_POST['Data Do Vale'];
   $valor = $_POST['Valor'];
   $data_cadastro = $_POST['Data do Cadastro'];

   $conexaoComBanco = abrirbanco();

   $sql = "UPDATE vales SET `ID` = '$id_vale', `Descricao` = '$descricao', 
   `Data Do Vale` = '$data_vale', `Valor` = '$valor', `Data do Cadastro` = '$$data_cadastro'
    WHERE (`id` = $ID)";


if ($conexaoComBanco->query($sql) === TRUE ) {
    echo ":) Sucesso ao Atualizar o Vale :)";
    } else {
        echo ":( Erro ao Atualizar o Vale :(";
    }
    fecharBanco($conexaoComBanco);
}

?>