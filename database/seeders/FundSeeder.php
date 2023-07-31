<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyInvestor;
use App\Models\Fund;
use App\Models\FundAlias;
use App\Models\FundManager;
use Illuminate\Database\Seeder;

class FundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        FundManager::factory()->count(3)->create();
        Fund::factory()->count(5)->create();
        FundAlias::factory()->count(15)->create();
        Company::factory()->count(7)->create();
        CompanyInvestor::factory()->count(10)->create();

    }
}
