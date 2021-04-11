<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(1)
            ->create([
                'email' => 'bjadmund@mail.ru'
            ]);
            
        User::factory()
            ->count(10)
            ->create();
    }
}
