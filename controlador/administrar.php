<?php

//Mostrtar los idiomas actualmente creados
//Dar la posibilidad de crear nuevos idiomas
function leer_idiomas()
{
    $idiomas=scandir ("./../idiomas");
    if (count ("idiomas") > 0) {
        $pos=array_search (".", $idiomas);
        unset ($idiomas[$pos]);
        $pos=array_search ("..", $idiomas);
        unset ($idiomas[$pos]);
    }

    return $idiomas;
}

function add_idioma($idioma)
{
    if (mkdir ("./../idiomas/$idioma"))
        $msj="El directorio $idioma se ha creado correctamente";
    else
        $msj="No se ha podido crear el directorio $idioma ";
    return $msj;


}

if (isset($_POST['submit'])) {
    switch ($_POST['submit']) {
        case "Añadir":
            $idioma=$_POST['idioma'];
            $msj=add_idioma ($idioma);
            var_dump ($idioma);
            var_dump ($msj);
            break;
        case "Borrar":
            $idioma = $_POST['idioma'];
            //Sería bueno preguntar antes de borrar
            if (rmdir ("./../idiomas/$idioma"))
                $msj="Se ha borrado el dir de idiomas $idioma";
            else
                $msj="No se ha podido borrar  borrado el dir de idiomas $idioma";
            break;

        case "Editar":
            $idioma=$_POST['idioma'];
            header ("Location:editar.php?idioma=$idioma");
            break;

    }

}
$idiomas=leer_idiomas () ?? [];



?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Document</title>
</head>
<body>
<h1>Administrar</h1>
<h3><?= $msj ?? "" ?></h3>

<fieldset>
    <legend>Idiomas actuales</legend>
    <form action="administrar.php" method="POST">
        <?php
        if (count ($idiomas) > 0) {
            echo "<h2>Selecciona editar para agregar temas en el idioma</h2>";
            foreach($idiomas as $idioma)
                echo "<input type='radio' name='idioma' value ='$idioma'><label>$idioma</label><br />";
            echo "<br />";
            echo "<input type=submit value='Borrar' name='submit' >";
            echo "<input type=submit value='Editar' name='submit' >";
        } else
            echo "<h2>Actualmente no hay idiomas</h2>";
        ?>
    </form>
</fieldset>
<fieldset>
    <legend>Agregar nuevos idiomas</legend>
    <form action="administrar.php" method="POST">
        <input type="text" name="idioma" id="">
        <input type="submit" value="Añadir" name="submit">
    </form>
</fieldset>


</body>
</html>



