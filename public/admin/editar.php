<?php
require 'auth.php';

$json_file = __DIR__ . '/../data/productos.json';
$productos = json_decode(file_get_contents($json_file), true);

$id = $_GET['id'] ?? null;
$producto = null;

foreach ($productos as $p) {
    if ($p['id'] == $id) {
        $producto = $p;
        break;
    }
}

if (!$producto) {
    die('Producto no encontrado');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<!-- 🔑 CLAVE PARA MOBILE -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Editar producto</title>

<style>
* {
    box-sizing: border-box;
}

body {
    font-family: system-ui, sans-serif;
    background: #0f0f0f;
    color: #e5e5e5;
    margin: 0;
}

/* ===== TOPBAR ===== */
.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 24px;
    background: #000;
    border-bottom: 1px solid #222;
    gap: 10px;
    flex-wrap: wrap;
}

.topbar h1 {
    margin: 0;
    font-size: 20px;
    font-weight: 600;
}

.topbar a {
    color: #fff;
    text-decoration: none;
    padding: 8px 14px;
    border: 1px solid #333;
    border-radius: 6px;
    font-size: 14px;
    white-space: nowrap;
}

.topbar a:hover {
    background: #222;
}

/* ===== CONTENEDOR ===== */
.container {
    max-width: 800px;
    margin: 32px auto;
    padding: 0 20px;
}

.card {
    background: #151515;
    padding: 30px;
    border-radius: 12px;
    border: 1px solid #222;
    box-shadow: 0 0 30px rgba(0,0,0,.6);
}

h2 {
    margin-top: 0;
    margin-bottom: 25px;
    font-size: 22px;
}

label {
    display: block;
    margin-top: 18px;
    margin-bottom: 6px;
    font-size: 14px;
    color: #aaa;
}

input,
textarea,
select {
    width: 100%;
    padding: 10px 12px;
    background: #0f0f0f;
    border: 1px solid #2a2a2a;
    border-radius: 8px;
    color: #fff;
    font-size: 14px;
}

textarea {
    resize: vertical;
    min-height: 100px;
}

input:focus,
textarea:focus,
select:focus {
    outline: none;
    border-color: #555;
}

/* ===== ROW ===== */
.row {
    display: flex;
    gap: 20px;
    margin-top: 10px;
}

.row > div {
    flex: 1;
}

/* ===== IMÁGENES ===== */
.preview {
    width: 160px;
    height: 160px;
    object-fit: cover;
    border-radius: 10px;
    border: 1px solid #333;
    margin-bottom: 10px;
}

/* ===== ACTIONS ===== */
.actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 32px;
    gap: 15px;
    flex-wrap: wrap;
}

.back {
    color: #aaa;
    text-decoration: none;
    font-size: 14px;
}

.back:hover {
    text-decoration: underline;
}

button {
    background: #fff;
    border: none;
    color: #000;
    padding: 12px 22px;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
}

button:hover {
    background: #e5e5e5;
}

/* ===== MOBILE ===== */
@media (max-width: 768px) {

    .topbar {
        padding: 14px 16px;
    }

    .topbar a {
        width: 100%;
        text-align: center;
    }

    .container {
        margin: 20px auto;
        padding: 0 16px;
    }

    .card {
        padding: 22px;
    }

    .row {
        flex-direction: column;
    }

    .preview {
        width: 100%;
        height: auto;
        aspect-ratio: 1 / 1;
    }

    .actions {
        flex-direction: column;
        align-items: stretch;
    }

    button {
        width: 100%;
    }
}
</style>
</head>

<body>

<header class="topbar">
    <h1>Editar producto</h1>
    <a href="index.php">← Volver</a>
</header>

<div class="container">
    <div class="card">

        <h2><?= htmlspecialchars($producto['nombre']) ?></h2>

        <form method="post" action="guardar_edicion.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $producto['id'] ?>">

            <label>Nombre</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required>

            <label>Descripción</label>
            <textarea name="descripcion"><?= htmlspecialchars($producto['descripcion']) ?></textarea>

            <div class="row">
                <div>
                    <label>Precio</label>
                    <input type="number" name="precio" value="<?= $producto['precio'] ?>" min="0">
                </div>

                <div>
                    <label>Stock</label>
                    <select name="stock">
                        <option value="1" <?= $producto['stock'] == 1 ? 'selected' : '' ?>>Disponible</option>
                        <option value="0" <?= $producto['stock'] == 0 ? 'selected' : '' ?>>Sin stock</option>
                    </select>
                </div>

                <div>
                    <label>Género</label>
                    <select name="genero">
                        <option <?= $producto['genero'] === 'Hombre' ? 'selected' : '' ?>>Hombre</option>
                        <option <?= $producto['genero'] === 'Mujer' ? 'selected' : '' ?>>Mujer</option>
                        <option <?= $producto['genero'] === 'Unisex' ? 'selected' : '' ?>>Unisex</option>
                    </select>
                </div>
            </div>

            <label>Imagen 1</label>
            <img src="/copia-panel-holiness/public<?= $producto['imagenes'][0] ?>" class="preview">
            <input type="file" name="imagen1" accept="image/*">

            <?php if (isset($producto['imagenes'][1])): ?>
                <label style="margin-top:20px;">Imagen 2</label>
                <img src="/copia-panel-holiness/public<?= $producto['imagenes'][1] ?>" class="preview">
                <input type="file" name="imagen2" accept="image/*">
            <?php endif; ?>

            <div class="actions">
                <a class="back" href="index.php">← Volver al panel</a>
                <button type="submit">Guardar cambios</button>
            </div>

        </form>
    </div>
</div>

</body>
</html>
