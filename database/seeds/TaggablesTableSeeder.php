<?php

use Illuminate\Database\Seeder;

class TaggablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Taggable::class)->create();
    }
}
