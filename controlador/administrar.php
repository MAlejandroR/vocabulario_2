<?php
require_once "funciones.php";

//Si he presionado algún submit en esta página o recurso (administrar.php)
if (isset($_POST['submit'])) {
    //Leo idioma o del input radio (idioma) o de la caja de texto (idioma_new)
    $idioma = $_POST ['idioma']??  $_POST ['idioma_new'];
    if (empty($idioma))
        $msj="Debe seleccionar un idioma para interactuar";
    else
        switch ($_POST['submit']) {
            case "Añadir":
                $msj=add_dir ($idioma);
                break;
            case "Borrar":
                //Sería bueno preguntar antes de borrar
                $msj=del_dir ($idioma);
                break;
            case "Editar":
                header ("Location:editar.php?idioma=$idioma");
                exit();
        }
}
//Leemos los idiomas que hay (directorios del dir idiomas), por defecto un array vacío
$idiomas=get_dir (null) ?? [];

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>adm idiomas</title>
</head>
<body>
<h1>Administrar</h1>
<h3><?= $msj ?? "" ?></h3>
<form action="administrar.php" method="POST">
    <fieldset>
        <legend>Idiomas actuales</legend>
        <?php
        if (count ($idiomas) > 0) { //Si hay idiomas los muestro
            echo "<h2>Selecciona editar para agregar temas en el idioma</h2>\n";
            foreach($idiomas as $idioma)
                echo "\t\t<input type='radio' name='idioma' value ='$idioma'>\n<label>$idioma</label><br />\n";
            echo "<br />";
            echo "\t\t<input type=submit value='Borrar' name='submit' >\n";
            echo "\t\t<input type=submit value='Editar' name='submit' >\n";
        } else //si no hay idiomas, lo digo
            echo "<h2>Actualmente no hay idiomas</h2>";
        ?>
    </fieldset>
    <fieldset>
        <legend>Agregar nuevos idiomas</legend>
        <input type="text" name="idioma_new" id="">
        <input type="submit" value="Añadir" name="submit">
    </fieldset>
</form>
<hr />
<form action="./../index.php" method="POST">
    <input type="submit" value="Volver" name="submit">
</form>

</body>
</html>



