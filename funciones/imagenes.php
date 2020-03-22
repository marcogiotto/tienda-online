<?php

/**
 * Obtenemos la extension de la imagen.
 *
 * @param $nombreImg
 * @return false|string
 */

function imgExtension($nombreImg){

    return substr($nombreImg,strrpos($nombreImg,'.')+1);
}


/**
 * Creea una imagen desde la extension y sino la obtiene desde la ruta.
 *
 * @param $imagenRuta
 * @param null $extension
 * @return bool
 */

function CrearImagen($imagenRuta,$extension = null){

    $extension= $extension ?? imgExtension($imagenRuta);

    switch ($extension){
        case 'jpg':
        case 'jpeg':
            return imagecreatefromjpeg($imagenRuta);
            break;

        case 'gif':
            return imagecreatefromgif($imagenRuta);
            break;

        case 'png':
            return imagecreatefrompng($imagenRuta);
            break;

        default:
            return false;



    }

}

/**
 * Guarda una imagen en $rutaArch
 *
 * @param $imagenRuta
 * @param $rutaArch
 * @param null $extension
 * @return bool
 */

function GuardarImagen($imagenRuta,$rutaArch,$extension = null){

    $extension = $extension ?? imgExtension($rutaArch);
    switch($extension) {
        case 'jpg':
        case 'jpeg':
            return imagejpeg($imagenRuta, $rutaArch);
            break;

        case 'gif':
            return imagegif($imagenRuta, $rutaArch);
            break;

        case 'png':
            return imagepng($imagenRuta, $rutaArch);
            break;

        default:
            return false;
    }
}

/**
 * Modificamos el tamaño de la imagen.
 *
 * @param $imagen
 * @param $altura
 * @param $ancho
 * @return bool|resource
 *
 */


function ModificarImg($imagen,$altura,$ancho){

    $imagenX = imagesx($imagen);
    $imagenY = imagesy($imagen);

    if($imagenX < $ancho && $imagenY < $altura ) return $imagen;

    $inicioX = ($imagenX / 2) - ($ancho / 2);
    $inicioY = ($imagenY / 2) - ($altura / 2);

    $crop=imagecrop($imagen,[
        'x' => $inicioX,
        'y' => $inicioY,
        'width' => $ancho,
        'height' => $altura

    ]);

    return $crop === false ? $imagen : $crop;


}

/**
 * Generamos 2 imagens redimensionadas y les asignamos sufijo a las imagens.
 *
 * @param $imagen
 * @param $ruta
 * @param null $nombreImg
 * @param bool $crop
 * @return array
 *
 */

function GenerarImagenes($imagen,$ruta,$nombreImg = null , $crop = false){

    $nombreImg = $nombreImg ?? time();
    $extension = imgExtension($imagen['name']);
    $copiaImg= CrearImagen($imagen['tmp_name'],$extension);


    $imagenModificada = imagescale($copiaImg, 150); // Tipo un thumbnail.
    $imagenGrandeModificada = imagescale($copiaImg, 300);

    if($crop){

        [$imagenModificada,$imagenGrandeModificada]= generarImgModificadas($imagenModificada,$imagenGrandeModificada);



    }

    $redimensionadaNombre = $nombreImg . "-small." . $extension;
    $redimensionadaGrandeNombre = $nombreImg . "." . $extension;

    GuardarImagen($imagenModificada, $ruta . $redimensionadaNombre);
    GuardarImagen($imagenGrandeModificada, $ruta . $redimensionadaGrandeNombre);



    return ['name' => $redimensionadaNombre, 'big' => $redimensionadaGrandeNombre];
}


/**
 * Nos modifica el tamaño de las imagens al indicado.
 *
 * @param $normal
 * @param $big
 * @return array
 */

function generarImgModificadas($normal, $big) {
    return [
        ModificarImg($normal, 175, 150),
        ModificarImg($big, 350, 300)
    ];
}

