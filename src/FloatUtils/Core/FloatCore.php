<?php

namespace Kucil\Utilities\FloatUtils\Core;

use Kucil\Utilities\FloatUtils\Contracts\FloatInterface;
use Kucil\Utilities\FloatUtils\Enums\LengthOptions;
use Kucil\Utilities\FloatUtils\Enums\RoundOptions;

use function is_float;
use function in_array;
use function explode;
use function strlen;
use function sprintf;
use function str_contains;
use function ceil;
use function floor;

/**
 * @author  Menyong Menying <menyongmenying.main@gmail.com>
 * 
 * @version 0.0.1
 * 
 * 
 * 
 */
abstract class FloatCore implements FloatInterface
{
    /**
     * @see FloatUtilsTest::testIsFlt()
     * 
     * 
     * 
     */
    public static function isFlt(mixed $float = null): ?bool
    {
        return is_float($float);
    }



    /**
     * @see FloatUtilsTest::testIsFloat()
     * 
     * 
     * 
     */
    public static function isFloat(mixed $float = null): ?bool
    {
        return self::isFlt($float);
    }



    /**
     * @see FloatUtilsTest::testIsPositiveNumber()
     * 
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
     * @see FloatUtilsTest::testPositiveNumber()
     * 
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
     * @see FloatUtilsTest::testLengthInt()
     * 
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
     * @see FloatUtilsTest::testLengthDec()
     * 
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
     * @see FloatUtilsTest::testLengthAll()
     * 
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
     * @see FloatUtilsTest::testLength()
     * 
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
     * @see FloatUtilsTest::testRoundNearest()
     * 
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
     * @see FloatUtilsTest::testRoundUp()
     * 
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
     * @see FloatUtilsTest::testRoundDown()
     * 
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
     * @see FloatUtilsTest::testRoundNearest()
     * @see FloatUtilsTest::testRoundUp()
     * @see FloatUtilsTest::testRoundDown()
     * 
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
     * @see FloatUtilsTest::testCut()
     * 
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
     * @see FloatUtilsTest::testToInt()
     * 
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
     * @see FloatUtilsTest::testToInteger()
     * 
     * 
     * 
     */
    public static function toInteger(?float $float = null): ?int
    {
        return self::toInt($float);
    }



    /**
     * @see FloatUtilsTest::testToStr()
     * 
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
     * @see FloatUtilsTest::testToString()
     * 
     * 
     * 
     */
    public static function toString(?float $float = null): ?string
    {
        return self::toStr($float);
    }
}
