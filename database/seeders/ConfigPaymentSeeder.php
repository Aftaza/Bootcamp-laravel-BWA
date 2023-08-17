<?php

namespace Database\Seeders;

use App\Models\MasterData\ConfigPayment;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Memasukkan data statis yang akan disiapkan
        $config_payment = [
            [
                'fee' => '150000',
                'vat' => '20', // is persen
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        // Melakukan insert data pada array ke tabel
        ConfigPayment::insert($config_payment);
    }
}
