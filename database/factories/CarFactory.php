<?php

namespace Database\Factories;

use App\Models\Car;
use Faker\Provider\FakeCar;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    protected $model = Car::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new FakeCar($this->faker));
        $vehicle = $this->faker->vehicleArray();

        return [
            'reg_number' => $this->faker->vehicleRegistration('[A-Z]{3}-[0-9]{3}'),
            'brand'           => $vehicle['brand'],
            'model'           => $vehicle['model'],
        ];
    }
}
