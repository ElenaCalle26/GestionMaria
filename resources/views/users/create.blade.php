<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', sans-serif; 
            background: #f5f5f5;
            display: flex;
            height: 100vh;
        }
        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
        }
        .logo {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 30px;
            padding: 15px;
            background: rgba(255,255,255,0.1);
            border-radius: 5px;
            text-align: center;
        }
        .menu {
            flex: 1;
        }
        .menu-item {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px 15px;
            margin-bottom: 8px;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .menu-item:hover,
        .menu-item.active {
            background: #1abc9c;
        }
        .main-content {
            margin-left: 250px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .top-header {
            background: white;
            padding: 15px 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            max-width: 600px;
        }
        .form-title {
            color: #2c3e50;
            margin-bottom: 25px;
            font-size: 22px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }
        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #1abc9c;
            box-shadow: 0 0 0 3px rgba(26, 188, 156, 0.1);
        }
        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }
        button, .back-btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        button {
            background: #1abc9c;
            color: white;
        }
        button:hover { background: #16a085; }
        .back-btn {
            background: #95a5a6;
            color: white;
        }
        .back-btn:hover { background: #7f8c8d; }
        .error-box {
            background: #fee; 
            color: #c33; 
            padding: 12px; 
            border-radius: 5px; 
            margin-bottom: 20px;
            border-left: 4px solid #e74c3c;
        }
        .error {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
        }
        .breadcrumb {
            color: #666;
            font-size: 13px;
            margin-bottom: 20px;
        }
        .breadcrumb a {
            color: #1abc9c;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">Gestion_Maria</div>
        <div class="menu">
            <a href="/profile" class="menu-item">Mi Perfil</a>
            @if(session('user_role') === 'admin')
                <a href="/users" class="menu-item active">Usuarios</a>
            @endif
        </div>
        <a href="/logout" class="menu-item" style="text-align: center;">Cerrar Sesión</a>
    </div>

    <div class="main-content">
        <div class="top-header">
            <h2>Crear Nuevo Usuario</h2>
            <p style="color: #999; font-size: 13px; margin-top: 3px;">Agregar un nuevo usuario al sistema</p>
        </div>

        <div class="content">
            <div class="breadcrumb">
                <a href="/dashboard">Home</a> / <a href="/users">usuarios</a> / crear
            </div>

            @if($errors->any())
                <div class="error-box">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="form-container">
                <h3 class="form-title">Formulario Nuevo Usuario</h3>

                <form method="POST" action="/users">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nombre Completo</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="username">Usuario</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="ej: omarqm" required>
                        @error('username')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required>
                        @error('password')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="role">Rol</label>
                        <select id="role" name="role" required>
                            <option value="">-- Selecciona un rol --</option>
                            <option value="admin">Administrador</option>
                            <option value="user">Usuario</option>
                        </select>
                        @error('role')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit">Crear Usuario</button>
                        <a href="/users" class="back-btn">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>