<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Penerima Zakat
        Schema::create('penerima_zakat', function (Blueprint $table) {
            $table->id('penerimaId');
            $table->string('namaKepalaKeluarga');
            $table->string('alamat');
            $table->string('noTelepon');
            $table->timestamps();
        });

        // Pembayaran Zakat
        Schema::create('pembayaran_zakat', function (Blueprint $table) {
            $table->id('pembayaranZakatId');
            $table->integer('tahun');
            $table->timestamps();
        });

        // Bentuk Zakat
        Schema::create('bentuk_zakat', function (Blueprint $table) {
            $table->id('bentukId');
            $table->string('namaBentukZakat');
            $table->timestamps();
        });

        // Jenis Zakat
        Schema::create('jenis_zakat', function (Blueprint $table) {
            $table->id('jenisId');
            $table->string('namaJenisZakat');
            $table->timestamps();
        });

        // Status Pembayaran
        Schema::create('status_pembayaran', function (Blueprint $table) {
            $table->id('statusPembayaranId');
            $table->string('namaStatus');
            $table->timestamps();
        });

        // Transaksi Zakat
        Schema::create('transaksi_zakat', function (Blueprint $table) {
            $table->id('transaksiZakatId');
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('pembayaranZakatId');
            $table->unsignedBigInteger('jenisId');
            $table->unsignedBigInteger('bentukId');
            $table->integer('jumlah');
            $table->date('tanggalTransaksi');
            $table->unsignedBigInteger('statusPembayaranId');
            $table->unsignedBigInteger('metodePembayaranId');
            $table->timestamps();

            // Foreign keys
            $table->foreign('userId')->references('id')->on('users');
            $table->foreign('pembayaranZakatId')->references('pembayaranZakatId')->on('pembayaran_zakat');
            $table->foreign('jenisId')->references('jenisId')->on('jenis_zakat');
            $table->foreign('bentukId')->references('bentukId')->on('bentuk_zakat');
            $table->foreign('statusPembayaranId')->references('statusPembayaranId')->on('status_pembayaran');
        });

        // Pembagian Zakat
        Schema::create('pembagian_zakat', function (Blueprint $table) {
            $table->id('pembagianId');
            $table->integer('tahun');
            $table->timestamps();
        });

        // Status Pembagian
        Schema::create('status_pembagian', function (Blueprint $table) {
            $table->id('statusId');
            $table->string('namaStatus');
            $table->timestamps();
        });

        // Penyaluran Zakat
        Schema::create('penyaluran_zakat', function (Blueprint $table) {
            $table->id('penyaluranId');
            $table->unsignedBigInteger('penerimaId');
            $table->unsignedBigInteger('pembagianId');
            $table->unsignedBigInteger('statusId');
            $table->unsignedBigInteger('jenisId');
            $table->unsignedBigInteger('amilId');
            $table->timestamps();

            // Foreign keys
            $table->foreign('penerimaId')->references('penerimaId')->on('penerima_zakat');
            $table->foreign('pembagianId')->references('pembagianId')->on('pembagian_zakat');
            $table->foreign('statusId')->references('statusId')->on('status_pembagian');
            $table->foreign('jenisId')->references('jenisId')->on('jenis_zakat');
            $table->foreign('amilId')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyaluran_zakat');
        Schema::dropIfExists('status_pembagian');
        Schema::dropIfExists('pembagian_zakat');
        Schema::dropIfExists('transaksi_zakat');
        Schema::dropIfExists('status_pembayaran');
        Schema::dropIfExists('jenis_zakat');
        Schema::dropIfExists('bentuk_zakat');
        Schema::dropIfExists('pembayaran_zakat');
        Schema::dropIfExists('penerima_zakat');
    }
};
