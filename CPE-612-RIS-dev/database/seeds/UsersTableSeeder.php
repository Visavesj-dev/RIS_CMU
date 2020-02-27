<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        
        $users = [
            ['email' => 'phrut.s@cmu.ac.th', 'is_admin' => true],
            ['email' => 'chaiy.rungsiyakull@cmu.ac.th', 'is_admin' => true],
            ['email' => 'kattima.p@cmu.ac.th', 'is_admin' => false],
            ['email' => 'chawasit_teng@cmu.ac.th', 'is_admin' => true],
            ['email' => 'kawewut_c@cmu.ac.th', 'is_admin' => true],
            ['email' => 'natchapon_petai@cmu.ac.th', 'is_admin' => false],
            ['email' => 'arinchai_nanjaruwong@cmu.ac.th', 'is_admin' => false],
            ['email' => 'pimukthee_jaikla@cmu.ac.th', 'is_admin' => false],
            ['email' => 'oraya_s@cmu.ac.th', 'is_admin' => false],
            ['email' => 'supitch_angchanpen@cmu.ac.th', 'is_admin' => false],
            ['email' => 'theerapat_s@cmu.ac.th', 'is_admin' => false],
            ['email' => 'nuttinee_d@cmu.ac.th', 'is_admin' => false],
            ['email' => 'kittitat_boonkarn@cmu.ac.th', 'is_admin' => false],
            ['email' => 'ngamsiri_b@cmu.ac.th', 'is_admin' => false],
            ['email' => 'uttakran_renuman@cmu.ac.th', 'is_admin' => false],
            ['email' => 'lalita_bandasak@cmu.ac.th', 'is_admin' => false],
            ['email' => 'natnicha_somsak@cmu.ac.th', 'is_admin' => false],
            ['email' => 'supitcha_sawasd@cmu.ac.th', 'is_admin' => false],
            ['email' => 'niramol_wat@cmu.ac.th', 'is_admin' => false],
            ['email' => 'narumon_setdusit@cmu.ac.th', 'is_admin' => false],
            ['email' => 'kornthip.c@cmu.ac.th', 'is_admin' => false],
            ['email' => 'nuttasri.senaluang@cmu.ac.th', 'is_admin' => false],
            ['email' => 'thatchayut_u@cmu.ac.th', 'is_admin' => false]
        ];
        
        DB::table('users')->insert($users);
    }
}
