<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $admin = new User();
        $admin->username = 'admin';
        $admin->fname = 'Eventmate';
        $admin->lname = 'Kweens';
        $admin->email = 'eventmate@gmail.com';
        $admin->password = Hash::make('admin2003'); // Hash the password
        $admin->is_admin = true;
        $admin->is_officer = false;
        $admin->org_code = 'default';

        $admin->created_at = now(); // Set the created_at timestamp
        $admin->updated_at = now(); // Set the updated_at timestamp
        $admin->save();
    }
}

