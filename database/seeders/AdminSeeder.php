<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::updateOrCreate(
            // Condition to check if the record exists
            ['email' => 'admin@gmail.com'],
            // Attributes to update or create
            [
                'name' => 'admin',
                'photo' => 'admin.jpg',
                'password' => 'asd', // Storing password as plain text (unsafe)
                'token' => '',
            ]
        );
    }
}
