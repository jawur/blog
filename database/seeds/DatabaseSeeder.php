<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AuthorsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        // don't need that one in here because TaggablesTableSeeder already creates an entry
        //$this->call(TagsTableSeeder::class);
        $this->call(TaggablesTableSeeder::class);
    }
}
