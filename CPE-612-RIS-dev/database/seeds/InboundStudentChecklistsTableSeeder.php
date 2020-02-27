<?php

use Illuminate\Database\Seeder;

class InboundStudentChecklistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('inbound_students')->delete();

        $checklist = collect([
            'จัดทำหนังสือเชิญและหนังสืออำนวยความสะดวกในการตรวจตรา',
            'รายงานตัวแจ้งที่พักระบบ ตม. ภายในเวลา 24 ชั่วโมง กรณีพัก Engineer house',
            'การขึ้นทะเบียนเป็นนักศึกษา + CMU accout',
            'การขอบัตรนักศึกษาจากกองวิเทศสัมพันธ์ (150 บาท)',
            'การขอทำบัตรห้องสมุด (ค่าบัตร 200 บาท ค่าประกัน 1,000 บาท)',
            'การขอ CMU accout ( ระยะสั้น ไม่มีรหัสนักศึกษา )',
            'การขอเปิดบัญชีธนาคาร',
            'การขอ Transcript',
            'จัดทำหนังสือตีพ้นก่อนเดินทางกลับ (แจ้ง ตม.)'
        ]);

        $checklist->each(function ($name) {
            DB::table('inbound_student_checklists')->insert([
                'name' => $name,
            ]);
        });
    }
}
