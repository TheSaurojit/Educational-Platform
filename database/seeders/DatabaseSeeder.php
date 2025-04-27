<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => "admin" ,
            'email' => "admin@gmail.com",
            'password' => Hash::make('1234') ,
            'is_admin' => true 
        ]) ;

        User::create([
            'name' => "saurojit" ,
            'email' => "saurojitkarmakar947@gmail.com",
            'password' => Hash::make('123456') ,
            'email_verified_at' => now() 
        ]) ;

        User::create([
            'name' => "Abhraham lin" ,
            'email' => "karmakarsayan567@gmail.com",
            'password' => Hash::make('123456') ,
            'email_verified_at' => now() 
        ]) ;

        User::create([
            'name' => "John Doe" ,
            'email' => "user@gmail.com",
            'password' => Hash::make('123456') ,
            'email_verified_at' => now() 
        ]) ;
    }
}
