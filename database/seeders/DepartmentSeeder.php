<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            ['department_name' => 'Corporate Services Group', 'department_abbreviation' => 'CSG'],
            ['department_name' => 'Distribution Utility Services', 'department_abbreviation' => 'DUS'],
            ['department_name' => 'Engineering Procurement Construction', 'department_abbreviation' => 'EPC'],
            ['department_name' => 'Finance', 'department_abbreviation' => 'FIN'],
            ['department_name' => 'Information Communication & Technology', 'department_abbreviation' => 'ICT'],
            ['department_name' => 'Legal', 'department_abbreviation' => 'LEG'],
            ['department_name' => 'Logistics', 'department_abbreviation' => 'LOG'],
            ['department_name' => 'MIESCOR Builders Inc.', 'department_abbreviation' => 'MBI'],
            ['department_name' => 'MIESCOR Logistic Inc.', 'department_abbreviation' => 'MLI'],
            ['department_name' => 'Bid and Proposal', 'department_abbreviation' => 'MP'],
            ['department_name' => 'Office of the President', 'department_abbreviation' => 'OP'],
            ['department_name' => 'Occupation Safety and Sustainability', 'department_abbreviation' => 'OSSM'],
            ['department_name' => 'Project Estimation and Execution', 'department_abbreviation' => 'PEE'],
            ['department_name' => 'Quality Assurance and Control', 'department_abbreviation' => 'QAC'],
            ['department_name' => 'Supply Chain Management', 'department_abbreviation' => 'SCM'],
            ['department_name' => 'Telecoms', 'department_abbreviation' => 'TEL'],
            ['department_name' => 'Trading', 'department_abbreviation' => 'TRD'],
            ['department_name' => 'Utility Attachment Management', 'department_abbreviation' => 'UAM'],
            ['department_name' => 'N/A', 'department_abbreviation' => 'NA'],
        ];

        DB::table('departments')->insert($departments);
    }
}
