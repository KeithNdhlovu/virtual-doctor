<?php

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
        // Roles
        $adminRole = User::USER_TYPE_ADMIN;

        // Seed test Admin
        $email = 'admin@virtualdoctor.com';
        $user = User::where('email', '=', $email)->first();
        
        if ($user === null) {
            $user = User::create([
                'first_name'                     => 'Admin',
                'last_name'                      => 'Admin',
                'email'                          => $email,
                'password'                       => Hash::make('password'),
                'user_type'                      => $adminRole
            ]);
        }

        $doctorRole = User::USER_TYPE_DOCTOR;

        $email = 'doctor-1@virtualdoctor.com';
        $user = User::where('email', '=', $email)->first();
        
        if ($user === null) {
            $user = User::create([
                'first_name'                     => 'Kevin',
                'last_name'                      => 'Blaszczykowski',
                'email'                          => $email,
                'password'                       => Hash::make('password'),
                'user_type'                      => $doctorRole
            ]);
        }

    }
}
