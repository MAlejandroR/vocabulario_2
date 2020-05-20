<?php

/**
 * @param $all_idiomas array asociativo para cada idioma los temas que hay creados
 * @return un código html con radios para que el usuario seleccione un tema de un idioma
 */
function get_opciones_jugar($all_idiomas){
    $html="";
    foreach($all_idiomas as $idioma=>$temas){
        $html.="<h3>$idioma</h3>";
        foreach($temas as $tema){
            $html.="<input type=radio value=$tema name =opcion> $tema<br />";
        }
    }
    return $html;
}



/**
 * @return array indexado con todos los archivos de un directorio menos . y ..
 */
function get_dir($dir =null)
{
    $ficheros=scandir ("./../idiomas/$dir") ?? [];
    if (count ($ficheros) > 0) {
        $pos=array_search (".", $ficheros);
        unset ($ficheros[$pos]);
        $pos=array_search ("..", $ficheros);
        unset ($ficheros[$pos]);
    }
    return $ficheros;
}


/**
 * @param $dir nombre con el cual creará un directorio
 * @return string Mensaje que informa de que  si ha podido o no crear el directorio
 */

function add_dir($dir)
{
    if (mkdir ("./../idiomas/$dir"))
        $msj="El directorio $dir se ha creado correctamente";
    else
        $msj="No se ha podido crear el directorio $dir ";
    return $msj;
}

/**
 * @param $dir nombre del cual se intentará borrar el directorio
 * @return string Mensaje que informa de que  si ha podido o no crear el directorio
 */
function del_dir($dir)
{
//    si el dir está vacío borrarlo
//    si el dir no está vacío entrar borrar sus ficheros
    $msj="";
    $ficheros=scandir ("./../idiomas/$dir");
    if (count ($ficheros) > 2)
        foreach($ficheros as $fichero){
            if ($fichero[0] == ".")
                continue;
            if (is_dir ("./../idiomas/$dir/$fichero"))
                del_dir ("$dir/$fichero");
            else
                unlink ("./../idiomas/$dir/$fichero");
        }
    if (rmdir ("./../idiomas/$dir"))
        $msj.="El directorio $dir se ha borrado correctamente";
    else
        $msj.="No se ha podido borrar el directorio $dir (Igual no está vacío)";
    return $msj;
}


/**

 * @param $dir
 * @return string
 */
function get_html_imagenes( $dir)
{
    $imagenes=get_dir ("$dir");
    $html="<h2>Imágenes de $dir</h2>\n";
    $html.="<ul class=galery>\n";
    if (count ($imagenes)>0)
        foreach($imagenes as $imagen){
            $html.="<li><img src='./../idiomas/$dir/$imagen'><br />$imagen</li>\n";
        }
    else
        $html.="<h2>No hay imágenes actualmente de este tema $dir</h2>";
    $html.="</ul>\n";
    return $html;
}