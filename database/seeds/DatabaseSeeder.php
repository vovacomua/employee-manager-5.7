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
        //Created for Part #1
         $this->call([
	        EmployeesTableSeeder::class,
    	]);
    }
}
