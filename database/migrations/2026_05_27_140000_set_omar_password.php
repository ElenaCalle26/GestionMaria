<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Actualizar la contraseña de Omar Quintero a Omar411*
        DB::table('users')
            ->where('id', 5)
            ->update(['password' => Hash::make('Omar411*')]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No revertir contraseñas por seguridad
    }
};
