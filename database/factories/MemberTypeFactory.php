<?php

namespace Database\Factories;

use App\Models\MemberType;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberTypeFactory extends Factory
{
    protected $model = MemberType::class;

    public function definition()
    {
        return [
            'type' => null,
        ];
    }

    // A method to generate all enum values in the factory
    public function withEnumValues()
    {
        return collect(MemberType::getMemberTypes())->map(function ($enumValue) {
            return $this->state([
                'type' => $enumValue
            ]);
        });
    }
}
