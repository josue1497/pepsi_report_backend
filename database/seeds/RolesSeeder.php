<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Administrador',
            'value' => ' AD'
        ]);
        Role::create([
            'name' => 'Operador',
            'value' => ' OP'
        ]);
    }
}
