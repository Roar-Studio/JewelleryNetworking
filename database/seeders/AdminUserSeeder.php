<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@jewellerynetworking.com',
                'password' => 'J@prerna/#network24',
            ],
            [
                'name' => 'Vervali Tech1',
                'email' => 'vervali@jewellerynetworking.com',
                'password' => 'Vervali@123',
            ],
            [
                'name' => 'Support',
                'email' => 'support@jewellerynetworking.com',
                'password' => 'Vervali@123',
            ],
            [
                'name' => 'Bhamini',
                'email' => 'bhamini@jewellerynetworking.com',
                'password' => 'J@bhamini/#network24',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => Hash::make($user['password']),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }
    }
}
