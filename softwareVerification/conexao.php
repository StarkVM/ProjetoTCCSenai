<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "heavyrent";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {

    echo "<script> 
            console.log('Não foi possivel conectar ao servidor!');
            </script>";
    die();
}


?>