<?php

use Illuminate\Database\Seeder;

class ProjectStrategyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('strategy_types')->delete();

        $name = collect([
            'EE - การจัดการขยะ',
            'EE - ระบบกายภาพและภูมิทัศน์',
            'EE - สิ่งแวดล้อม',
            'EE - พลังงาน',
            'EE - logistic',
            'FH - อาหาร, Food Safety',
            'FH - สุขภาพ, Health Hub',
            'FH - ผู้สูงอายุ',
            'FH - การท่องเที่ยวเชิงสุขภาพ / สปา',
            'LN - ล้านนา',
            'LN - นวัตกรรมล้านนา',
            'Other - ทุนวิจัย',
            'Other - แลกเปลี่ยน นักวิจัย เสนอผลงานวิชาการ',
            'Other - Center of Excellence',
            'Other - ศูนย์เครื่องมือ',
            'Other - เมืองวิจัยและนวัตกรรม',
            'Other - Robotics',
            'Other - Automotive, Smart Electronics'
            
        ]);

        $name->each(function ($name) {
            DB::table('strategy_types')->insert([
                'name' => $name
            ]);
        });
    }
}
