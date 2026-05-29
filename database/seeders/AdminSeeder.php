<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'admin1@gmail.com'],
            [
                'name' => 'Mohamed',
                'password' => '12345678',
                'role' => 'superadmin',
            ]
        );
    }
}
