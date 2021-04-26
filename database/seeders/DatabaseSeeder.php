<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::create(['name' => 'Admin', 'email' => 'teszt@teszt.com', 'password' => bcrypt('12345'), 'is_admin' => 1]);
    }
}
