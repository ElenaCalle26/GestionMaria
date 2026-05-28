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
        // Cambiar el nombre de Omar Quintero a Omar Quispe Mita
        DB::table('users')
            ->where('id', 5)
            ->update(['name' => 'Omar Quispe Mita']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir al nombre anterior
        DB::table('users')
            ->where('id', 5)
            ->update(['name' => 'Omar Quintero']);
    }
};
