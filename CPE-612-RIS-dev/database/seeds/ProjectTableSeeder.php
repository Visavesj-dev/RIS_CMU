<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('project_types')->delete();

        $name = collect([
            'วิจัยและพัฒนา',
            'บริการวิชาการ',
            'ประชุมสัมนา',
            'วิจัยสถาบัน',
            'วิจัยการเรียนการสอน',
            'ทุนบัณฑิต',
        ]);

        $name->each(function ($name) {
            DB::table('project_types')->insert([
                'name' => $name
            ]);
        });
    }
}
