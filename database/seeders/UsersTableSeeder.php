<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Raj Gorsia",
            'firstname' => "Raj",
            'lastname' => "Gorsia",
            'email' => "raj@phpology.co.uk",
            'role' => "admin",
            'status' => "1"
        ]);
    }
}
