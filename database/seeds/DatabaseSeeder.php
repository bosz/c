<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(TagsSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PostsSeeder::class);
        $this->call(UserTable::class);

        Model::reguard();
    }
}
