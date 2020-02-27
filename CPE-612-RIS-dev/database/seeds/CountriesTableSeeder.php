<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('countries')->delete();

        $countries = collect([
            'ญี่ปุ่น',
            'ฝรั่งเศส',
            'เยอรมนี',
            'เกาหลีใต้',
            'จีน',
            'อินโดนีเซีย',
            'ไต้หวัน'
        ]);

        $countries->each(function ($country) {
            DB::table('countries')->insert([
                'name' => $country,
            ]);
        });
    }
}
