<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class EditorUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'editor@gmail.com'],
            [
                'name' => 'Editor Pilrek',
                'role' => User::ROLE_EDITOR,
                'password' => 'password',
                'email_verified_at' => now(),
            ]
        );
    }
}
