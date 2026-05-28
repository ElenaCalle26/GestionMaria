<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
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
        .header-right {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }
        .page-title {
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .new-btn {
            background: #1abc9c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
        }
        .new-btn:hover { background: #16a085; }
        .logout-btn {
            background: #e74c3c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }
        .logout-btn:hover { background: #c0392b; }
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background: #1a2c3d;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: 600;
        }
        td {
            padding: 10px 12px;
            border-bottom: 1px solid #eee;
        }
        tbody tr:hover { background: #f9f9f9; }
        .action-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-right: 5px;
            font-size: 12px;
            transition: background 0.3s;
        }
        .edit-btn {
            background: #1abc9c;
            color: white;
        }
        .edit-btn:hover { background: #16a085; }
        .delete-btn {
            background: #e74c3c;
            color: white;
        }
        .delete-btn:hover { background: #c0392b; }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #28a745;
        }
        .role-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: 600;
        }
        .role-admin {
            background: #1a2c3d;
            color: white;
        }
        .role-user {
            background: #95a5a6;
            color: white;
        }
        .empty-message {
            text-align: center;
            color: #999;
            padding: 40px;
            font-size: 14px;
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
            <a href="/profile" class="menu-item">Mi Perfil</a>
            @if(session('user_role') === 'admin')
                <a href="/users" class="menu-item active">Usuarios</a>
            @endif
        </div>
        <a href="/logout" class="menu-item" style="text-align: center;">Cerrar Sesión</a>
    </div>

    <div class="main-content">
        <div class="top-header">
            <div>
                <h2>Usuarios</h2>
                <p style="color: #999; font-size: 13px; margin-top: 3px;">Gestionar usuarios del sistema</p>
            </div>
            <div class="header-right">
                <a href="/users/create" class="new-btn">Nuevo</a>
            </div>
        </div>

        <div class="content">
            <div class="breadcrumb">
                <a href="/dashboard">Home</a> / usuarios
            </div>

            @if(session('success'))
                <div class="success">{{ session('success') }}</div>
            @endif

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 25%;">Nombres</th>
                            <th style="width: 25%;">Tipo de usuario</th>
                            <th style="width: 20%;">Usuario</th>
                            <th style="width: 20%;">correo</th>
                            <th style="width: 15%;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    <span class="role-badge {{ $user->role === 'admin' ? 'role-admin' : 'role-user' }}">
                                        {{ $user->role === 'admin' ? 'Admin' : 'Usuario' }}
                                    </span>
                                </td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="/users/{{ $user->id }}/edit" class="action-btn edit-btn">Editar</a>
                                    <form method="POST" action="/users/{{ $user->id }}" style="display:inline;" onsubmit="return confirm('¿Está seguro de que desea eliminar este usuario?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete-btn">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty-message">
                                    No hay usuarios registrados aún. <a href="/users/create" style="color: #1abc9c;">Crear uno</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 15px; text-align: right; color: #999; font-size: 13px;">
                Mostrando 1 a {{ count($users) }} de {{ count($users) }} entradas
            </div>
        </div>
    </div>
</body>
</html>