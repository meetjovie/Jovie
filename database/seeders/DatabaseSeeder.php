<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user = User::create([
            'first_name' => 'Aamish',
            'email' => 'aamishirfan2662@gmail.com',
            'is_admin' => 1,
            'password' => Hash::make('password'),
        ]);
        $teamModel = config('teamwork.team_model');

        $team = $teamModel::create([
            'name' => $user->first_name,
            'owner_id' => $user->id,
            'credits' => 10000000
        ]);
        $user->attachTeam($team);

        $this->call(TemplateSeeder::class);
    }
}
