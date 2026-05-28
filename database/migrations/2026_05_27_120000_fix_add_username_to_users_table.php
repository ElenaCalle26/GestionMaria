<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Si la columna username existe pero está NULL en todos lados, limpiamos
        if (Schema::hasColumn('users', 'username')) {
            // Verificar si hay índice unique y borrarlo
            $indexes = DB::select("SHOW INDEX FROM users WHERE Column_name = 'username' AND Non_unique = 0");
            if (!empty($indexes)) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropUnique(['username']);
                });
            }
        } else {
            // Si no existe, crearla
            Schema::table('users', function (Blueprint $table) {
                $table->string('username')->nullable()->after('name');
            });
        }

        // Llenar usuarios existentes con un username único
        $users = DB::table('users')->get();
        foreach ($users as $user) {
            // Si el usuario ya tiene username, saltarlo
            if (!empty($user->username)) {
                continue;
            }

            $username = strtolower(str_replace(' ', '', $user->name));
            $counter = 1;
            $originalUsername = $username;
            
            while (DB::table('users')->where('username', $username)->where('id', '!=', $user->id)->exists()) {
                $username = $originalUsername . $counter;
                $counter++;
            }
            
            DB::table('users')->where('id', $user->id)->update(['username' => $username]);
        }

        // Agregar constraint unique si no existe
        Schema::table('users', function (Blueprint $table) {
            // Primero cambiar a NOT NULL
            DB::statement('ALTER TABLE users MODIFY username VARCHAR(255) NOT NULL');
            // Luego agregar unique
            DB::statement('ALTER TABLE users ADD UNIQUE KEY users_username_unique (username)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
};
