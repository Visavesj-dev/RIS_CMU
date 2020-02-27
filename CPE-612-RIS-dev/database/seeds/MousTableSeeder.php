<?php

use Illuminate\Database\Seeder;

class MousTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('mous')->delete();

        factory(App\Mou::class, 30)->states('expired')->create();
        factory(App\Mou::class, 30)->states('active')->create();
        factory(App\Mou::class, 30)->states('new')->create();
    }
}
