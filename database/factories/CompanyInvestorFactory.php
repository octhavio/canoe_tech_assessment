<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Fund;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyInvestor>
 */
class CompanyInvestorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fund_id' => Fund::inRandomOrder()->select('id')->first()->id,
            'company_id' => Company::inRandomOrder()->select('id')->first()->id,
        ];
    }
}
