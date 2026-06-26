<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta - ClickUp</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background-color: #ffffff;
            color: #000000;
            overflow-x: hidden; /* Evita barras de desplazamiento horizontales */
        }

        /* --- Contenedor de la Imagen Banner (Esquina Superior Derecha) --- */
        .banner-container {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 1;
            pointer-events: none; /* Permite hacer clic en los inputs si se llegan a cruzar */
        }

        .banner-container img {
            width: 48vw; /* Ajusta este tamaño según prefieras en tu pantalla */
            height: auto;
            display: block;
        }

        /* --- Contenedor del Formulario --- */
        .form-container {
            position: relative;
            z-index: 2;
            max-width: 600px;
            margin: 0 auto;
            padding: 80px 20px;
            box-sizing: border-box;
        }

        .main-title {
            font-size: 2.2rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: bold;
            color: #333;
            margin-top: 30px;
            margin-bottom: 15px;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-row .form-group {
            flex: 1;
            margin-bottom: 0;
        }

        label {
            display: block;
            font-size: 1rem;
            color: #666;
            margin-bottom: 8px;
        }

        /* Inputs de color gris y totalmente redondos como en tu captura */
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 14px 20px;
            font-size: 1rem;
            background-color: #e5e7eb;
            border: none;
            border-radius: 30px;
            box-sizing: border-box;
            color: #333;
            outline: none;
        }

        input::placeholder {
            color: #9ca3af;
        }

        /* Contenedores con iconos de ojo y calendario */
        .input-icon-wrapper {
            position: relative;
            width: 100%;
        }

        .input-icon-wrapper .icon-inside {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            pointer-events: none;
            display: flex;
            align-items: center;
        }

        /* Textos y Checkboxes */
        .disclaimer-text {
            font-size: 0.85rem;
            color: #333;
            margin-top: 30px;
            margin-bottom: 25px;
            line-height: 1.4;
            font-weight: 600;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }

        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #f97316;
            cursor: pointer;
        }

        .checkbox-group label {
            font-size: 0.9rem;
            color: #000;
            margin-bottom: 0;
            font-weight: 600;
            cursor: pointer;
        }

        /* --- Botones Inferiores --- */
        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 45px;
        }

        .btn-back {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: #000000;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .btn-submit {
            background-color: #f97316;
            color: white;
            border: none;
            padding: 15px 45px;
            font-size: 1.1rem;
            font-weight: bold;
            border-radius: 30px;
            cursor: pointer;
        }

        /* --- Alerta de errores de Laravel --- */
        .error-alert {
            background-color: #fca5a5;
            color: #b91c1c;
            padding: 15px 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            font-weight: 600;
            font-size: 0.95rem;
        }
        .error-alert ul {
            margin: 5px 0 0 0;
            padding-left: 20px;
        }
    </style>
</head>
<body>

    <div class="banner-container">
        <img src="{{ asset('images/Banner.jpg') }}" alt="Banner Decorativo">
    </div>

    <div class="form-container">
        <h1 class="main-title">¿Aún no tienes cuenta? Registrate</h1>

        @if ($errors->any())
            <div class="error-alert">
                <span>Por favor, corrige los siguientes campos:</span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('registro.store') }}" method="POST">
            @csrf

            <div class="section-title">Información personal</div>

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" placeholder="Ej. Angel" required>
            </div>

            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" placeholder="Ej. Rosales" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="tipo_documento">Tipo de Documento</label>
                    <select id="tipo_documento" name="tipo_documento" required>
                        <option value="DNI" {{ old('tipo_documento') == 'DNI' ? 'selected' : '' }}>DNI</option>
                        <option value="CE" {{ old('tipo_documento') == 'CE' ? 'selected' : '' }}>C.E.</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="documento">Documento</label>
                    <input type="text" id="documento" name="documento" value="{{ old('documento') }}" placeholder="Seleccione el tipo de Documento" maxlength="8" required 
                           oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>
            </div>

            <div class="form-group">
                <label for="telefono">Numero de teléfono</label>
                <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}" required 
                       oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            </div>

            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de nacimiento</label>
                <div class="input-icon-wrapper">
                    <input type="text" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" placeholder="DD / MM / AAAA" maxlength="10" required 
                           oninput="formatearFecha(this)">
                    <div class="icon-inside">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="section-title">Información de inicio de sesión</div>

            <div class="form-group">
                <label for="email">Correo Electronico</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Ej. Angel" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <div class="input-icon-wrapper">
                    <input type="password" id="password" name="password" placeholder="Aal6723" required>
                    <div class="icon-inside">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <div class="input-icon-wrapper">
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Aal6723" required>
                    <div class="icon-inside">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </div>
                </div>
            </div>

            <p class="disclaimer-text">
                Al registrase aceptas nuestros términos y condiciones y nuestra política de tratamiento de datos personales
            </p>

            <div class="checkbox-group">
                <input type="checkbox" id="promociones" name="promociones" {{ old('promociones') ? 'checked' : '' }}>
                <label for="promociones">Acepto recibir promociones y novedades</label>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="transferencia" name="transferencia" {{ old('transferencia') ? 'checked' : '' }}>
                <label for="transferencia">Acepto la transferencia de datos a empresas asociadas</label>
            </div>

            <div class="action-buttons">
                <a href="{{ route('login') }}" class="btn-back">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    Regresar
                </a>
                <button type="submit" class="btn-submit">Crear cuenta</button>
            </div>

        </form>
    </div>

    <script>
        function formatearFecha(input) {
            let v = input.value.replace(/\D/g, ''); // Remueve lo que no sea número
            if (v.length > 2) v = v.slice(0, 2) + '/' + v.slice(2);
            if (v.length > 5) v = v.slice(0, 5) + '/' + v.slice(5, 9);
            input.value = v;
        }
    </script>
</body>
</html>