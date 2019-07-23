<?php

use Illuminate\Database\Seeder;

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
        User::create([
        	'name' => 'Alain',
        	'email' => 'alainabreo@gmail.com',
        	'password' => bcrypt('123123')
        ]);

        User::create([
            'name' => 'Catalina',
            'email' => 'bayonacatalina@hotmail.com',
            'password' => bcrypt('123123')
        ]);

        User::create([
            'name' => 'Maria',
            'email' => 'mariaflorez@hotmail.com',
            'password' => bcrypt('123123')
        ]);

    }
}
