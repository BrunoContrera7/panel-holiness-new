<?php

/**
 * Genera un slug limpio a partir del nombre del producto
 * Ej: "9pm Elixir" → "9pm-elixir"
 */
function generarSlug($texto)
{
    $texto = strtolower($texto);
    $texto = iconv('UTF-8', 'ASCII//TRANSLIT', $texto);
    $texto = preg_replace('/[^a-z0-9]+/', '-', $texto);
    $texto = trim($texto, '-');
    return $texto;
}

/**
 * Convierte imagen a WEBP y la redimensiona a 1170x1234
 * Devuelve la ruta lista para guardar en el JSON
 */
function procesarImagen($file, $nombreProducto, $indice)
{
    $anchoFinal = 1170;
    $altoFinal  = 1234;

    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
        throw new Exception("Formato de imagen no permitido");
    }

    // Crear imagen base
    if ($extension === 'png') {
        $imagenOriginal = imagecreatefrompng($file['tmp_name']);
    } else {
        $imagenOriginal = imagecreatefromjpeg($file['tmp_name']);
    }

    if (!$imagenOriginal) {
        throw new Exception("No se pudo procesar la imagen");
    }

    // Crear lienzo final
    $imagenFinal = imagecreatetruecolor($anchoFinal, $altoFinal);

    // Fondo blanco (por si viene PNG transparente)
    $blanco = imagecolorallocate($imagenFinal, 255, 255, 255);
    imagefill($imagenFinal, 0, 0, $blanco);

    // Obtener dimensiones originales
    $anchoOrig = imagesx($imagenOriginal);
    $altoOrig  = imagesy($imagenOriginal);

    // Redimensionar
    imagecopyresampled(
        $imagenFinal,
        $imagenOriginal,
        0, 0, 0, 0,
        $anchoFinal,
        $altoFinal,
        $anchoOrig,
        $altoOrig
    );

    // Nombre final
    $slug = generarSlug($nombreProducto);
    $nombreArchivo = $slug . '-img' . $indice . '.webp';

    $rutaFisica = __DIR__ . '/../../public/images/' . $nombreArchivo;
    $rutaJson   = '/images/' . $nombreArchivo;

    imagewebp($imagenFinal, $rutaFisica, 85);

    imagedestroy($imagenOriginal);
    imagedestroy($imagenFinal);

    return $rutaJson;
}
