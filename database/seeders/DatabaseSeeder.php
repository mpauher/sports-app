<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Sport;
use \App\Models\Position;
use \App\Models\Team;
use \App\Models\Player;
use \App\Models\Trainer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
        ]);

        User::factory(10)->create();
        Sport::factory(10)->create();
        Position::factory(10)->create();
        Team::factory(10)->create();
        Player::factory(10)->create();
        Trainer::factory(10)->create();

        $users = User::all();

        foreach ($users as $user ){
            $user->assignRole('manager');
        }

        $user = User::all()->first();
        $user->assignRole('admin');
    }
}
