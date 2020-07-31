<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url = 'https://api.exchangerate-api.com/v4/latest/USD';
        $json = file_get_contents($url);
        $currencies = json_decode($json);
        foreach ($currencies->rates as $key => $currency) {
            \App\Currency::create([
                    'name' => $key,
                    'enable' => 0
            ]);
        }
    }
}
