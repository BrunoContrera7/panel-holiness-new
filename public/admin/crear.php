<?php
require 'auth.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- 🔑 CLAVE PARA MOBILE -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Agregar producto</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            background: #0f0f0f;
            color: #e5e5e5;
            margin: 0;
        }

        /* ===== TOP BAR ===== */
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
            max-width: 720px;
            margin: 40px auto;
            padding: 0 20px;
        }

        form {
            background: #000;
            border: 1px solid #222;
            border-radius: 12px;
            padding: 24px;
        }

        label {
            display: block;
            margin-top: 18px;
            margin-bottom: 6px;
            font-size: 14px;
            font-weight: 500;
            color: #ccc;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px 12px;
            background: #0f0f0f;
            border: 1px solid #333;
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #555;
        }

        button {
            margin-top: 28px;
            width: 100%;
            padding: 14px;
            background: #fff;
            color: #000;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }

        button:hover {
            background: #e5e5e5;
        }

        .hint {
            font-size: 12px;
            color: #888;
            margin-top: 4px;
        }

        /* ===== MOBILE ===== */
        @media (max-width: 768px) {

            .topbar {
                padding: 14px 16px;
            }

            .topbar h1 {
                font-size: 18px;
            }

            .topbar a {
                width: 100%;
                text-align: center;
            }

            .container {
                margin: 24px auto;
                padding: 0 16px;
            }

            form {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<header class="topbar">
    <h1>Agregar producto</h1>
    <a href="index.php">← Volver</a>
</header>

<div class="container">

    <form action="guardar_producto.php" method="POST" enctype="multipart/form-data">

        <label>Nombre</label>
        <input type="text" name="nombre" required>

        <label>Descripción</label>
        <textarea name="descripcion" rows="4" required></textarea>

        <label>Precio</label>
        <input type="number" name="precio" min="0" required>

        <label>Disponibilidad</label>
        <select name="stock" required>
            <option value="1">Disponible</option>
            <option value="0">Sin stock</option>
        </select>

        <label>Género</label>
        <select name="genero" required>
            <option value="">Seleccionar</option>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
            <option value="Unisex">Unisex</option>
        </select>

        <label>Imagen 1</label>
        <input type="file" name="imagen1" accept="image/png, image/jpeg" required>
        <div class="hint">Imagen principal (se convertirá a WebP y se recortará)</div>

        <label>Imagen 2</label>
        <input type="file" name="imagen2" accept="image/png, image/jpeg">
        <div class="hint">Opcional</div>

        <button type="submit">Guardar producto</button>

    </form>

</div>

</body>
</html>
