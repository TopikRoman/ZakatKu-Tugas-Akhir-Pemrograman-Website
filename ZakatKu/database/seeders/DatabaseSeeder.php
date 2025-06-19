<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('roles_user')->insert([
            [
                'namaRoles' => 'amil',
            ],
            [
                'namaRoles' => 'muzakki',
            ],
        ]);

        DB::table('users')->insert([
            [
                'username' => 'Taufiq123',
                'name' => 'Muhammad Taufiq',
                'email' => 'rohmantaufik327@gmail.com',
                'alamat' => 'Jalan Kebaikan',
                'nomorTelepon' => '089503639206',
                'roleId' => 2,
                'password' => Hash::make('12345678') // pastikan field password ada
            ],
            [
                'username' => 'Admin1',
                'name' => 'AdminKebaikan',
                'email' => 'admin@gmail.com',
                'alamat' => 'Jalan Kebaikan',
                'nomorTelepon' => '089503629206',
                'roleId' => 1,
                'password' => Hash::make('admin123') // pastikan field password ada
            ],
        ]);

        // Bentuk Zakat
        DB::table('bentuk_zakat')->insert([
            ['namaBentukZakat' => 'Uang'],
            ['namaBentukZakat' => 'Beras'],
            ['namaBentukZakat' => 'Emas'],
        ]);

        // Jenis Zakat
        DB::table('jenis_zakat')->insert([
            ['namaJenisZakat' => 'Zakat Fitrah'],
            ['namaJenisZakat' => 'Zakat Mal'],
            ['namaJenisZakat' => 'Zakat Penghasilan'],
        ]);

        // Status Pembayaran
        DB::table('status_pembayaran')->insert([
            ['namaStatus' => 'Belum Dibayar'],
            ['namaStatus' => 'Sudah Dibayar'],
            ['namaStatus' => 'Menunggu Konfirmasi'],
            ['namaStatus' => 'Dalam Proses'],
        ]);

        // Tahun berjalan dan sebelumnya
        $currentYear = Carbon::now()->year;
        $years = [$currentYear - 1, $currentYear];

        // Pembayaran Zakat
        foreach ($years as $year) {
            DB::table('pembayaran_zakat')->insert([
                'tahun' => $year
            ]);
        }

        // Status Pembagian
        DB::table('status_pembagian')->insert([
            ['namaStatus' => 'Belum Dibagikan'],
            ['namaStatus' => 'Sudah Dibagikan'],
            ['namaStatus' => 'Dalam Proses'],
        ]);

        // Pembagian Zakat
        foreach ($years as $year) {
            DB::table('pembagian_zakat')->insert([
                'tahun' => $year
            ]);
        }

        DB::table('metode_pembayaran')->insert([
            ['namaMetode' => 'TUNAI'],         // GOPAY
            ['namaMetode' => 'BRIVA'],         // Bank BRI
            ['namaMetode' => 'QRIS'],          // QRIS
            ['namaMetode' => 'BNIVA'],         // Bank BNI
            ['namaMetode' => 'GOPAY'],         // GOPAY
            ['namaMetode' => 'SHOPEEPAY'],     // SHOPEEPAY
        ]);

        DB::table('penerima_zakat')->insert([
            [
                'namaKepalaKeluarga' => 'Ahmad Sutrisno',
                'alamat' => 'Jl. Melati No. 12, Kel. Sukamaju, Bandung',
                'noTelepon' => '081234567890',
            ],
            [
                'namaKepalaKeluarga' => 'Siti Aisyah',
                'alamat' => 'Jl. Cendana No. 8, Kec. Cipayung, Jakarta Timur',
                'noTelepon' => '082134567891',
            ],
            [
                'namaKepalaKeluarga' => 'Budi Santoso',
                'alamat' => 'Jl. Kenanga No. 5, Bekasi Barat',
                'noTelepon' => '081345678902',
            ],
            [
                'namaKepalaKeluarga' => 'Rina Kartika',
                'alamat' => 'Jl. Mawar No. 10, Medan Tuntungan',
                'noTelepon' => '082256789013',
            ],
            [
                'namaKepalaKeluarga' => 'Tono Suharto',
                'alamat' => 'Jl. Durian No. 3, Palembang Ilir Barat',
                'noTelepon' => '085267890124',
            ],
            [
                'namaKepalaKeluarga' => 'Dewi Lestari',
                'alamat' => 'Jl. Flamboyan No. 9, Sleman, Yogyakarta',
                'noTelepon' => '087378901235',
            ],
            [
                'namaKepalaKeluarga' => 'Rahmat Hidayat',
                'alamat' => 'Jl. Sawo No. 14, Kec. Ciputat, Tangerang Selatan',
                'noTelepon' => '081398901246',
            ],
            [
                'namaKepalaKeluarga' => 'Nurul Hasanah',
                'alamat' => 'Jl. Semangka No. 7, Samarinda Seberang',
                'noTelepon' => '082498901357',
            ],
            [
                'namaKepalaKeluarga' => 'Joko Pranoto',
                'alamat' => 'Jl. Salak No. 6, Kec. Jebres, Surakarta',
                'noTelepon' => '085519013468',
            ],
            [
                'namaKepalaKeluarga' => 'Sri Wahyuni',
                'alamat' => 'Jl. Jambu No. 2, Kec. Lowokwaru, Malang',
                'noTelepon' => '081640124579',
            ],
            [
                'namaKepalaKeluarga' => 'Ali Usman',
                'alamat' => 'Jl. Rambutan No. 4, Banda Aceh',
                'noTelepon' => '082713245680',
            ],
            [
                'namaKepalaKeluarga' => 'Fitri Anjani',
                'alamat' => 'Jl. Pisang No. 11, Padang Barat',
                'noTelepon' => '083812356791',
            ],
            [
                'namaKepalaKeluarga' => 'Zainudin Hasan',
                'alamat' => 'Jl. Duku No. 13, Kec. Cibeunying, Bandung',
                'noTelepon' => '081923467802',
            ],
            [
                'namaKepalaKeluarga' => 'Mega Puspita',
                'alamat' => 'Jl. Apel No. 15, Kec. Tambaksari, Surabaya',
                'noTelepon' => '082034578913',
            ],
            [
                'namaKepalaKeluarga' => 'Imam Syafi’i',
                'alamat' => 'Jl. Anggur No. 17, Kec. Pancoran, Jakarta Selatan',
                'noTelepon' => '083145689024',
            ],
        ]);

        DB::table('users')->insert([
            [
                'name' => 'Farhan Ramadhan',
                'username' => 'farhanr',
                'email' => 'farhan@example.com',
                'password' => Hash::make('password123'),
                'alamat' => 'Jl. Kamboja No. 15, Bandung',
                'nomorTelepon' => '081234567890',
                'roleId' => 2,
            ],
            [
                'name' => 'Dewi Anggraini',
                'username' => 'dewia',
                'email' => 'dewi@example.com',
                'password' => Hash::make('password123'),
                'alamat' => 'Jl. Merpati No. 23, Jakarta Selatan',
                'nomorTelepon' => '082134567891',
                'roleId' => 2,
            ],
            [
                'name' => 'Agus Prasetyo',
                'username' => 'aguspr',
                'email' => 'agus@example.com',
                'password' => Hash::make('password123'),
                'alamat' => 'Jl. Garuda No. 5, Surabaya',
                'nomorTelepon' => '083145678902',
                'roleId' => 2,
            ],
            [
                'name' => 'Nina Kartika',
                'username' => 'ninak',
                'email' => 'nina@example.com',
                'password' => Hash::make('password123'),
                'alamat' => 'Jl. Mawar No. 10, Yogyakarta',
                'nomorTelepon' => '084156789013',
                'roleId' => 2,
            ],
            [
                'name' => 'Rizky Hidayat',
                'username' => 'rizkyh',
                'email' => 'rizky@example.com',
                'password' => Hash::make('password123'),
                'alamat' => 'Jl. Anggrek No. 7, Medan',
                'nomorTelepon' => '085267890124',
                'roleId' => 2,
            ],
            [
                'name' => 'Lestari Anjani',
                'username' => 'lestaria',
                'email' => 'lestari@example.com',
                'password' => Hash::make('password123'),
                'alamat' => 'Jl. Flamboyan No. 19, Palembang',
                'nomorTelepon' => '086378901235',
                'roleId' => 2,
            ],
            [
                'name' => 'Fajar Wicaksono',
                'username' => 'fajarw',
                'email' => 'fajar@example.com',
                'password' => Hash::make('password123'),
                'alamat' => 'Jl. Jati No. 3, Bekasi',
                'nomorTelepon' => '087489012346',
                'roleId' => 2,
            ],
            [
                'name' => 'Rani Oktaviani',
                'username' => 'ranio',
                'email' => 'rani@example.com',
                'password' => Hash::make('password123'),
                'alamat' => 'Jl. Sawo No. 11, Semarang',
                'nomorTelepon' => '088590123457',
                'roleId' => 2,
            ],
            [
                'name' => 'Yusuf Maulana',
                'username' => 'yusufm',
                'email' => 'yusuf@example.com',
                'password' => Hash::make('password123'),
                'alamat' => 'Jl. Rambutan No. 8, Tangerang',
                'nomorTelepon' => '089601234568',
                'roleId' => 2,
            ],
            [
                'name' => 'Sari Nurlaila',
                'username' => 'sarin',
                'email' => 'sari@example.com',
                'password' => Hash::make('password123'),
                'alamat' => 'Jl. Duku No. 16, Padang',
                'nomorTelepon' => '081712345679',
                'roleId' => 2,
            ],
        ]);
    }

}
