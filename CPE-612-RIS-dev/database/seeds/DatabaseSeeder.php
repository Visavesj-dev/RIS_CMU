<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
     $this->call(ProjectTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(MouTypesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(ProgramsTableSeeder::class);
        $this->call(InboundStudentChecklistsTableSeeder::class);
        $this->call(OutboundStudentChecklistsTableSeeder::class);
        $this->call(StudentTypesTableSeeder::class);
        $this->call(StudentFundTypesTableSeeder::class);
      
        $this->call(ActTableSeeder::class);
         $this->call(AuthorizeListTableSeeder::class);

         $this->call(ProjectStrategyTypeSeeder::class);
         $this->call(ProjectFundTypeSeeder::class);
    
        
    }
}
