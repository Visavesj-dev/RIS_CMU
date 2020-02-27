<?php

use Illuminate\Database\Seeder;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('programs')->delete();

        $programs = collect([
            'แลกเปลี่ยน',
            'หลักสูตร',
            'วิจัย',
            'ช่วยสอน',
            'ศึกษาระยะสั้น',
            'ทุน',
            'ฝึกอบรม',
            'ประชุม/สัมมนา',
            'แลกเปลี่ยนข้อมูล',
        ]);

        $programs->each(function ($program) {
            DB::table('programs')->insert([
                'name' => $program,
                'primitive' => true
            ]);
        });
    }
}
