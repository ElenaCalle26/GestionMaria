<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Solo crear si no existen
        if (User::count() === 0) {
            User::create([
                'name' => 'Maria Calle',
                'email' => 'maria@example.com',
                'password' => Hash::make('Maria123'),
                'role' => 'admin',
            ]);

            User::create([
                'name' => 'Carlos López',
                'email' => 'carlos@example.com',
                'password' => Hash::make('Carlos123'),
                'role' => 'user',
            ]);

            User::create([
                'name' => 'Ana Rodríguez',
                'email' => 'ana@example.com',
                'password' => Hash::make('Ana123'),
                'role' => 'user',
            ]);

            User::create([
                'name' => 'Juan Pérez',
                'email' => 'juan@example.com',
                'password' => Hash::make('Juan123'),
                'role' => 'user',
            ]);

            User::create([
                'name' => 'Omar Quispe Mita',
                'email' => 'omarqm@example.com',
                'password' => Hash::make('Omar411'),
                'role' => 'user',
            ]);
        }
    }
}
