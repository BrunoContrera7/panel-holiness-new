<?php
session_start();
require 'auth.php';

$json_file = __DIR__ . '/../data/productos.json';
$productos = json_decode(file_get_contents($json_file), true);

$success = isset($_GET['success']);
$deleted = isset($_GET['deleted']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- 🔑 CLAVE para mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Panel Admin</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #0f0f0f;
            color: #e5e5e5;
            padding: 20px;
        }

        h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }

        /* ===== TOP BAR ===== */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .top-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn,
        .logout {
            background: #1f1f1f;
            color: #fff;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            border: 1px solid #2f2f2f;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .btn:hover,
        .logout:hover {
            background: #2a2a2a;
        }

        /* ===== MENSAJES ===== */
        .success {
            background: #143a24;
            color: #4ade80;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            max-width: 1100px;
        }

        /* ===== TABLA ===== */
        .table-container {
            overflow-x: auto;
            border-radius: 12px;
        }

        table {
            width: 100%;
            min-width: 900px; /* fuerza scroll en mobile */
            border-collapse: collapse;
            background: #151515;
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #2a2a2a;
            font-size: 14px;
        }

        th {
            background: #1b1b1b;
            color: #bdbdbd;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        tr:hover {
            background: #1f1f1f;
        }

        .precio {
            font-weight: 600;
        }

        .genero {
            opacity: 0.85;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .stock-ok {
            background: #143a24;
            color: #4ade80;
        }

        .stock-no {
            background: #3a1414;
            color: #f87171;
        }

        .acciones a {
            margin-right: 10px;
            color: #e5e5e5;
            text-decoration: none;
            font-size: 14px;
            white-space: nowrap;
        }

        .acciones a:hover {
            text-decoration: underline;
        }

        .btn-delete {
            color: #ff6b6b;
        }

        /* ===== MOBILE ===== */
        @media (max-width: 768px) {
            h1 {
                font-size: 22px;
            }

            .top-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            .top-actions {
                width: 100%;
            }

            .btn,
            .logout {
                width: 100%;
                text-align: center;
            }

            body {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

    <div class="top-bar">
        <h1>Panel de productos</h1>

        <div class="top-actions">
            <a href="crear.php" class="btn">➕ Nuevo producto</a>
            <a href="logout.php" class="logout">Cerrar sesión</a>
        </div>
    </div>

    <?php if ($success): ?>
        <div class="success">✅ Cambios guardados correctamente</div>
    <?php endif; ?>

    <?php if ($deleted): ?>
        <div class="success">🗑 Producto eliminado correctamente</div>
    <?php endif; ?>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Género</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($productos as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= htmlspecialchars($p['nombre']) ?></td>
                    <td class="genero"><?= $p['genero'] ?? '-' ?></td>
                    <td class="precio">$<?= number_format($p['precio'], 0, ',', '.') ?></td>
                    <td>
                        <?php if ($p['stock'] == 1): ?>
                            <span class="badge stock-ok">Disponible</span>
                        <?php else: ?>
                            <span class="badge stock-no">Sin stock</span>
                        <?php endif; ?>
                    </td>
                    <td class="acciones">
                        <a href="editar.php?id=<?= $p['id'] ?>">✏️ Editar</a>
                        <a href="eliminar.php?id=<?= $p['id'] ?>"
                           class="btn-delete"
                           onclick="return confirm('¿Seguro que querés eliminar este producto?');">
                           Eliminar 🗑
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
