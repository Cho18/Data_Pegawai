<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'profile'   => 'profiles/profile.png',
            'name'      => $this->faker->name,
            'gender'    => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'address'   => $this->faker->address,
            'division'  => $this->faker->randomElement(['Marketing', 'HRD', 'Finance', 'Creative', 'Operasional', 'IT']),
            'level'     => $this->faker->randomElement(['Manager', 'Staff']),
            'position'  => $this->faker->jobTitle,
            'salary'    => $this->faker->numberBetween(1000000, 10000000),
            'hire_date' => $this->faker->date,
        ];
    }
}
