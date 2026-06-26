<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar a ClickUp</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #1a1a1a;
            display: block;
        }

        /* ====== VISTA 1: INICIO SESIÓN (DOS PANELES) ====== */
        .login-page-container {
            width: 100%;
            min-height: 100vh;
            background: linear-gradient(to bottom, #7c3f12 0%, #7c3f12 40%, #808080 40%, #808080 100%);
            padding: 60px 20px;
            text-align: center;
        }

        .login-card {
            display: inline-block;
            width: 100%;
            max-width: 950px;
            background: #fff;
            border-radius: 40px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            text-align: left;
        }

        .split-container {
            display: table;
            width: 100%;
        }

        .panel-form {
            display: table-cell;
            width: 53%;
            background: #fff;
            padding: 50px 60px;
            vertical-align: middle;
            position: relative;
        }

        .btn-back-arrow {
            color: #000;
            font-size: 20pt;
            text-decoration: none;
            position: absolute;
            top: 40px;
            left: 50px;
            font-weight: bold;
        }

        .panel-title {
            font-size: 20pt;
            font-weight: bold;
            color: #000;
            text-align: center;
            margin-bottom: 35px;
            margin-top: 20px;
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-field {
            width: 100%;
            padding: 15px 20px;
            border: 1.5px solid #ccc;
            border-radius: 12px;
            font-size: 13pt;
            color: #333;
            outline: none;
            background: #fff;
        }

        .input-field::placeholder {
            color: #bbb;
        }

        .btn-submit-orange {
            display: block;
            width: 60%;
            margin: 35px auto 0 auto;
            background: #ff7a1a;
            color: #fff;
            padding: 14px;
            border: none;
            border-radius: 20px;
            font-size: 14pt;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background 0.2s;
        }

        .btn-submit-orange:hover {
            background: #e66400;
        }

        .panel-benefits {
            display: table-cell;
            width: 47%;
            background: #dbdbdb;
            padding: 60px 50px;
            vertical-align: middle;
        }

        .benefits-title {
            font-size: 18pt;
            font-weight: bold;
            color: #000;
            margin-bottom: 30px;
        }

        .benefits-subtitle {
            font-size: 11pt;
            font-weight: bold;
            color: #000;
            margin-bottom: 20px;
        }

        .benefits-list {
            list-style: none;
            margin-bottom: 40px;
        }

        .benefits-list li {
            font-size: 11pt;
            color: #000;
            font-weight: 600;
            margin-bottom: 15px;
            position: relative;
            padding-left: 25px;
            line-height: 1.4;
        }

        .benefits-list li::before {
            content: "●";
            color: #ff7a1a;
            font-size: 14pt;
            position: absolute;
            left: 0;
            top: -2px;
        }

        /* ====== Estilos para las Alertas de Laravel ====== */
        .alert-container {
            margin-bottom: 20px;
            font-size: 11pt;
            font-weight: 600;
            border-radius: 12px;
            padding: 15px;
            text-align: left;
        }
        .alert-error {
            background-color: #fca5a5;
            color: #b91c1c;
        }
        .alert-success {
            background-color: #bbf7d0;
            color: #15803d;
        }
        .alert-container ul {
            margin-top: 5px;
            padding-left: 20px;
        }
    </style>
</head>
<body>

    <div class="login-page-container" id="vistaLogin">
        <div class="login-card">
            <div class="split-container">
                
                <div class="panel-form">
                    <a href="{{ url('/') }}" class="btn-back-arrow"><i class="fa-solid fa-angle-left"></i></a>
                    <h2 class="panel-title">Inicia sesión</h2>
                    
                    @if ($errors->any())
                        <div class="alert-container alert-error">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert-container alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('login.store') }}" method="POST">
                        @csrf <div class="input-group">
                            <input type="email" name="email" class="input-field" placeholder="E-mail" value="{{ old('email') }}" required>
                        </div>
                        <div class="input-group">
                            <input type="password" name="password" class="input-field" placeholder="Contraseña" required>
                        </div>
                        
                        <button type="submit" class="btn-submit-orange">Continuar</button>
                    </form>
                </div>

                <div class="panel-benefits">
                    <h2 class="benefits-title">Crear Cuenta</h2>
                    <p class="benefits-subtitle">Crea una y aprovecha los beneficios:</p>
                    
                    <ul class="benefits-list">
                        <li>Realiza tus compras de manera más ágil.</li>
                        <li>Guarda múltiples direcciones de envío y facturación.</li>
                        <li>Realiza el seguimiento a tus compras y revisa tus pedidos realizados.</li>
                        <li>Haz una lista de productos favoritos.</li>
                    </ul>

                    <a href="{{ route('registro') }}" class="btn-submit-orange" style="text-decoration: none; display: inline-block; text-align: center; margin-top: 20px;">Crear cuenta</a>            
                </div>
            </div>
        </div>
    </div>

</body>
</html>