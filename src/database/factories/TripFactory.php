<?php

namespace Database\Factories;

use App\Helpers\TripStatus;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => null,
        ];
    }

    /**
     * @return TripFactory
     */
    public function at_vendor(): TripFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => TripStatus::AT_VENDOR,
            ];
        });
    }

    /**
     * @return TripFactory
     */
    public function assigned(): TripFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => TripStatus::ASSIGNED,
            ];
        });
    }

    /**
     * @return TripFactory
     */
    public function picked(): TripFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => TripStatus::PICKED,
            ];
        });
    }

    /**
     * @return TripFactory
     */
    public function delivered(): TripFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => TripStatus::DELIVERED,
            ];
        });
    }


}
