<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [];
    }

    //XOR MANUAL
    public function setPasswordAttribute($value)
    {
        $plainPassword = $value;
        $key = "KUNCI";

        $passwordBinary = $this->textToBinary($plainPassword);
        $keyBinary      = $this->textToBinary($key);

        $resultBinary = [];

        for ($i = 0; $i < count($passwordBinary); $i++) {

            $binInput = $passwordBinary[$i];
            $binKey   = $keyBinary[$i % count($keyBinary)];

            $xorResultBlock = $this->xorBinary($binInput, $binKey);

            $resultBinary[] = $xorResultBlock;
        }

        $this->attributes['password'] = implode(' ', $resultBinary);
    }

    private function charToAscii($char)
    {
        return ord($char);
    }

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
            if ($bin1[$i] == $bin2[$i]) {
                $hasil .= '0';
            } else {
                $hasil .= '1';
            }
        }
        return $hasil;
    }
}
