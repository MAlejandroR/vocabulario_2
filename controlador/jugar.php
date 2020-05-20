<?php
require "./funciones.php";

//Obtener los idiomas
$idiomas = get_dir ();

foreach($idiomas as $idioma){
    $temas = get_dir("$idioma");
    foreach($temas as $tema){
        $all_idiomas[$idioma][]=$tema;
    }
}
$html_opciones= get_opciones_jugar($all_idiomas);
if (isset($_POST['submit'])=="jugar"){
//    Seleccionar
    $dir ="";
}



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jugar</title>
    <link rel="stylesheet" href="./../css/estilo.css">
</head>
<body>
<fieldset>
    <legend>Seleccione Vocabulario</legend>
    <form action="jugar.php" method="POST">
        <?=$html_opciones?>
        <input type="submit" name="submit" value="jugar">
    </form>
</fieldset>

</body>
</html>