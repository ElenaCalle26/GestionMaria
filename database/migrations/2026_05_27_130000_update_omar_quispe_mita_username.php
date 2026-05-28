<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Actualizar el username de Omar Quispe Mita a omarqm
        DB::table('users')
            ->where('name', 'Omar Quispe Mita')
            ->update(['username' => 'omarqm']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir a omarquispemita
        DB::table('users')
            ->where('name', 'Omar Quispe Mita')
            ->update(['username' => 'omarquispemita']);
    }
};
