<?php

use Illuminate\Database\Seeder;

class StudentFundTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('student_fund_types')->delete();

        $types = collect([
            'ภายใน',
            'ภายนอก'
        ]);

        $types->each(function ($name) {
            DB::table('student_fund_types')->insert([
                'name' => $name,
            ]);
        });
    }
}
