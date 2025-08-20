<?php

namespace Database\Seeders;

use App\Models\BankAccount;
use App\Models\User;
use Illuminate\Database\Seeder;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get first few users
        $users = User::take(5)->get();

        if ($users->isEmpty()) {
            $this->command->warn('No users found. Please seed users first.');
            return;
        }

        $bankNames = [
            'Chase Bank',
            'Bank of America',
            'Wells Fargo',
            'Citibank',
            'PNC Bank',
            'US Bank',
            'TD Bank',
            'Capital One',
            'HSBC',
            'Deutsche Bank'
        ];

        $accountTypes = ['Checking', 'Savings'];
        $currencies = ['USD', 'EUR', 'GBP', 'CAD'];
        $statuses = ['active', 'inactive'];

        foreach ($users as $index => $user) {
            // Create 1-3 bank accounts per user
            $accountCount = rand(1, 3);
            
            for ($i = 0; $i < $accountCount; $i++) {
                $isFirst = $i === 0; // First account will be default
                
                BankAccount::create([
                    'user_id' => $user->id,
                    'bank_name' => $bankNames[array_rand($bankNames)],
                    'account_holder' => $user->name . ' ' . ($user->l_name ?? 'User'),
                    'account_number' => str_pad(rand(100000000, 999999999), 12, '0', STR_PAD_LEFT),
                    'routing_number' => str_pad(rand(100000000, 999999999), 9, '0', STR_PAD_LEFT),
                    'account_type' => $accountTypes[array_rand($accountTypes)],
                    'currency' => $currencies[array_rand($currencies)],
                    'bank_address' => fake()->address(),
                    'swift_code' => strtoupper(fake()->lexify('????') . fake()->numerify('##')),
                    'iban' => 'US' . fake()->numerify('##') . fake()->numerify('############'),
                    'is_default' => $isFirst, // First account is default
                    'status' => $isFirst ? 'active' : $statuses[array_rand($statuses)], // First account is always active
                ]);
            }
        }

        $this->command->info('Bank accounts seeded successfully!');
    }
}
