<?php
session_start();
$config = require 'config.php';

$error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'] ?? '';
    $pass = $_POST['password'] ?? '';

    if ($user === $config['user'] && $pass === $config['password']) {
        $_SESSION['logged'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            background: #0f0f0f;
            color: #e5e5e5;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-box {
            width: 100%;
            max-width: 360px;
            background: #000;
            border: 1px solid #222;
            border-radius: 12px;
            padding: 28px;
        }

        .login-box h2 {
            margin: 0 0 24px;
            text-align: center;
            font-size: 20px;
            font-weight: 600;
        }

        label {
            display: block;
            font-size: 13px;
            margin-bottom: 6px;
            color: #aaa;
        }

        input {
            width: 100%;
            padding: 11px 12px;
            margin-bottom: 16px;
            border-radius: 8px;
            border: 1px solid #333;
            background: #0f0f0f;
            color: #fff;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #555;
        }

        button {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: none;
            background: #fff;
            color: #000;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }

        button:hover {
            background: #e5e5e5;
        }

        button:active {
            transform: scale(0.98);
        }

        .error {
            margin-top: 16px;
            text-align: center;
            color: #ff4d4d;
            font-size: 13px;
        }
    </style>
</head>

<body>

<div class="login-box">
    <form method="post">
        <h2>Panel Admin</h2>

        <label>Usuario</label>
        <input type="text" name="user" required>

        <label>Contraseña</label>
        <input type="password" name="password" required>

        <button type="submit">Entrar</button>

        <?php if ($error): ?>
            <div class="error">Usuario o contraseña incorrectos</div>
        <?php endif; ?>
    </form>
</div>

</body>
</html>
