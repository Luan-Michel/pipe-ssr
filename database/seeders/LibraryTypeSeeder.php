<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class LibraryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $initialTypes = ['Type One', 'Type Two', 'Type Three'];
        foreach ($initialTypes as $type) {
            DB::table('library_types')->insert([
                'description' => $type,
            ]);
        }
    }
}
