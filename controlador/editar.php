<?php
$idioma=$_GET['idioma'] ?? $_POST['idioma'];

function add_tema($idioma, $tema)
{
    var_dump ($idioma, $tema);
    if (mkdir ("./../idiomas/$idioma/$tema"))
        $msj="El directorio $tema se ha creado correctamente";
    else
        $msj="No se ha podido crear el directorio $tema ";
    return $msj;


}

function leer_temas($idioma)
{
    $temas=scandir ("./../idiomas/$idioma");
    if (count ($temas) > 0) {
        $pos=array_search (".", $temas);
        unset ($temas[$pos]);
        $pos=array_search ("..", $temas);
        unset ($temas[$pos]);
    }
    return $temas;
}


if (isset($_POST['submit'])) {
    switch ($_POST['submit']) {
        case "Añadir":
            $tema=$_POST['tema_new'];
            $msj=add_tema ($idioma, $tema);
            break;
        case "Borrar":
            $tema=$_POST['tema'];
            var_dump ($_POST);
            //Sería bueno preguntar antes de borrar
            if (rmdir ("./../idiomas/$idioma/$tema"))
                $msj="Se ha borrado el dir del tema $tema de  $idioma";
            else
                $msj="No se ha borrado el dir del tema $tema de  $idioma";
            break;

        case "Editar":
            $idioma=$_POST['idioma'];
            header ("Location:editar.php?idioma=$idioma");
            exit ();
            break;
        case "Volver":
            $idioma=$_POST['idioma'];
            header ("Location:administrar.php");
            exit();
            break;

    }

}

$temas=leer_temas ($idioma) ?? [];
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
        } else
            echo "<h2>Actualmente no hay temas para el $idioma</h2>\n";
        ?>

    </fieldset>
    <fieldset>
        <legend>Agregar nuevos temas</legend>

        <input type="text" name="tema_new" id="">
        <input type="submit" name="submit" value="Añadir" >
    </fieldset>
    <input type="hidden" name="idioma" value='<?= $idioma ?>'>
    <hr/>
    <input type="submit" name="submit" value='Volver'>

</form>
</body>
</html>
