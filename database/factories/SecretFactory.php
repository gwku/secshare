<?php

namespace Database\Factories;

use App\Models\Secret;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class SecretFactory extends Factory
{
    protected $model = Secret::class;

    public function definition(): array
    {
        $rnd_max_views = $this->faker->numberBetween(1, 15);
        return [
            'content' => $this->faker->word(),
            'token' => Str::random(60) . '$' . Str::uuid(),
            'revoke_token' => password_hash(Str::random(15), PASSWORD_DEFAULT),
            'expires_at' => Carbon::now(),
            'views' => $this->faker->numberBetween(0, $rnd_max_views),
            'max_views' => $rnd_max_views,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
