<?php
require 'auth.php';

$json_file = __DIR__ . '/../data/productos.json';
$productos = json_decode(file_get_contents($json_file), true);

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
if (!$id) {
    header('Location: index.php');
    exit;
}

$nuevos = [];

foreach ($productos as $p) {
    if ($p['id'] === $id) {

        // borrar imágenes
        if (!empty($p['imagenes'])) {
            foreach ($p['imagenes'] as $img) {
                $ruta = __DIR__ . '/..' . $img;
                if (file_exists($ruta)) {
                    unlink($ruta);
                }
            }
        }

        continue; // no lo agregamos al nuevo array
    }

    $nuevos[] = $p;
}

file_put_contents(
    $json_file,
    json_encode($nuevos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

header('Location: index.php?deleted=1');
exit;
