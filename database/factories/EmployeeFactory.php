<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
        protected $model = Employee::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phonenumber,
            'salary' => $this->faker->numberBetween(30000,50000),
            'department' => $this->faker->randomElement(array('Accounting','Marketing','sales','Quality'))

        ];
    }
}
