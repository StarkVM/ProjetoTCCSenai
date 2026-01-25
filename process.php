<?php 
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nome       = htmlspecialchars($_POST['nome'] ?? '');
        $sobrenome  = htmlspecialchars($_POST['sobrenome'] ?? '');
        $nascimento = htmlspecialchars($_POST['data_nascimento'] ?? '');
        $email      = htmlspecialchars($_POST['email'] ?? '');
        $cep        = htmlspecialchars($_POST['cep'] ?? '');
        $rua        = htmlspecialchars($_POST['rua'] ?? '');
        $bairro     = htmlspecialchars($_POST['bairro'] ?? '');
        $cidade     = htmlspecialchars($_POST['cidade'] ?? '');
        $estado     = htmlspecialchars($_POST['estado'] ?? '');
        $numero     = htmlspecialchars($_POST['numero'] ?? '');
        $senha      = $_POST['senha'] ?? '';
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    }
    echo "Cadastro feito com sucesso"
?>
<?php
echo '<meta http-equiv="refresh" content="0; url=2fa.html">';
exit();
?>