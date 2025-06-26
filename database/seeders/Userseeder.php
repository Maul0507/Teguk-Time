<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder{
    public function run()
    {
        user::create([
            'name' => 'TegukTime',
            'email' => 'teguktime@admin.com',
            'password' => hash::make('12345678'),
            'role' => 'admin'
        ]);
    }
}