<?php

use Illuminate\Database\Seeder;

class BukuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            // 1. Ibnu Qayyim Al-Jauziyah
            [
                'judul'        => "Ad-Daa' Wa Ad-Dawaa'",
                'uraian'       => '',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 104000,
                'gambar'       => 'https://lh6.googleusercontent.com/ud0Of0Qmn9_XDrOWUqnswYmM1IL4cUlR3RXYFVxtcyE=w144-h207-p-no',
                'penulis_id'   => 1,
                'penerbit_id'  => 1,
                'kategori_id'  => 31,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            [
                'judul'        => "Al-Jawabul Kafi: Solusi Qur'ani Dalam Mengatasi Masalah Hati",
                'uraian'       => '',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 88000,
                'gambar'       => 'https://lh6.googleusercontent.com/wwCL2puLR907eN2m2WOYGsi-TBnAzEHZ-TLUXN1tKkk=w130-h207-p-no',
                'penulis_id'   => 1,
                'penerbit_id'  => 9,
                'kategori_id'  => 31,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            [
                'judul'        => "Bekal Hidup Muslim",
                'uraian'       => '',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 52400,
                'gambar'       => 'https://lh6.googleusercontent.com/h225CPzXLkdnIZRYfl3y-S-GQB9-3djyq5pnINcFVLY=w139-h207-p-no',
                'penulis_id'   => 1,
                'penerbit_id'  => 10,
                'kategori_id'  => 17,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            [
                'judul'        => "Bercinta dengan Allah",
                'uraian'       => '',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 63750,
                'gambar'       => 'https://lh3.googleusercontent.com/-b7JGR-0aPCo/Uvbwx1Vp84I/AAAAAAAABxk/gOj0TE2QEuw/s128/bercinta.jpg',
                'penulis_id'   => 1,
                'penerbit_id'  => 7,
                'kategori_id'  => 31,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            [
                'judul'        => "Buku Pintar Memutuskan Perkara",
                'uraian'       => '',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 85600,
                'gambar'       => 'http://www.kautsar.co.id/public/media/images/thumb/2014/06/30/2014-06-30-11-30-29_memutuskan_perkara_thumb_150_.jpg',
                'penulis_id'   => 1,
                'penerbit_id'  => 2,
                'kategori_id'  => 31,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            [
                'judul'        => "Fawaidul Fawaid",
                'uraian'       => '',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 102000,
                'gambar'       => 'https://lh6.googleusercontent.com/-BGhQHDpUc_M/UZYY3QHSxdI/AAAAAAAAAuk/Jfp62VZKg5s/s128/Fawaid.jpg',
                'penulis_id'   => 1,
                'penerbit_id'  => 1,
                'kategori_id'  => 31,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            [
                'judul'        => "Fiqih Bayi",
                'uraian'       => '',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 104000,
                'gambar'       => 'https://lh4.googleusercontent.com/QwlGy_Kk8rm8pNvU0oZAieBhA6RCp3atMyjo0Htbcbk=w144-h204-p-no',
                'penulis_id'   => 1,
                'penerbit_id'  => 11,
                'kategori_id'  => 17,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            [
                'judul'        => "Hikmah dan Rahasia Shalat",
                'uraian'       => '',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 28000,
                'gambar'       => 'https://lh6.googleusercontent.com/qps7IBdiOdtH3UrD1N7wDEgVP7ZNR1D4IFYOcopouRg=w144-h209-p-no',
                'penulis_id'   => 1,
                'penerbit_id'  => 3,
                'kategori_id'  => 21,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            [
                'judul'        => "Ighatsatul Lahfan: Menyelamatkan Hati dari Tipu Daya Setan",
                'uraian'       => '',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 128000,
                'gambar'       => 'https://lh6.googleusercontent.com/R2pofMZUS5c0nk0lfTicIkYXVExCK_C-om2_NrCAQWw=w153-h208-p-no',
                'penulis_id'   => 1,
                'penerbit_id'  => 9,
                'kategori_id'  => 31,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            [
                'judul'        => "Jala’ul Afham: Keutamaan Shalawat Nabi Saw",
                'uraian'       => '',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 115600,
                'gambar'       => 'https://lh6.googleusercontent.com/lqiHMI3Hqkf0bA0eAuHl24rDq0LlOIZByL2bE23y8OQ=w135-h207-p-no',
                'penulis_id'   => 1,
                'penerbit_id'  => 9,
                'kategori_id'  => 35,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            [
                'judul'        => "Kelengkapan Tarikh Rasulullah",
                'uraian'       => 'Imam Ibnu Qayyim Al-Jauziyah benar-benar berhasil menghidangkan sejarah Rasulullah yang membuat siapa saja betah berlama-lama membacanya. Bahasa buku ini mudah dimengerti, bahasan setiap tema tidak bertele-tele atau membosankan. Buku ini tidak sekedar berbicara tentang alur kehidupan sejarah Rasulullah dari A sampai Z. Tapi, juga memuat analisa-analisa menarik dan mendalam yang menjadi ciri khas Ibnul Qayyim Al-Jauziyah. Kitab "Jami as-Sirah" ini menjadi pelengkap kitab-kitab sejarah Rasulullah yang sudah Anda miliki. Membaca sejarah Rasulullah adalah awal langkah bagi kita untuk makin mencintai beliau. Sebab, dengan begitu kita akan memahami berbagai keteladanan dan kemuliaan beliau.',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 104000,
                'gambar'       => 'http://www.kautsar.co.id/public/media/images/thumb/2012/10/12/2012-10-12-14-20-25_Kelengkapan%20Tarikh%20Rasulullah_thumb_150_.jpg',
                'penulis_id'   => 1,
                'penerbit_id'  => 2,
                'kategori_id'  => 35,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            [
                'judul'        => "Madarijus Salikin",
                'uraian'       => '',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 78400,
                'gambar'       => 'https://lh6.googleusercontent.com/-GXG6EnLK_b2uatooKDNcRk0Ji8XuLDO5d3jARN208Q=w134-h207-p-no',
                'penulis_id'   => 1,
                'penerbit_id'  => 2,
                'kategori_id'  => 31,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            [
                'judul'        => "Manajemen Qalbu",
                'uraian'       => '',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 60000,
                'gambar'       => 'https://lh5.googleusercontent.com/0cN9GqT0uxZ8A-tB5v1gW0KCibUEXlNM9p86qB2XycY=w132-h207-p-no',
                'penulis_id'   => 1,
                'penerbit_id'  => 12,
                'kategori_id'  => 31,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            [
                'judul'        => "Membersihkan Hati dari Gangguan Setan",
                'uraian'       => '',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 18275,
                'gambar'       => 'https://lh3.googleusercontent.com/-PVSW0aWKAN8/Uwp9tz_FBdI/AAAAAAAAB6A/Qlh0T_oh8Ik/s128/membersihkan%20hati.jpg',
                'penulis_id'   => 1,
                'penerbit_id'  => 13,
                'kategori_id'  => 31,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            [
                'judul'        => "Menyambut Buah Hati: Bekal Menyiapkan anak Saleh pada Masa Golden Ages",
                'uraian'       => '',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 70400,
                'gambar'       => 'https://lh5.googleusercontent.com/aut8uV76HV9Tq9L6Z_CgSaAfpOr_upZS1qyba750XPU=w142-h209-p-no',
                'penulis_id'   => 1,
                'penerbit_id'  => 14,
                'kategori_id'  => 25,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            [
                'judul'        => "Metode Pengobatan Nabi Saw (Edisi Lengkap)",
                'uraian'       => '',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 64000,
                'gambar'       => 'https://lh6.googleusercontent.com/BxHekzJ7jPE-A2HchesgxY8b08DQssj7xVf8ABbtvnE=w131-h207-p-no',
                'penulis_id'   => 1,
                'penerbit_id'  => 15,
                'kategori_id'  => 26,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            [
                'judul'        => "ROH",
                'uraian'       => '',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 52800,
                'gambar'       => 'https://lh3.googleusercontent.com/-FwemakL_FHs/T5vASR0SBsI/AAAAAAAAAEo/TzknChjN3ow/s237/ROH.jpg',
                'penulis_id'   => 1,
                'penerbit_id'  => 16,
                'kategori_id'  => 4,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            // 2. DR. Aidh ibn Abdullah al-Qarni
            [
                'judul'        => "La Tahzan Jangan Bersedih",
                'uraian'       => 'Sebagai salah satu buku kategori pencerahan hati (an-nafsu al-muthma`innah), La Tahzan menawarkan terapi yang lebih dekat dengan al-Qur`an dan Sunah, ketimbang renungan-renungan reflektif semata. Lâ Tahzan menjadi buku terlaris di Timur Tengah karena sejak Cetakan pertamanya (th 2001), buku ini telah terjual lebih dari 1 juta eksemplar. Buku ini telah melambungkan nama penulisnya, DR. ‘Aidh al-Qarni, seorang doktor dalam bidang hadis yang hafiz Qur`an, ribuan hadis, dan juga ribuan bait syair Arab kuno hingga modern. Dalam usianya yang masih sangat muda, ia telah menjadi penulis paling produktif di Saudi Arabia saat ini. Di Indonesia, buku yang Anda pegang ini mendapat sambutan luar biasa dan telah terjual puluhan ribu eksemplar.',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 104000,
                'gambar'       => 'https://lh4.googleusercontent.com/HWlNcmRDI_UPLi81OxETUi7-Cdf_ixj2_F4nGCGz3Dk=w137-h207-p-no',
                'penulis_id'   => 2,
                'penerbit_id'  => 2,
                'kategori_id'  => 31,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            [
                'judul'        => "30 Tanda-Tanda Orang Munafiq",
                'uraian'       => '',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 9775,
                'gambar'       => 'https://lh6.googleusercontent.com/-ABWkv0MF9VA/UvbUnVhWqeI/AAAAAAAABwg/60nswtALX64/s128/30%20tanda.jpg',
                'penulis_id'   => 2,
                'penerbit_id'  => 13,
                'kategori_id'  => 32,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            [
                'judul'        => "Bertaubatlah Agar Menang Dunia Akhirat",
                'uraian'       => '',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 38250,
                'gambar'       => 'https://lh4.googleusercontent.com/-ukSRvXw2etg/Uv7ICQ3Md1I/AAAAAAAAB38/s4t8LDAuuWw/s128/bertaubatlah.jpg',
                'penulis_id'   => 2,
                'penerbit_id'  => 7,
                'kategori_id'  => 32,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            [
                'judul'        => "Cahaya Pencerahan, Petunjuk Al-Qur'an dan Hadist untuk Meraih Kesuksesan Dunia dan Akhirat",
                'uraian'       => '',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 56000,
                'gambar'       => 'https://lh4.googleusercontent.com/-NPkZDQ7sF78/UvLF9-I2BAI/AAAAAAAABs4/Pz0k2nTHK8s/s128/cahayapencerahan.png',
                'penulis_id'   => 2,
                'penerbit_id'  => 3,
                'kategori_id'  => 31,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            [
                'judul'        => "Cahaya Zaman",
                'uraian'       => '',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 79200,
                'gambar'       => 'https://lh4.googleusercontent.com/-BW4Jf5GOJXo/Uu7v0ynOfbI/AAAAAAAABr4/-ZcqEFuJuDI/s128/cahaya%20zaman.jpg',
                'penulis_id'   => 2,
                'penerbit_id'  => 13,
                'kategori_id'  => 32,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            [
                'judul'        => "Demi Masa, Beginilah Waktu Mengajari Kita",
                'uraian'       => '',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 58500,
                'gambar'       => 'https://lh6.googleusercontent.com/mqkFcbbMrIWwTXWRv9ZPyrArjYVUr07My1MRDrrivjg=w136-h207-p-no',
                'penulis_id'   => 2,
                'penerbit_id'  => 17,
                'kategori_id'  => 31,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
            [
                'judul'        => "Membangun Rumah Tangga dengan Takwa",
                'uraian'       => '',
                'tahun'        => '2012',
                'tanggal_beli' => '2015-08-21',
                'harga'        => 34850,
                'gambar'       => 'https://lh5.googleusercontent.com/-Lj2IwJFa36c/Uv8AF7fyQZI/AAAAAAAAB4Q/AmKvolSwql4/s128/membangun.jpg',
                'penulis_id'   => 2,
                'penerbit_id'  => 7,
                'kategori_id'  => 25,
                'user_id'      => 1,
                'created_at'   => \Carbon\Carbon::now(),
            ],
        ];
        DB::table('buku')->insert($data);
    }
}
