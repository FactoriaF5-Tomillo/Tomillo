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
        factory(User::class)->create([
            'name'=>'Mounir',
            'surname'=> 'El imlahi',
            'email'=>'admin@tomillo.com',
            'type'=>'Admin', 'gender'=>'Hombre', 
            'nationality'=> 'Morocco',
            'password' => Hash::make('password')
        ]);
        factory(User::class)->create([
            'name'=>'Umit',
            'surname'=> 'Can Batur',
            'email'=>'teacher@tomillo.com',
            'type'=>'Teacher', 'gender'=>'Hombre',
            'nationality'=> 'Turkey',
            'password' => Hash::make('password')
        ]);
        factory(User::class)->create([
            'name'=>'Francisco'
            ,'surname'=> 'Goncalves'
            ,'email'=>'student@tomillo.com'
            ,'type'=>'Student'
            , 'gender'=>'Hombre'
            ,'nationality'=> 'Portugal'
            ,'password' => Hash::make('password')
        ]);
        factory(User::class, 25)->create();
    }
}
