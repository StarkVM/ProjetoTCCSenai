<?php 
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $codigo = htmlspecialchars($_POST['nome'] ?? '');
    }
    echo "Cadastro feito com sucesso"
?>
<?php
echo '<meta http-equiv="refresh" content="0; url=">';
exit();
?>