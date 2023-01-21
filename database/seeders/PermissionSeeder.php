<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create permissions 

        //Sports
        Permission::create(['name' => 'list sports']);
        Permission::create(['name' => 'create sport']);
        Permission::create(['name' => 'update sport']);
        Permission::create(['name' => 'delete sport']);

        //Positions
        Permission::create(['name' => 'list positions']);
        Permission::create(['name' => 'create position']);
        Permission::create(['name' => 'update position']);
        Permission::create(['name' => 'delete position']);

        //Teams
        Permission::create(['name' => 'list teams']);
        Permission::create(['name' => 'create team']);
        Permission::create(['name' => 'update team']);
        Permission::create(['name' => 'delete team']);

        //Trainers
        Permission::create(['name' => 'list trainers']);
        Permission::create(['name' => 'create trainer']);
        Permission::create(['name' => 'update trainer']);
        Permission::create(['name' => 'delete trainer']);

        //Players
        Permission::create(['name' => 'list players']);
        Permission::create(['name' => 'create player']);
        Permission::create(['name' => 'update player']);
        Permission::create(['name' => 'delete player']);

        //Create Roles

        $admin = Role::create(['name' => 'admin']);
        $manager = Role::create(['name' => 'manager']);

        //Assign Permissions

        $admin->givePermissionTo(Permission::all());

        $manager->givePermissionTo('list teams');
        $manager->givePermissionTo('create team');
        $manager->givePermissionTo('update team'); 
        $manager->givePermissionTo('delete team'); 
        $manager->givePermissionTo('list players');
        $manager->givePermissionTo('create player');
        $manager->givePermissionTo('update player'); 
        $manager->givePermissionTo('delete player'); 


    }
}
