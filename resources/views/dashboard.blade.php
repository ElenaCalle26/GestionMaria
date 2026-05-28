<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }
        .page-title {
            color: #2c3e50;
            margin-bottom: 30px;
        }
        .page-title h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }
        .page-title p {
            color: #999;
            font-size: 14px;
        }
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        .menu-card {
            background: white;
            padding: 25px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-decoration: none;
            color: inherit;
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 4px solid #1abc9c;
        }
        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }
        .menu-card h3 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 18px;
        }
        .menu-card p {
            color: #999;
            font-size: 13px;
        }
        .user-info-box {
            background: white;
            padding: 15px 25px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: right;
        }
        .user-info-box p {
            margin: 3px 0;
            font-size: 13px;
        }
        .user-info-box .username {
            font-weight: 600;
            color: #2c3e50;
            font-size: 14px;
        }
        .user-info-box .role {
            color: #1abc9c;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">Gestion_Maria</div>
        <div class="menu">
            <a href="/profile" class="menu-item">Mi Perfil</a>
            @if(session('user_role') === 'admin')
                <a href="/users" class="menu-item">Usuarios</a>
            @endif
        </div>
        <a href="/logout" class="menu-item" style="text-align: center;">Cerrar Sesión</a>
    </div>

    <div class="main-content">
        <div class="top-header">
            <div class="page-title">
                <h1>📊 Dashboard</h1>
                <p>Bvenido al sistema de gestión</p>
            </div>
            <div class="user-info-box">
                <p>Usuario: <span class="username">{{ session('user_name') }}</span></p>
                <p>Rol: <span class="role">{{ session('user_role') === 'admin' ? 'Administrador' : 'Usuario' }}</span></p>
            </div>
        </div>

        <div class="content">
            <div class="menu-grid">
                @if(session('user_role') === 'admin')
                    <a href="/users" class="menu-card">
                        <h3>Gestionar Usuarios</h3>
                        <p>ABM de usuarios del sistema</p>
                    </a>
                @endif

                <a href="/profile" class="menu-card">
                    <h3>Mi Perfil</h3>
                    <p>Ver información personal</p>
                </a>
            </div>
        </div>
    </div>
</body>
</html>