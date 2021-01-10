<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'path_to_logo' => "logo.png",
            'city' => $this->faker->city,
            'zip' => $this->faker->postcode,
            'street' => $this->faker->streetName,
            'housenumber' => $this->faker->buildingNumber,
        ];
    }
}
