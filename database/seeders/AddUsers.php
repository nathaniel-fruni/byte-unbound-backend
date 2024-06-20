<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AddUsers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'Nathaniel',
                'last_name' => 'Fruni',
                'email' => 'nathaniel.fruni@student.ukf.sk',
                'password' => bcrypt('secret'),
                'role' => 'admin',
                'verification_code' => null,
            ],
            [
                'first_name' => 'Samuel',
                'last_name' => 'Kačšák',
                'email' => 'samuel.kascak@student.ukf.sk',
                'password' => bcrypt('secret'),
                'role' => 'admin',
                'verification_code' => null,
            ],
            [
                'first_name' => 'Lukáš',
                'last_name' => 'Sýkora',
                'email' => 'sykora@ukf.sk',
                'password' => null,
                'role' => 'attendee',
                'verification_code' => bcrypt(Str::random(6)),
            ],
            [
                'first_name' => 'Katarína',
                'last_name' => 'Vargová',
                'email' => 'vargova@ukf.sk',
                'password' => null,
                'role' => 'attendee',
                'verification_code' => bcrypt(Str::random(6)),
            ],
            [
                'first_name' => 'Peter',
                'last_name' => 'Horváth',
                'email' => 'horvath@ukf.sk',
                'password' => null,
                'role' => 'attendee',
                'verification_code' => bcrypt(Str::random(6)),
            ],
            [
                'first_name' => 'Jana',
                'last_name' => 'Kováčová',
                'email' => 'kovacova@ukf.sk',
                'password' => null,
                'role' => 'attendee',
                'verification_code' => bcrypt(Str::random(6)),
            ],
            [
                'first_name' => 'Martin',
                'last_name' => 'Novák',
                'email' => 'novak@ukf.sk',
                'password' => null,
                'role' => 'attendee',
                'verification_code' => bcrypt(Str::random(6)),
            ]
        ];

        foreach ($users as $userData) {
            $user = new User();
            $user->first_name = $userData['first_name'];
            $user->last_name = $userData['last_name'];
            $user->email = $userData['email'];
            $user->password = $userData['password'];
            $user->role = $userData['role'];
            $user->verification_code =$userData['verification_code'];
            $user->save();
        }
    }
}
