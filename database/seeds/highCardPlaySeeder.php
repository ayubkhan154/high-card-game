<?php

use Illuminate\Database\Seeder;

class highCardPlaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PlayerData::class, 40)->create();
    }
}
