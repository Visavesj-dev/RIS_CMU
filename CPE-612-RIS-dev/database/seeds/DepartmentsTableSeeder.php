<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('departments')->delete();

        $departments = collect([
            'CE',
            'CPE',
            'DS',
            'EE',
            'ENGR',
            'ENV',
            'IE',
            'ME',
            'MN'
        ]);

        $departments->each(function ($department) {
            DB::table('departments')->insert([
                'name' => $department,
                'primitive' => true,
            ]);
        });
    }
}
