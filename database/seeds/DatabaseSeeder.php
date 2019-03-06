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
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProfileTableSeeder::class);
        $this->call(DashboardTableSeeder::class);
        $this->call(EntidadsTableSeeder::class);
        $this->call(PoblacionsTableSeeder::class);
        $this->call(PaisTableSeeder::class);
        $this->call(DiscapacidadsTableSeeder::class);
    }
}
