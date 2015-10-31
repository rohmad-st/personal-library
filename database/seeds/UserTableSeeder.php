<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'       => 'Rohmat Sasmito',
                'email'      => 'rochmad.26@gmail.com',
                'password'   => Hash::make('secret'),
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'name'       => 'Rendy',
                'email'      => 'rendy@gamil.com',
                'password'   => Hash::make('secret'),
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'name'       => 'Edi Santoso',
                'email'      => 'cyberid41@gmail.com',
                'password'   => Hash::make('secret'),
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'name'       => 'Fahmi',
                'email'      => 'fahmi@gmail.com',
                'password'   => Hash::make('secret'),
                'created_at' => \Carbon\Carbon::now(),
            ],
        ];

        DB::table('users')->insert($data);
    }
}
