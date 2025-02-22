<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $users = [
            [
               'name'=>'Admin User',
               'email'=>'admin@shaqshouse.co.ke',
               'location'=>'Chalbi Dondominiums, Nairobi',
               'image'=>'img.jpg',
               'mobile'=>'0712345678',
                'notes'=>'This is a note',
               'is_admin'=>1,
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'Manager User',
               'email'=>'manager@shaqshouse.co.ke',
               'location'=>'Chalbi Dondominiums, Nairobi',
               'image'=>'img.jpg',
               'mobile'=>'0712345678',
                'notes'=>'This is a note',
               'is_admin'=> 0,
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'User',
               'email'=>'user@shaqshouse.co.ke',
               'location'=>'Chalbi Dondominiums, Nairobi',
               'image'=>'img.jpg',
               'mobile'=>'0712345678',
               'notes'=>'This is a note',
               'is_admin'=>0,
               'password'=> bcrypt('123456'),
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
