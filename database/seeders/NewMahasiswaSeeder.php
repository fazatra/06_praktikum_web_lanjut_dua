<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewMahasiswaSeeder extends Seeder
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
                'Nim' => 2141720897,
                'Nama' => 'Gundala Putra Petir',
                'Tanggal_Lahir' => '04 April 2002',
                'Kelas' => 'TI-2F',
                'Jurusan' => 'Teknologi Informasi',
                'No_Handphone' => '082866578912',
                'Email' => 'gunanakzeus@gmail.com'
            ],
            [
                'Nim' => 2141720100,
                'Nama' => 'Leonardi Di kunci',
                'Tanggal_Lahir' => '19 September 2002',
                'Kelas' => 'TI-2F',
                'Jurusan' => 'Teknologi Informasi',
                'No_Handphone' => '081339123321',
                'Email' => 'dikunci19@gmail.com'
            ],
            [
                'Nim' => 2141720453,
                'Nama' => 'Satine Zaneta',
                'Tanggal_Lahir' => '06 September 2002',
                'Kelas' => 'TI-2F',
                'Jurusan' => 'Teknologi Informasi',
                'No_Handphone' => '081167888800',
                'Email' => 'putrihujan@gmail.com'
            ],
            [
                'Nim' => 2141720345,
                'Nama' => 'Shawn Wasabi',
                'Tanggal_Lahir' => '23 Juli 2001',
                'Kelas' => 'TI-2F',
                'Jurusan' => 'Teknologi Informasi',
                'No_Handphone' => '088099098767',
                'Email' => 'wasabi00@gmail.com'
            ],
            [
                'Nim' => 2141720101,
                'Nama' => 'Satria Baja Hitam',
                'Tanggal_Lahir' => '01 Juni 2003',
                'Kelas' => 'TI-2F',
                'Jurusan' => 'Teknologi Informasi',
                'No_Handphone' => '082223678000',
                'Email' => 'memberantaskejahatan@gmail.com'
            ],
        ];
        DB::table('mahasiswas')->insert($data);
    }
}
