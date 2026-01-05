<?php
require 'auth.php';

$json_file = __DIR__ . '/../data/productos.json';
$productos = json_decode(file_get_contents($json_file), true);

$id = isset($_POST['id']) ? (int)$_POST['id'] : null;
if (!$id) {
    header('Location: index.php');
    exit;
}

/* ========= funciones ========= */

function slugify($text) {
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

function convertirWebpCrop($tmp, $dest, $w = 1170, $h = 1234) {
    $data = file_get_contents($tmp);
    $src = imagecreatefromstring($data);
    if (!$src) return false;

    $sw = imagesx($src);
    $sh = imagesy($src);

    $src_ratio = $sw / $sh;
    $dst_ratio = $w / $h;

    if ($src_ratio > $dst_ratio) {
        $new_h = $sh;
        $new_w = (int)($sh * $dst_ratio);
        $sx = (int)(($sw - $new_w) / 2);
        $sy = 0;
    } else {
        $new_w = $sw;
        $new_h = (int)($sw / $dst_ratio);
        $sx = 0;
        $sy = (int)(($sh - $new_h) / 2);
    }

    $dst_img = imagecreatetruecolor($w, $h);
    imagecopyresampled($dst_img, $src, 0, 0, $sx, $sy, $w, $h, $new_w, $new_h);

    if (!is_dir(dirname($dest))) {
        mkdir(dirname($dest), 0777, true);
    }

    $ok = imagewebp($dst_img, $dest, 90);

    imagedestroy($src);
    imagedestroy($dst_img);

    return $ok;
}

/* ========= actualizar ========= */

foreach ($productos as &$p) {
    if ($p['id'] !== $id) continue;

    $p['nombre'] = trim($_POST['nombre']);
    $p['descripcion'] = trim($_POST['descripcion']);
    $p['precio'] = (int)$_POST['precio'];
    $p['stock'] = (int)$_POST['stock'];
    $p['genero'] = $_POST['genero'];

    $slug = slugify($p['nombre']);

    // Imagen 1
    if (!empty($_FILES['imagen1']['tmp_name'])) {
        $dest1 = __DIR__ . "/../images/{$slug}-img1.webp";
        if (convertirWebpCrop($_FILES['imagen1']['tmp_name'], $dest1)) {
            $p['imagenes'][0] = "/images/{$slug}-img1.webp";
        }
    }

    // Imagen 2
    if (!empty($_FILES['imagen2']['tmp_name'])) {
        $dest2 = __DIR__ . "/../images/{$slug}-img2.webp";
        if (convertirWebpCrop($_FILES['imagen2']['tmp_name'], $dest2)) {
            $p['imagenes'][1] = "/images/{$slug}-img2.webp";
        }
    }

    break;
}

file_put_contents(
    $json_file,
    json_encode($productos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

header('Location: index.php?edit=ok');
exit;
