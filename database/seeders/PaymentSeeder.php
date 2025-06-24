<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = [
            [
                "name" => 'BCA',
                "number" => '1234567890'
            ],
            [
                "name" => 'Mandiri',
                "number" => '0987654321'
            ],
        ];

        foreach ($payments as $payment) {
            DB::table('payments')->insert($payment);
        }
    }
}
