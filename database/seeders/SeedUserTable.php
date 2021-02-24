<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SeedUserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $max_users = 11;
        for ($i = 1; $i < $max_users; $i++) {
            DB::table('users')->insert([
                'name' => Str::ucfirst(Str::random(10)),
                'mem_id' => ($i % 2 === 1) ? 'CAC-' . (string)$i : '',
                'email' => 'foo' . (string)$i . '@gmail.com',
                'password' => Hash::make('foo' . (string)$i),
            ]);
        }

        DB::table('users')->insert([
            'name' => "Utsav Chatterjee",
            'mem_id' =>  'CAC-' . (string)$max_users,
            'email' => 'utsav' . (string)$max_users . '@gmail.com',
            'password' => Hash::make('foo' . (string)$max_users),
            'active' => 1,
            'verification_status' => 1,
            'club_role_id' => 1,
        ]);
    }
}
