<?php

use Illuminate\Database\Seeder;

class ProjectFundTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fund_types')->delete();

        $name = collect([
            'ภายใน (เงินแผ่นดิน)',
            'ภายใน (รายได้ มช.)',
            'ภายใน (ส่วนงานใน มช.)',
            'ภายใน (รายได้ คณะ)',
            'ภายใน (รายได้ ภาควิชา)',
            'ภายนอก (ในประเทศ)',
            'ภายนอก (ต่างประเทศ)',
            'OHC'
            
        ]);

        $name->each(function ($name) {
            DB::table('fund_types')->insert([
                'name' => $name
            ]);
        });
    }
}
