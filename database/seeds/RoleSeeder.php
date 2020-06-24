<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void+
     */
    public function run()
    {
        
        DB::table('roles')->insert([
            'name' => 'admin',         
        ]);
        DB::table('roles')->insert([
            'name' => 'ressource humaine',         
        ]);
    /*   DB::table('roles')->insert([
            'name' => 'comptabilite',         
        ]);
        DB::table('roles')->insert([
            'name' => 'developpeur',         
        ]);*/
        
    }
}
