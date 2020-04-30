<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminExist = User::where('level', '=', User::LEVEL_ADMIN)->count();

        if($adminExist == 0){
            $admin = User::create([
                'email' => 'admin@test.it',
                'password' => \Illuminate\Support\Facades\Hash::make('admin'),
                'email_verified_at' => now(),
                'level' => User::LEVEL_ADMIN,
                'remember_token' => \Illuminate\Support\Str::random(10),
            ]);
        }

        factory(User::class, 10)->create();
    }
}
