<?php

/**
 * @return array indexado con todos los archivos de un directorio menos . y ..
 */
function get_dir($dir)
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
    if (rmdir ("./../idiomas/$idioma"))
        $msj="El directorio $idioma se ha creado correctamente";
    else
        $msj="No se ha podido borrar el directorio $idioma (Igual no está vacío)";
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
            $html.="<li><img src='./../idiomas/$dir/$imagen'><BR />$imagen</li>\n";
        }
    else
        $html.="<h2>No hay imágenes actualmente de este tema $dir</h2>";
    $html.="</ul>\n";
    return $html;
}