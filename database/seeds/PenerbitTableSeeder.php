<?php

use Illuminate\Database\Seeder;

class PenerbitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            //1
            ['nama' => "Pustaka Asy-syafi'i", 'alamat' => '', 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //2
            ['nama' => 'Pustaka Al-Kautsar', 'alamat' => '', 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //3
            ['nama' => 'Qisthi Press', 'alamat' => '', 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //4
            ['nama' => 'Asma Nadia', 'alamat' => '', 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //5
            ['nama' => 'Elex Media Komputindo', 'alamat' => '', 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //6
            ['nama' => 'Khalifa', 'alamat' => '', 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //7
            ['nama' => 'Maghfirah Pustaka', 'alamat' => '', 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //8
            ['nama' => 'Pustaka Ibnu Katsir', 'alamat' => '', 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //9
            ['nama' => 'Al-Qowam', 'alamat' => '', 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //10
            ['nama' => 'Akbar Media', 'alamat' => '', 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //11
            ['nama' => 'Robbani Press', 'alamat' => '', 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //12
            ['nama' => 'Darul Falah', 'alamat' => '', 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //13
            ['nama' => 'Gema Insani', 'alamat' => '', 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //14
            ['nama' => 'Ummul Qura', 'alamat' => '', 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //15
            ['nama' => 'Griya Ilmu', 'alamat' => '', 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //16
            ['nama' => 'Gema Insani', 'alamat' => '', 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //17
            ['nama' => 'Cakrawala Publishing', 'alamat' => '', 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
        ];

        DB::table('penerbit')->insert($data);
    }
}
