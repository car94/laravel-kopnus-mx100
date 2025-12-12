<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder {
    public function run() {
        User::create([
            'name' => 'Company One',
            'email' => 'employer@mx100.test',
            'password' => Hash::make('password'),
            'role' => 'employer'
        ]);

        for ($i=1;$i<=5;$i++) {
            User::create([
                'name' => "Freelancer {$i}",
                'email' => "freelancer{$i}@mx100.test",
                'password' => Hash::make('password'),
                'role' => 'freelancer'
            ]);
        }
    }
}
