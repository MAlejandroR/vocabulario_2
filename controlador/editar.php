<?php
require "funciones.php";

//Leo el idioma, si vengo de administrar lo leo por get, si vengo de la misma página (editar)
//lo leo por post
//Si no tengo idioma entonces redirijo a administrar
$idioma=$_GET['idioma'] ?? $_POST['idioma'] ?? null;


//Si no tengo idioma nos vamos
//Este caso se puede producir si escribo directamente esta url
if (empty($idioma)) {
    header ("Location:administrar.php");
    die();
}

if (isset($_POST['submit'])) { //Para evitar warning si vengo por GET (administrar.php

    switch ($_POST['submit']) {
        case "Añadir":
            $tema=$_POST['tema_new'];
            if (empty($tema))
                $msj="Debes escribir un tema para crear el directorio";
            else
                $msj=add_dir ("$idioma/$tema");
            break;
        case "Borrar":
            $tema=$_POST['tema'];
            if (empty($tema))
                $msj="Debes seleccionar un tema para borrarlo";
            else
                $msj=del_dir ("$idioma/$tema");
            break;
        case "Editar":
            header ("Location:editar.php?idioma=$idioma");
            exit ();
        case "Añadir volcabulario";
            $tema=$_POST['tema'];
            if (empty($tema))
                $msj="Debes seleccionar un tema para añadir vocabulario";
            else {
                header ("Location:add_vocabulario.php?idioma=$idioma&tema=$tema");
                exit ();
            }
            break;
        case "Ver imágenes";
            $tema=$_POST['tema']??null;
            if (empty($tema))
                $msj="Debes seleccionar un tema para añadir vocabulario";
            else {
                $html_imagenes=get_html_imagenes ("$idioma/$tema");
            }
            break;
        case "Volver":
            $idioma=$_POST['idioma'];
            header ("Location:administrar.php");
            exit();
    }
}
$temas=get_dir ("$idioma") ?? [];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./../css/estilo.css">
    <title>Document</title>
</head>
<body>
<h2><?= $msj ?? "" ?></h2>
<h1>Opciones de <?= $idioma ?></h1>
<form action="editar.php" method="POST">
    <fieldset>
        <?php
        if (count ($temas) > 0) {
            echo "<h2>Selecciona editar para agregar temas en el idioma</h2>";
            foreach($temas as $tema)
                echo "<input type='radio' name='tema' value='$tema'><label>$tema</label><br />\n";

            echo "<br /><br /><input type=submit value='Borrar' name='submit' >\n";
            echo "<input type='submit' name='submit' value='Añadir volcabulario'>\n";
            echo "<input type='submit' name='submit' value='Ver imágenes'>\n";
        } else
            echo "<h2>Actualmente no hay temas para el $idioma</h2>\n";
        ?>

    </fieldset>
    <fieldset>
        <legend>Agregar nuevos temas</legend>

        <input type="text" name="tema_new">
        <input type="submit" name="submit" value="Añadir">

    </fieldset>
    <input type="hidden" name="idioma" value='<?= $idioma ?>'>
    <hr/>
    <input type="submit" name="submit" value='Volver'>

</form>
<?= $html_imagenes ??"" ?>
</body>
</html>
