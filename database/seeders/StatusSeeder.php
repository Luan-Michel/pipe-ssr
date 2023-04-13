<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $initialStatus = ['Completed', 'In Progress', 'Not Started'];
        foreach ($initialStatus as $status) {
            DB::table('status')->insert([
                'description' => $status,
            ]);
        }
    }
}
