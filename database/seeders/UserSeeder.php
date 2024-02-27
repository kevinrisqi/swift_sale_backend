<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create(
            [
                'name' => 'Kevin Risqi',
                'email' => 'kevinrisqi@gmail.com',
                'phone' => '081234567890',
                'roles' => 'ADMIN',
                'password' => bcrypt('kevinrisqi')
            ]
        );

        User::factory(12)->create();
    }
}
