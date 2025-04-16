<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = [
            'email' => 'mohammadtajutzamzami07@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'name' => 'Mohammad Tajut Zam Zami E41212335',
            'email_verified_at' => Carbon::now(),
        ];

        User::create($user);
    }
}
