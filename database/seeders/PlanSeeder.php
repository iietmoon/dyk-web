<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Monthly',
                'slug' => 'monthly',
                'provider' => 'paddle',
                'provider_product_id' => 'pri_01kh4wse1aytg2pet8wax1gnq9',
                'description' => 'Billed every month. Cancel anytime.',
                'price' => 2.99,
                'currency' => 'USD',
                'billing_cycle' => 'monthly',
                'capabilities' => null,
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 1,
                'has_trial' => false,
                'trial_days' => null,
            ],
            [
                'name' => 'Yearly',
                'slug' => 'yearly',
                'provider' => 'paddle',
                'provider_product_id' => 'pri_01kh4wtxrvcm3d90jn33qhbzqb',
                'description' => 'Billed once per year. Save compared to monthly.',
                'price' => 29.99,
                'currency' => 'USD',
                'billing_cycle' => 'annual',
                'capabilities' => null,
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 2,
                'has_trial' => false,
                'trial_days' => null,
            ],
        ];

        foreach ($plans as $plan) {
            Plan::updateOrCreate(
                ['slug' => $plan['slug']],
                $plan
            );
        }
    }
}
