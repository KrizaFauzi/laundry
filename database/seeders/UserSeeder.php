<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inputan['name'] = "Kriza";
        $inputan["email"] = "kriz4nafis@gmail.com";
        $inputan['password'] =  Hash::make('12345678');
        $inputan['role'] = 'admin';
        User::create($inputan);
    }
}
