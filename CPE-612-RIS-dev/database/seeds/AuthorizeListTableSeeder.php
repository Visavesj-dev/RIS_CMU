<?php

use Illuminate\Database\Seeder;

class AuthorizeListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('authorize_lists')->delete();

        $authorizes = collect([
            'ยื่นและต่อรองข้อเสนอโครงการ',
            'เจ้าหน้าที่การเงินและการออกใบเสร็จ',
            'ตกลงราคา',
            'บริหารจัดการโครงการ',
            'ลงนามสัญญา'
        ]);

        $authorizes->each(function ($authorize) {
            DB::table('authorize_lists')->insert([
                'name' => $authorize,
                'primitive' => true,
            ]);
        });
    }
}
