<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Educ\Models\User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@user.com',
            'enrolment' => 1000001,
        ]);
    }
}
