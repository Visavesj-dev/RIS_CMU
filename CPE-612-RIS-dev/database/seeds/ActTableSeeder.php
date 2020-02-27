<?php

use Illuminate\Database\Seeder;

class ActTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('acts')->delete();

        $types = collect([
            'ไม่ระบุ',
            'รูปแบบ 1 หัวหน้าโครงการ เจ้าหน้าพัสดุ',
            'รูปแบบ 2.1 หัวหน้าโครงการ',
            'รูปแบบ 2.2 หัวหน้าภาค',
            'รูปแบบ 3 รองวิจัย'
        ]);

        $types->each(function ($name) {
            DB::table('acts')->insert([
                'name' => $name,
            ]);
        });
    }
}
