<?php
///
// * Created by PhpStorm.
// * User: manuel
// * Date: 9/04/18
// * Time: 10:06
// */
///*
//spl_autoload_register(function ($clase){
//    require_once "./class/$clase.php";
//});
//
//session_start();
//$directorios=true;
//$datos= new Tree("idiomas");
//
//switch ($_POST['submit']){
//    case 'Agregar elemento':
//        $dir = $_POST['idioma_new'];
//        $msj = (mkdir ("./idiomas/$dir"))? "Se ha creado $dir": "No se ha podido crear $dir";
//        $datos= new Tree("idiomas");
//        $_SESSION['acceder']=false;
//        break;
//    case "Acceder":
//
//        $idioma =$_POST ['idioma'];
//
////        var_dump($idioma);
//
//        $datos= new Tree("idiomas/$idioma");
////        var_dump($datos);
//        $directorios = false;
//        if ($_SESSION['acceder']) {
//            $dir_idioma=$_POST['dir_idioma'];
//            header ("Location:imagenes.php?tema=$idioma&idioma=$dir_idioma");
//        }
//        else{
//            //$datos= new Tree("idiomas/$idioma_dato");
//            $_SESSION['acceder']=true;
//        }
//
//        break;
//    default:
//                $_SESSION['acceder']=false;
//
//
//}
////Obtener los diferentes temas (ropas, deportes, ...
////$temas =  Imagen::obtener_temas_frances();
//if (is_null($datos->get_Tree()))
//    $msj = "No hay datos para esa elección ";
//else{
//$select = "<select name='idioma'> \n";
//foreach ($datos->get_tree(1) as $dato) {
//    $select .="<option value='$dato' >$dato</option>\n";
//}
//    $select .="</select>\n";
//}
//
//

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Document</title>
</head>
<body>

<?php echo $msj ?? null ?>
<form action="index_.php" method="POST">
    <?php if ($directorios): ?>
    <fieldset>
        <legend>Selecciona el idioma</legend>
        <label for="">Selecciona idioma</label>
        <?php echo $select ?>
        &nbsp;&nbsp;&nbsp;
        <label for="">Nuevo idioma</label>
        <input type="text" name="idioma_new" id="">
        <hr />
        <input type="submit" value="Agregar elemento" name = 'submit'>
        <input type="submit" value="Acceder" name = 'submit'>
<?php else: ?>
    <fieldset>
        <legend>Selecciona tipo de vocabulario</legend>
        <?php echo $select ?>
     &nbsp;&nbsp;&nbsp;
        <input type="submit" value="Acceder" name = 'submit'>
        <input type='hidden' value ="<?php echo $idioma ?>" name="dir_idioma">
        <label for="">Nuevo tipo vocabulario</label>
        <input type="text" name="idioma_new"  >
<?php endif;?>
        <hr />
    
    


    </fieldset>

</form>


</body>
</html>


