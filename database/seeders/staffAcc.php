<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\models\User;
class staffAcc extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::create([
            'name' => 'staff',
            'username' => 'staff',
            'email' => 'staff@gmail.com',
            'password' => bcrypt('staff'),
            'role' => 'staff',
            'address' => 'staffs house'       
        ]);
    }
}
