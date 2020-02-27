<?php

use Illuminate\Database\Seeder;

class OutboundStudentChecklistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('outbound_students')->delete();

        $checklist = collect([
            'ขออนุมัติโครงการ',
            'ประกาศทุนการศึกษา',
            'ขออนุมัติเดินทาง',
            'หนังสือรับรองตนเอง',
            'หนังสือขออนุญาตผู้ปกครอง',
            'แบบตอบรับผู้ปกครอง',
            'เอกสารลาเรียน',
            'ประกันเดินทาง',
            'ตั๋วเครื่องบิน',
            'ที่พัก',
            'รายงานสรุปการเข้าร่วมกิจกรรมฯ'
        ]);

        $checklist->each(function ($name) {
            DB::table('outbound_student_checklists')->insert([
                'name' => $name,
            ]);
        });
    }
}
