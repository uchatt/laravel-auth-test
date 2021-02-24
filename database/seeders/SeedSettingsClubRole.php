<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeedSettingsClubRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings_club_roles')->insert([
            ['name' => 'Administrator'],
            ['name' => 'Moderator'],
            ['name' => 'Regular']
        ]);
    }
}
