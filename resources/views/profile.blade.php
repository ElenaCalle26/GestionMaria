<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
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
        .profile-container {
            background: white;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            max-width: 600px;
        }
        .profile-title {
            color: #2c3e50;
            margin-bottom: 25px;
            font-size: 22px;
        }
        .profile-item {
            margin-bottom: 20px;
            padding: 15px;
            background: #f9f9f9;
            border-left: 4px solid #1abc9c;
            border-radius: 3px;
        }
        .label {
            color: #999;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .value {
            color: #333;
            font-size: 16px;
            margin-top: 5px;
            font-weight: 500;
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
        .breadcrumb a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">Gestion_Maria</div>
        <div class="menu">
            <a href="/profile" class="menu-item active">Mi Perfil</a>
            @if(session('user_role') === 'admin')
                <a href="/users" class="menu-item">Usuarios</a>
            @endif
        </div>
        <a href="/logout" class="menu-item" style="text-align: center;">Cerrar Sesión</a>
    </div>

    <div class="main-content">
        <div class="top-header">
            <h2>Mi Perfil</h2>
            <p style="color: #999; font-size: 13px; margin-top: 3px;">Información de tu cuenta</p>
        </div>

        <div class="content">
            <div class="breadcrumb">
                <a href="/dashboard">Home</a> / perfil
            </div>

            <div class="profile-container">
                <h3 class="profile-title">Información Personal</h3>

                <div class="profile-item">
                    <div class="label">Nombre Completo</div>
                    <div class="value">{{ $user->name }}</div>
                </div>

                <div class="profile-item">
                    <div class="label">Usuario</div>
                    <div class="value">{{ $user->username }}</div>
                </div>

                <div class="profile-item">
                    <div class="label">Email</div>
                    <div class="value">{{ $user->email }}</div>
                </div>

                <div class="profile-item">
                    <div class="label">Rol</div>
                    <div class="value">
                        <span style="background: {{ $user->role === 'admin' ? '#1a2c3d' : '#95a5a6' }}; color: white; padding: 5px 10px; border-radius: 3px; font-size: 14px;">
                            {{ $user->role === 'admin' ? 'Administrador' : 'Usuario' }}
                        </span>
                    </div>
                </div>

                <div class="profile-item">
                    <div class="label">Miembro desde</div>
                    <div class="value">{{ $user->created_at->format('d/m/Y H:i') }}</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>