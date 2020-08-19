<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create(['name'=>'Mounir','surname'=> 'El imlahi','email'=>'mounir@factoriaf5.com','type'=>'Admin', 'gender'=>'Hombre', 'nationality'=> 'Morocco','password' => Hash::make('password')]);
        factory(User::class)->create(['name'=>'Umit','surname'=> 'Can Batur','email'=>'umit@factoriaf5.com','type'=>'Teacher', 'gender'=>'Hombre', 'nationality'=> 'Turkey','password' => Hash::make('password')]);
        factory(User::class)->create(['name'=>'Francisco','surname'=> 'Goncalves','email'=>'francisco@factoriaf5.com','type'=>'Student', 'gender'=>'Hombre', 'nationality'=> 'Portugal','password' => Hash::make('password')]);
        factory(User::class, 25)->create();
    }
}
