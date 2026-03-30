<?php
session_start();

$msgErro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['enviar'])) {

    $codigo = $_POST['codigo'];

    try {

        // URL da API que valida o código
        $url = ""; // coloque a URL da API aqui

        $dados = [
            "codigo" => $codigo,
            "email" => $_SESSION['email']
        ];

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dados));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json"
        ]);

        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($statusCode >= 200 && $statusCode <= 299) {
            header("Location: ../home/home.php");
            exit();
        } else {
            $msgErro = "<p style='color:red;'>Código incorreto.</p>";
        }

    } catch (Exception $e) {
        $msgErro = "<p style='color:red;'>Erro ao validar o código.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2FA</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="../generico/cssgenerico/style.css">
</head>

<body>

<div id="header"></div>

<div id="main" class="container mt-5">

    <h1 class="mb-4 text-center">2FA</h1>

    <p class="text-center">
        Confirme o código enviado para o e-mail:
        <strong><?php echo $_SESSION['email']; ?></strong>
    </p>

    <form method="POST">

        <div class="form-group">
            <label for="codigo">Código</label>
            <input 
                type="number" 
                class="form-control" 
                id="codigo" 
                name="codigo" 
                required
            >
        </div>

        <?php if($msgErro) echo $msgErro; ?>

        <button 
            type="submit" 
            class="btn btn-primary w-100" 
            name="enviar"
        >
            Confirmar código
        </button>

    </form>

</div>

<div id="footer"></div>

<script src="../generico/jsgenerico/frame.js"></script>

</body>
</html>