<?php

use Illuminate\Database\Seeder;

class StudentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('student_types')->delete();

        $types = collect([
            'เรียน',
            'วิจัย',
            'แลกเปลีี่ยน',
            'กิจกรรม'
        ]);

        $types->each(function ($name) {
            DB::table('student_types')->insert([
                'name' => $name,
            ]);
        });
    }
}
