<?php

use Educ\Models\User;
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
        factory(User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@user.com',
            'enrolment' => User::assignEnrolment(new User(), User::ROLE_ADMIN)
        ])->each(function (User $user){
            User::assingRole($user, User::ROLE_ADMIN);
            $user->save();
        });

        factory(User::class)->create([
            'name' => 'Teaher',
            'email' => 'teaher@user.com',
            'enrolment' => User::assignEnrolment(new User(), User::ROLE_TEACHER)
        ])->each(function (User $user){
            if(!$user->userable) {
                User::assingRole($user, User::ROLE_TEACHER);
                $user->save();
            }
        });
        factory(User::class)->create([
            'name' => 'Studant',
            'email' => 'studant@user.com',
            'enrolment' => User::assignEnrolment(new User(), User::ROLE_STUDANT)
        ])->each(function (User $user){
            if(!$user->userable) {
                User::assingRole($user, User::ROLE_STUDANT);
                $user->save();
            }
        });
    }
}
