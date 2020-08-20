<?php

use App\Justification;
use Illuminate\Database\Seeder;

class JustificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Justification::class, 10)->create();
    }
}
