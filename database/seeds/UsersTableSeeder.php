<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creations user test
        User::truncate();
        User::create([
            'identification_document' => '27381899',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'username' => 'admin',
            'name' => 'Administrator',
            'lastname' => ' Administrador',
            'role_id'=> 1
        ]);
        User::create([
            'identification_document' => '27381899',
            'email' => 'alberto@user.com',
            'password' => Hash::make('12345'),
            'username' => 'alberto',
            'name' => 'Alberto',
            'lastname' => 'Betancourt',
            'role_id'=> 2
        ]);

        User::create([
            'identification_document' => '27381899',
            'email' => 'prueba@user.com',
            'password' => Hash::make('12345'),
            'username' => 'prueba',
            'name' => 'Prueba',
            'lastname' => 'Test',
            'role_id'=> 2
        ]);

        User::create([
            'identification_document' => '273818993',
            'email' => 'prueba2@user.com',
            'password' => Hash::make('12345'),
            'username' => 'prueba2',
            'name' => 'Prueba2',
            'lastname' => 'Test2',
            'role_id'=> 2
        ]);
    }
}
