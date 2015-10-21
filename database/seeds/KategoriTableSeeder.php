<?php

use Illuminate\Database\Seeder;

class KategoriTableSeeder extends Seeder
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
            ['nama' => 'Akhlak', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //2
            ['nama' => 'Akidah', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //3
            ['nama' => 'Al-Quran', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //4
            ['nama' => 'Alam Gaib', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //5
            ['nama' => 'Aqidah', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //6
            ['nama' => 'Bahasa Arab', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //7
            ['nama' => "Bid'ah", 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //8
            ['nama' => 'Biografi', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //9
            ['nama' => 'Buku Anak', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //10
            ['nama' => 'Buku Umum', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //11
            ['nama' => 'Cerpen', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //12
            ['nama' => 'Dakwah', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //13
            ['nama' => 'Doa', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //14
            ['nama' => 'Dunia Islam', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //15
            ['nama' => 'Ekonomi Islam', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //16
            ['nama' => 'Fatwa', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //17
            ['nama' => 'Fikih', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //18
            ['nama' => 'Hadist', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //19
            ['nama' => 'Haji dan Umrah', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //20
            ['nama' => 'Hari Akhir', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //21
            ['nama' => 'Ibadah', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //22
            ['nama' => 'Infaq dan Sedekah', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //23
            ['nama' => 'Islam', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //24
            ['nama' => 'Kamus', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //25
            ['nama' => 'Keluarga', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //26
            ['nama' => 'Kesehatan', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //27
            ['nama' => 'Khutbah', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //28
            ['nama' => 'Kisah Islami', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //29
            ['nama' => 'Kitab Klasik', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //30
            ['nama' => 'Lain-lain', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //31
            ['nama' => 'Manajemen Hati', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //32
            ['nama' => 'Manajemen Islam', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //33
            ['nama' => 'Masjid', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //34
            ['nama' => 'Motivasi', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //35
            ['nama' => 'Muhammad SAW', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //36
            ['nama' => 'Nabi dan Rasul', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //37
            ['nama' => 'Novel', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //38
            ['nama' => 'Pemikiran Islam', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //39
            ['nama' => 'Pendidikan Anak', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //40
            ['nama' => 'Penyucian Jiwa', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //41
            ['nama' => 'Psikologi Islam', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //42
            ['nama' => 'Puasa', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //43
            ['nama' => 'Referensi', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //44
            ['nama' => 'Sejarah', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //45
            ['nama' => 'Shalat', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //46
            ['nama' => 'Surga dan Neraka', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //47
            ['nama' => 'Tafsir', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //48
            ['nama' => 'Tasawuf', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //49
            ['nama' => 'Taubat', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //50
            ['nama' => 'Tauhid', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //51
            ['nama' => 'Thaharah', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //52
            ['nama' => 'Tokoh Islam', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //53
            ['nama' => 'Wanita', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
            //54
            ['nama' => 'Zakat', 'keterangan' => null, 'user_id' => 1, 'created_at' => \Carbon\Carbon::now()],
        ];
        DB::table('kategori')->insert($data);
    }
}
