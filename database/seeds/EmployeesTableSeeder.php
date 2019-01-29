<?php
//Created for Part #1
use Illuminate\Database\Seeder;


use Faker\Factory as Faker;
use App\Employee;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();

        for($i = 0; $i < 5000; ++$i) 
	        {
	        	 $root = Employee::create([
		        	'full_name' => $faker->name, 
		        	'position' => $faker->jobTitle, 
		        	'start_date' => $faker->date, 
		        	'salary' => $faker->numberBetween(1000, 9999)
		        	]);

	        	 //Avoided recursive array generation for better performance

	        	 $categories = [
					  ['full_name' => $faker->name, 'position' => $faker->jobTitle, 'start_date' => $faker->date, 'salary' => $faker->numberBetween(1000, 9999)],
					  ['full_name' => $faker->name, 'position' => $faker->jobTitle, 'start_date' => $faker->date, 'salary' => $faker->numberBetween(1000, 9999)],
					  ['full_name' => $faker->name, 'position' => $faker->jobTitle, 'start_date' => $faker->date, 'salary' => $faker->numberBetween(1000, 9999), 'children' => [
					    ['full_name' => $faker->name, 'position' => $faker->jobTitle, 'start_date' => $faker->date, 'salary' => $faker->numberBetween(1000, 9999), 'children' => [
					      ['full_name' => $faker->name, 'position' => $faker->jobTitle, 'start_date' => $faker->date, 'salary' => $faker->numberBetween(1000, 9999)],
					      ['full_name' => $faker->name, 'position' => $faker->jobTitle, 'start_date' => $faker->date, 'salary' => $faker->numberBetween(1000, 9999), 'children' => [
						      ['full_name' => $faker->name, 'position' => $faker->jobTitle, 'start_date' => $faker->date, 'salary' => $faker->numberBetween(1000, 9999)],
						      ['full_name' => $faker->name, 'position' => $faker->jobTitle, 'start_date' => $faker->date, 'salary' => $faker->numberBetween(1000, 9999)]
						    ]]
					    ]],
					    ['full_name' => $faker->name, 'position' => $faker->jobTitle, 'start_date' => $faker->date, 'salary' => $faker->numberBetween(1000, 9999)],
					    ['full_name' => $faker->name, 'position' => $faker->jobTitle, 'start_date' => $faker->date, 'salary' => $faker->numberBetween(1000, 9999)]
					  ]],
					  ['full_name' => $faker->name, 'position' => $faker->jobTitle, 'start_date' => $faker->date, 'salary' => $faker->numberBetween(1000, 9999)]
					];

				$root->makeTree($categories);
	        }
    }
}
