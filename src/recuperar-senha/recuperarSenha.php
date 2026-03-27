<?php 
try {
        if(!isset($SESSION)) session_start();
        if(isset($_POST["enviarLink"]) == "post")
        {
                $_SESSION['email'] = $_POST["email"];
                $_SESSION['senha'] = $_POST["senha"];
                
        }


} 

catch (\Throwable $th) {
        
        echo "<p style='color:red;'>Erro ao iniciar sessão</p>";
}

        

?>