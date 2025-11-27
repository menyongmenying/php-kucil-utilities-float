<?php

namespace Kucil;

use Kucil\FloatUtils\LengthOptions;
use Kucil\FloatUtils\RoundOptions;

use function is_float;
use function in_array;
use function explode;
use function strlen;
use function sprintf;
use function str_contains;
use function ceil;
use function floor;

/**
 * @author  menyongmenying <menyongmenying.main@email.com>
 * 
 * @version 0.0.1
 * 
 * 
 * 
 */
class FloatUtils
{
    /**
     * Meneruskan hasil pemeriksaan apakah nilai yang diberikan bertipe data float atau tidak.
     * 
     * NOTE:
     * Jika nilai yang diberikan dianggap tidak valid, maka akan meneruskan `null`.
     *
     * @param  mixed $float Nilai yang akan dijadikan objek pemeriksaan.
     *
     * @return ?bool      Hasil pemeriksaan apakah nilai $float bertipe data float atau tidak.
     * 
     * @see    FloatUtilsTest::testIsFlt()
     * 
     * 
     */
    public static function isFlt(mixed $float = null): ?bool
    {
        return is_float($float);
    }



    /**
     * Meneruskan hasil pemeriksaan apakah nilai yang diberikan bertipe data float atau tidak.
     * 
     * NOTE:
     * Jika nilai yang diberikan dianggap tidak valid, maka akan meneruskan `null`.
     *
     * @param  mixed $float Nilai yang akan dijadikan objek pemeriksaan.
     *
     * @return ?bool      Hasil pemeriksaan apakah nilai $float bertipe data float atau tidak.
     * 
     * @see    FloatUtilsTest::testIsFloat()
     * 
     * 
     */
    public static function isFloat(mixed $float = null): ?bool
    {
        return self::isFlt($float);
    }



    /**
     * Meneruskan hasil pemeriksaan apakah nilai float yang diberikan merupakan bilangan positif atau tidak.
     * 
     * NOTE:
     * Jika nilai yang diberikan dianggap tidak valid, maka akan meneruskan `null`.
     * 
     * @param  ?float $float Nilai float yang akan dijadikan objek pemeriksaan.
     *
     * @return ?bool         Hasil pemeriksaan apakah nilai $float merupakan bilangan positif atau tidak.
     * 
     * @see    FloatUtilsTest::testIsPositiveNumber()
     * 
     * 
     */
    public static function isPositiveNumber(?float $float = null): ?bool
    {
        if ($float === null) {
            return null;
        }
        
        return 0 < $float;
    }



    /**
     * Meneruskan bilangan positif dari nilai float yang diberikan.
     * 
     * NOTE:
     * Jika nilai yang diberikan dianggap tidak valid, maka akan meneruskan `null`.
     *
     * @param  ?float $float Nilai float yang akan diteruskan bentuk bilangan positifnya.
     *
     * @return ?float        Bilangan positif dari nilai $float.
     * 
     * @see    FloatUtilsTest::testPositiveNumber()
     * 
     * 
     */
    public static function positiveNumber(?float $float = null): ?float
    {
        if ($float === null) {
            return null;
        }

        return abs($float);
    }

    

    /**
     * Meneruskan panjang digit bilangan bulat dari nilai float yang diberikan.
     * 
     * NOTE:
     * Jika nilai yang diberikan dianggap tidak valid, maka akan meneruskan `null`.
     *
     * @param  ?float $float Nilai float yang akan dihitung panjang digit bilangan bulat-nya.
     *
     * @return ?int          Panjang digit bilangan bulat dari nilai $float.
     * 
     * @see    FloatUtilsTest::testLengthInt()
     * 
     * 
     */
    public static function lengthInt(?float $float = null): ?int
    {
        $stringFloat = (string) self::positiveNumber($float);

        if ($float === null) {
            return null;
        }

        if (str_contains($stringFloat, '.')) {
            $stringFloat = explode('.', $stringFloat)[0];
        }

        return strlen($stringFloat);
    }

    

    /**
     * Meneruskan panjang digit bilangan desimal dari nilai float yang diberikan.
     * 
     * NOTE:
     * Jika nilai yang diberikan dianggap tidak valid, maka akan meneruskan `null`.
     *
     * @param  ?float $float Nilai float yang akan dihitung panjang digit bilangan desimal-nya.
     *
     * @return ?int          Panjang digit bilangan desimal dari nilai $float.
     * 
     * @see    FloatUtilsTest::testLengthDec()
     * 
     *  
     */
    public static function lengthDec(?float $float = null): ?int
    {
        $stringFloat = (string) self::positiveNumber($float);

        if ($float === null) {
            return null;
        }
        
        if (str_contains($stringFloat, '.')) {
            return strlen(explode('.', $stringFloat)[1]);
        }

        return 0;
    }



    /**
     * Meneruskan panjang digit bilangan dari nilai float yang diberikan.
     * 
     * NOTE:
     * Jika nilai yang diberikan dianggap tidak valid, maka akan meneruskan `null`.
     *
     * @param  ?float $float Nilai float yang akan dihitung panjang digit bilangan-nya.
     *
     * @return ?int          Panjang digit bilangan dari nilai $float.
     * 
     * @see    FloatUtilsTest::testLengthDec()
     * 
     * 
     */
    public static function lengthAll(?float $float = null): ?int
    {
        if ($float === null) {
            return null;
        }
        
        $stringFloat = (string) self::positiveNumber($float);
        $length = strlen($stringFloat);

        if (str_contains($stringFloat, '.')) {
            return $length - 1;
        }

        return $length;
    }



    /**
     * Meneruskan panjang digit bilangan  dari nilai float yang diberikan.
     * 
     * NOTE:
     * Jika nilai yang diberikan dianggap tidak valid, maka akan meneruskan `null`.
     *
     * @param  ?float         $float  Nilai float yang akan dihitung panjang digit bilangan-nya.
     * @param  ?LengthOptions $option Tipe bilangan yang dihitung panjang digit-nya.
     *
     * @return ?int                   Panjang digit bilangan dari nilai $float.
     * 
     * @see    FloatUtilsTest::testLengthDec()
     * 
     * 
     */
    public static function length(?float $float = null, ?LengthOptions $option = LengthOptions::ALL): ?int
    {
        if ($float === null || $option === null) {
            return null;
        }

        return match ($option) {
            LengthOptions::ALL => self::lengthAll($float),
            LengthOptions::INT => self::lengthInt($float),
            LengthOptions::DEC => self::lengthDec($float)
        };
    }

    

    /**
     * Meneruskan pembulatan bilangan ke terdekat dari nilai float yang diberikan.
     * 
     * NOTE:
     * Jika nilai yang diberikan dianggap tidak valid, maka akan meneruskan `null`.
     *
     * @param  ?float $float     Nilai float yang akan dijadikan objek pembulatan ke terdekat.      
     * @param  ?int   $precision Nilai presisi tingkat level digit pembulatan ke terdekat.
     *
     * @return ?float            Hasil pembulatan bilangan ke terdekat dari nilai $float.
     * 
     * @see    FloatUtilsTest::testRoundNearest()
     * 
     * 
     */
    public static function roundNearest(?float $float = null, ?int $precision = 0): ?float
    {
        if ($float === null || $precision === null) {
            return null;
        }

        return round($float, $precision);
    }

    

    /**
     * Meneruskan pembulatan bilangan ke atas dari nilai float yang diberikan.
     * 
     * NOTE:
     * Jika nilai yang diberikan dianggap tidak valid, maka akan meneruskan `null`.
     *
     * @param  ?float $float     Nilai float yang akan dijadikan objek pembulatan ke atas.      
     * @param  ?int   $precision Nilai presisi tingkat level digit pembulatan ke atas.
     *
     * @return ?float            Hasil pembulatan bilangan ke atas dari nilai $float.
     * 
     * @see    FloatUtilsTest::testRoundUp()
     * 
     * 
     */
    public static function roundUp(?float $float = null, ?int $precision = 0): ?float
    {
        $factor = 10 ** $precision;

        if ($float === null || $precision === null) {
            return null;
        }

        return ceil($float * $factor) / $factor;
    }

    

    /**
     * Meneruskan pembulatan bilangan ke bawah dari nilai float yang diberikan.
     * 
     * NOTE:
     * Jika nilai yang diberikan dianggap tidak valid, maka akan meneruskan `null`.
     *
     * @param  ?float $float     Nilai float yang akan dijadikan objek pembulatan ke bawah.      
     * @param  ?int   $precision Nilai presisi tingkat level digit pembulatan ke bawah.
     *
     * @return ?float            Hasil pembulatan bilangan ke bawah dari nilai $float.
     * 
     * @see    FloatUtilsTest::testRoundDown()
     * 
     * 
     */
    public static function roundDown(?float $float = null, ?int $precision = 0): ?float
    {
        $factor = 10 ** $precision;

        if ($float === null || $precision === null) {
            return null;
        }

        return floor($float * $factor) / $factor;
    }

    

    /**
     * Meneruskan pembulatan bilangan ke bawah dari nilai float yang diberikan.
     * 
     * NOTE:
     * Jika nilai yang diberikan dianggap tidak valid, maka akan meneruskan `null`.
     *
     * @param  ?float        $float     Nilai float yang akan dijadikan objek pembulatan ke bawah.      
     * @param  ?int          $precision Nilai presisi tingkat level digit pembulatan ke bawah.
     * @param  ?RoundOptions $option    Jenis pembulatan.
     *
     * @return ?float                   Hasil pembulatan bilangan ke bawah dari nilai $float.
     * 
     * @see    FloatUtilsTest::testRound()
     * 
     * 
     */
    public static function round(?float $float = null, ?int $precision = 0, ?RoundOptions $option = RoundOptions::NEAREST): ?float
    {
        if ($float === null || $precision === null) {
            return null;
        }
        
        return match ($float) {
            RoundOptions::NEAREST => self::roundNearest($float, $precision),
            RoundOptions::UP => self::roundUp($float, $precision),
            RoundOptions::DOWN => self::roundDown($float, $precision)
        };
    }



    /**
     * Meneruskan hasil penyederhanaan bilangan dari nilai float yang diberikan.
     * 
     * NOTE:
     * Jika nilai yang diberikan dianggap tidak valid, maka akan meneruskan `null`.
     * 
     * @param  ?float $float  Nilai float yang akan disederhanakan.
     * @param  ?int   $length Panjang digit penyederhanaan bilangan dari nilai $int. 
     *
     * @return ?float         Hasil penyederhanaan bilangan dari nilai $int.
     * 
     * @see    FloatUtilsTest::testCut()
     * 
     * 
     */
    public static function cut(?float $float = null, ?int $length = 1): ?float
    {
        $stringFloat = (string) $float;
        $lengthFloat = self::length($float);

        if ($float === null || $length === null || $length <= 0) {
            return null;
        }

        if ($length < $lengthFloat) {
            $result = '';

            $stringFloat = str_split($stringFloat);

            if ($stringFloat[0] === '-') {
                $length++;
            }

            if (in_array('.', $stringFloat)) {
                $length++;
            }

            for ($i = 0; $i < $length; $i++) {
                $result .= (string) $stringFloat[$i];
            }

            return (float) $result;
        }

        return $float;
    }


    
    /**
     * Meneruskan hasil konversi float ke integer dari nilai float yang diberikan.
     * 
     * NOTE:
     * Jika nilai yang diberikan dianggap tidak valid, maka akan meneruskan `null`.
     *
     * @param  ?float   $float Nilai float yang akan dijadikan objek konversi float ke integer. 
     *
     * @return ?int            Hasil konversi float ke integer dari nilai $int.
     * 
     * @see FloatUtilsTest::testToInt()
     * 
     * 
     */
    public static function toInt(?float $float = null): ?int
    {
        if ($float === null) {
            return null;
        }

        return (int) $float;
    }



    /**
     * Meneruskan hasil konversi float ke integer dari nilai float yang diberikan.
     * 
     * NOTE:
     * Jika nilai yang diberikan dianggap tidak valid, maka akan meneruskan `null`.
     *
     * @param  ?float   $float Nilai float yang akan dijadikan objek konversi float ke integer. 
     *
     * @return ?int            Hasil konversi float ke integer dari nilai $int.
     * 
     * @see FloatUtilsTest::testToInteger()
     * 
     * 
     */
    public static function toInteger(?float $float = null): ?int
    {
        return self::toInt($float);
    }



    /**
     * Meneruskan hasil konversi float ke string dari nilai float yang diberikan.
     * 
     * NOTE:
     * Jika nilai yang diberikan dianggap tidak valid, maka akan meneruskan `null`.
     *
     * @param  ?float   $float Nilai float yang akan dijadikan objek konversi float ke string. 
     *
     * @return ?string         Hasil konversi float ke string dari nilai $int.
     * 
     * @see FloatUtilsTest::testToStr()
     * 
     * 
     */
    public static function toStr(?float $float = null): ?string
    {
        if ($float === null) {
            return null;
        }
        
        return (string) sprintf('%.1f', $float);
    }



    /**
     * Meneruskan hasil konversi float ke string dari nilai float yang diberikan.
     * 
     * NOTE:
     * Jika nilai yang diberikan dianggap tidak valid, maka akan meneruskan `null`.
     *
     * @param  ?float   $float Nilai float yang akan dijadikan objek konversi float ke string. 
     *
     * @return ?string         Hasil konversi float ke string dari nilai $int.
     * 
     * @see FloatUtilsTest::testToString()
     * 
     * 
     */
    public static function toString(?float $float = null): ?string
    {
        return self::toStr($float);
    }
}