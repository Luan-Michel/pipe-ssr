<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $initialRoles = ['Student', 'Teacher', 'Researcher', 'Other'];
        foreach ($initialRoles as $role) {
            DB::table('roles')->insert([
                'description' => $role,
            ]);
        }
    }
}
