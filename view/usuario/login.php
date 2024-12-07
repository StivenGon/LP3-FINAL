<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <?php include_once(ROOT_PATH . 'header.php') ?>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            background-image: url('/lp3final/bibliochida/assets/images/background-bookshelf.webp');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .vh-100 {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container-fluid.h-custom {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 3rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px; /* Reduced width for thinner form */
            text-align: center;
            box-sizing: border-box;
        }

        .form-outline {
            margin-bottom: 20px;
        }

        .form-outline input {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 1rem;
            width: 100%;
        }

        .btn {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .login-image {
            max-width: 100px; /* Image width */
            margin-bottom: 15px;
        }

        h1 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #333;
        }

        @media (max-width: 576px) {
            .container-fluid.h-custom {
                padding: 2rem;
            }

            .btn {
                font-size: 0.9rem;
            }

            .form-outline input {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <!-- Add the image here -->
            <img src="/lp3final/bibliochida/assets/images/perfil-de-usuario.webp" alt="Login Icon" class="login-image">
            <h1 class="text-login">Iniciar sesión</h1>
            <form id="formLogin" action="" method="post" autocomplete="off">
                <div class="form-outline mb-4">
                    <input type="text" name="usuario" id="usuario" class="form-control form-control-lg" placeholder="Ingrese usuario" autocorrect="off" spellcheck="false" />
                </div>
                <div class="form-outline mb-3">
                    <input type="password" name="clave" id="clave" class="form-control form-control-lg" placeholder="Digite contraseña" autocorrect="off" spellcheck="false" />
                </div>
                <div class="text-center text-lg-start mt-4 pt-2">
                    <button type="submit" class="btn btn-primary btn-lg">Acceder</button>
                </div>
            </form>
        </div>
    </section>
</body>
<?php include_once(ROOT_PATH . 'footer.php') ?>
</html>
