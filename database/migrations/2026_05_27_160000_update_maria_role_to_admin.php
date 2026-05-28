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
        // Cambiar el rol de Maria Calle a admin
        DB::table('users')
            ->where('name', 'Maria Calle')
            ->update(['role' => 'admin']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir al rol anterior
        DB::table('users')
            ->where('name', 'Maria Calle')
            ->update(['role' => 'user']);
    }
};
