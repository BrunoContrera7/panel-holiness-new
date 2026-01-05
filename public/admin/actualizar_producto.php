<?php
require 'auth.php';

$jsonPath = __DIR__ . '/../data/productos.json';
$productos = json_decode(file_get_contents($jsonPath), true);

$id = $_POST['id'];

function convertirWebp($tmp, $destino) {

    $img = imagecreatefromstring(file_get_contents($tmp));
    if (!$img) {
        die("❌ No se pudo crear la imagen");
    }

    $targetWidth = 1170;
    $targetHeight = 1234;

    $srcWidth = imagesx($img);
    $srcHeight = imagesy($img);

    // calcular escala tipo "cover"
    $scale = max(
        $targetWidth / $srcWidth,
        $targetHeight / $srcHeight
    );

    $newWidth = (int) ($srcWidth * $scale);
    $newHeight = (int) ($srcHeight * $scale);

    // crear imagen redimensionada
    $resized = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled(
        $resized,
        $img,
        0, 0, 0, 0,
        $newWidth,
        $newHeight,
        $srcWidth,
        $srcHeight
    );

    // crear canvas final
    $final = imagecreatetruecolor($targetWidth, $targetHeight);

    // calcular recorte centrado
    $x = (int) (($newWidth - $targetWidth) / 2);
    $y = (int) (($newHeight - $targetHeight) / 2);

    imagecopy(
        $final,
        $resized,
        0, 0,
        $x, $y,
        $targetWidth,
        $targetHeight
    );

    if (!imagewebp($final, $destino, 85)) {
        die("❌ No se pudo guardar el archivo webp");
    }

    imagedestroy($img);
    imagedestroy($resized);
    imagedestroy($final);
}

foreach ($productos as &$p) {
    if ($p['id'] == $id) {

        $p['nombre'] = $_POST['nombre'];
        $p['descripcion'] = $_POST['descripcion'];
        $p['precio'] = (int)$_POST['precio'];
        $p['stock'] = (int)$_POST['stock'];
        $p['genero'] = $_POST['genero'];

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['nombre'])));
        $imgDir = __DIR__ . '/../images/';

        // IMG 1
        if (!empty($_FILES['img1']['tmp_name'])) {
            $dest = $imgDir . $slug . '-img1.webp';
            convertirWebp($_FILES['img1']['tmp_name'], $dest);
            $p['imagenes'][0] = '/images/' . $slug . '-img1.webp';
        }

        // IMG 2
        if (!empty($_FILES['img2']['tmp_name'])) {
            $dest = $imgDir . $slug . '-img2.webp';
            convertirWebp($_FILES['img2']['tmp_name'], $dest);
            $p['imagenes'][1] = '/images/' . $slug . '-img2.webp';
        }

        break;
    }
}

file_put_contents($jsonPath, json_encode($productos, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

header('Location: index.php');
exit;
