<?php

namespace Database\Factories;

use App\Models\MemberType;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberTypeFactory extends Factory
{
    protected $model = MemberType::class;

    protected static $enumValues = ['youth', 'aspirant', 'junior', 'senior', 'elder'];

    public function definition()
    {
        return [
            'type' => null,  // The status will be set outside the definition
        ];
    }

    // A method to generate all enum values in the factory
    public function withEnumValues()
    {
        return collect(self::$enumValues)->map(function ($enumValue) {
            return $this->state([
                'type' => $enumValue
            ]);
        });
    }
}
