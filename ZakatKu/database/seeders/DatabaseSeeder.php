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
            ['namaMetode' => 'Tunai'],
            ['namaMetode' => 'Transfer Bank'],
            ['namaMetode' => 'QRIS'],
            ['namaMetode' => 'Dompet Digital'],
        ]);
    }
}
