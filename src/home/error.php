<?php

$erro[0] = $_GET['er'];
$erro[1] = $_GET['er2']; 
echo "<script>
console.log(" . json_encode($erro[0]) . ");
console.log('Erro 2:', " . json_encode($erro[1]) . ");    

        alert('Houve algum erro ao conectar com o servidor, por favor, tente novamente.');
        setTimeout(function(){
                window.location.href = 'home.php';
            });

</script>";
?>