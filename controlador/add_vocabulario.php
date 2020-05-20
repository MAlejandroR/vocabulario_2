<?php
$idiomas=scandir ('./../idiomas');
foreach($idiomas as $idioma){
    if ($idioma[0] === ".")
        continue;
}
$tema=trim ($_GET['tema'] ?? $_POST['tema']);
$idioma=trim ($_GET['idioma'] ?? $_POST['idioma']);


//Si no hubiera cualquiera de los dos valores. volvemos al index
if ($idioma === null || $tema === null) {
    header ("Location:./administrar.php");
}
if (isset($_POST['submit'])) {
    $fichero=$_FILES['palabra'];
    if (($fichero['error'] != 0))
    $msj="<h2>No se ha podido subir el fichero al servidor (tamaño, red, ..)</h2>";
    else {
        $origen=$fichero['tmp_name'];
        $destino="./../idiomas/$idioma/$tema/" . $fichero['name'];
        echo "<h1>Copiando $origen en $destino</h1>";
        if (move_uploaded_file ($origen, $destino))
            $msj="<h1>Se ha copiado $origen en $destino</h1>";
        else
            $msj="<h1>NO Se ha copiado $origen en $destino</h1>";
    }
}
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
<?= $msj ?>
<fieldset>
    <legend>Imagen del tema <?= "$tema en $idioma" ?> en</legend>
    <form action="add_vocabulario.php" method="post" enctype="multipart/form-data">
        <label for="">Fichero a subir</label>

        <input type="file" name="palabra" id="">
        <br/>
        <br/>
        <input type="submit" value="Subir fichero " name="submit">
        <input type="hidden" value="<?= $idioma ?> " name="idioma">
        <input type="hidden" value="<?= $tema ?> " name="tema">
        <hr/>
    </form>

    <form action="editar.php" method="POST">
        <input type="submit" value="Volver" name="submit">
        <input type="hidden" value="<?= $idioma ?> " name="idioma">
    </form>
</fieldset>


</body>
</html>
