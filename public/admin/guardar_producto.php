<?php
require 'auth.php';


$json_file = __DIR__ . '/../data/productos.json';
$images_dir = __DIR__ . '/../images/';

// función para convertir y redimensionar a webp
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



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $productos = json_decode(file_get_contents($json_file), true);

    // generar nuevo ID
    $nuevoId = count($productos) > 0
        ? max(array_column($productos, 'id')) + 1
        : 1;

    // limpiar nombre para usar en imagen
    $slug = strtolower(trim($_POST['nombre']));
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);

    $imagenes = [];

    // imagen 1
    $img1_name = $slug . '-img1.webp';
    convertirWebp($_FILES['imagen1']['tmp_name'], $images_dir . $img1_name);
    $imagenes[] = '/images/' . $img1_name;

    // imagen 2 (opcional)
    if (!empty($_FILES['imagen2']['tmp_name'])) {
        $img2_name = $slug . '-img2.webp';
        convertirWebp($_FILES['imagen2']['tmp_name'], $images_dir . $img2_name);
        $imagenes[] = '/images/' . $img2_name;
    }

    $nuevoProducto = [
        "id" => $nuevoId,
        "nombre" => $_POST['nombre'],
        "descripcion" => $_POST['descripcion'],
        "precio" => (int)$_POST['precio'],
        "stock" => (int)$_POST['stock'],
        "genero" => $_POST['genero'],
        "imagenes" => $imagenes
    ];

    $productos[] = $nuevoProducto;

    file_put_contents(
        $json_file,
        json_encode($productos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );

    header("Location: index.php?success=1");
    exit;
}
