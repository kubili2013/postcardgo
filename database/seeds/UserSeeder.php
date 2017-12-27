<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Li Hongbin',
            'email' => 'kubili2013@gmail.com',
            'username' => 'lihongbin',
            'password' => bcrypt('smsm5845271314'),
            'type'=>3,
            'avatar'=>'https://avatars0.githubusercontent.com/u/9464056',
        ]);
    }
}
