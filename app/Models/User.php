<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Menentukan nama tabel sesuai database kamu
    protected $table = 'users';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    // Menyembunyikan kolom password saat serialisasi data
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Matikan casts hashed bawaan Laravel agar tidak bentrok dengan XOR kita
    protected function casts(): array
    {
        return [];
    }

    /**
     * =========================================================================
     * MUTATOR LARAVEL + ALGORITMA XOR MANUAL
     * =========================================================================
     * Fungsi ini otomatis berjalan setiap kali kamu mengisi atau menyimpan data
     * ke kolom password (contoh: User::create atau $user->password = '...').
     */
    public function setPasswordAttribute($value)
    {
        $plainPassword = $value;
        $key = "KUNCI"; // Kunci pengunci rahasia kamu

        // 1. Ubah string password dan key menjadi kumpulan biner (array)
        $passwordBinary = $this->textToBinary($plainPassword);
        $keyBinary      = $this->textToBinary($key);

        $resultBinary = [];

        // 2. Lakukan perulangan XOR bit demi bit per karakter
        for ($i = 0; $i < count($passwordBinary); $i++) {
            $binInput = $passwordBinary[$i];

            // Modulo (%) digunakan agar jika key lebih pendek dari password, key-nya mengulang dari depan
            $binKey   = $keyBinary[$i % count($keyBinary)];

            // Jalankan fungsi operasi logika XOR biner
            $xorResultBlock = $this->xorBinary($binInput, $binKey);

            $resultBinary[] = $xorResultBlock;
        }

        /**
         * 3. Satukan kumpulan blok biner menjadi satu string panjang dipisahkan spasi
         * Hasil akhirnya berupa string biner (Contoh: "00101101 01110100 00001111")
         * Teks biner inilah yang disimpan murni ke dalam kolom password di database MySQL.
         */
        $this->attributes['password'] = implode(' ', $resultBinary);
    }




    // Mengubah karakter teks menjadi desimal ASCII
    private function charToAscii($char)
    {
        return ord($char);
    }

    // Mengonversi angka desimal menjadi string biner manual sepanjang 8-bit
    private function decimalToBinary($number)
    {
        $binary = '';
        while ($number > 0) {
            $binary = ($number % 2) . $binary;
            $number = (int) ($number / 2);
        }
        while (strlen($binary) < 8) {
            $binary = '0' . $binary;
        }
        return $binary;
    }

    // Mengonversi seluruh rangkaian teks biasa (string) menjadi kumpulan biner array
    private function textToBinary($text)
    {
        $result = [];
        for ($i = 0; $i < strlen($text); $i++) {
            $ascii = $this->charToAscii($text[$i]);
            $binary = $this->decimalToBinary($ascii);
            $result[] = $binary;
        }
        return $result;
    }


    private function xorBinary($bin1, $bin2)
    {
        $hasil = '';
        for ($i = 0; $i < 8; $i++) {
            // Logika XOR: Kalo bit sama hasilnya '0', jika berbeda hasilnya '1'
            if ($bin1[$i] == $bin2[$i]) {
                $hasil .= '0';
            } else {
                $hasil .= '1';
            }
        }
        return $hasil;
    }
}
