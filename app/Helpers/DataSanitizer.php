<?php


namespace App\Helpers;

class DataSanitizer
{
    /**
     * Sanitize string values.
     *
     * @param string|null $value
     * @return string
     */
    public static function sanitizeString($value)
    {
        return trim($value) ?: '';
    }

    /**
     * Sanitize decimal values.
     *
     * @param string|null $value
     * @return float
     */
    public static function sanitizeDecimal($value)
    {
        return is_numeric($value) ? (float)$value : 0.00;
    }

    /**
     * Sanitize unsigned big integer values.
     *
     * @param string|null $value
     * @return int
     */
    public static function sanitizeUnsignedBigInteger($value)
    {
        return is_numeric($value) ? (int)$value : 0;
    }

    public static function sanitizeDate($value)
    {
        return trim($value) ;
    }
    
}
