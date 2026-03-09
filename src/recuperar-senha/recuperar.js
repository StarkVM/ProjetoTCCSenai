fetch("recuperar.php",{
method:"POST",
body: JSON.stringify({email:email})
})