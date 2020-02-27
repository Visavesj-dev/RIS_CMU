<?php

use Illuminate\Database\Seeder;

class MouTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('mou_types')->delete();

        $types = collect([
            'ทวิภาคี',
            'พหุภาคี'
        ]);

        $types->each(function ($name) {
            DB::table('mou_types')->insert([
                'name' => $name,
            ]);
        });
    }
}
