<?php

namespace Database\Seeders;

use App\Modules\Accounts\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'super_admin',
            'name' => 'super_admin',
            'email' => 'mail@aseven.co.id',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
    }
}
