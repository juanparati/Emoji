<?php

namespace Juanparati\Emoji;

/**
 * Emoji helper
 */
class Emoji
{


    /**
     * Return an emoji as char
     *
     * @param $symbol
     * @return bool|string
     */
    public static function char($symbol)
    {

        if (is_string($symbol) && EmojiDictionary::get($symbol))
            $symbol =  EmojiDictionary::get($symbol);


        // In case that multiple unicode sequences are used
        if (is_array($symbol))
        {
            $output = '';

            foreach ($symbol as $sequence)
                $output .= self::char($sequence);

            return $output;
        }

        return self::uni2utf8($symbol);

        // Another alternative solution is to use mb_convert_encoding (Slow and it requires MB)
        // echo mb_convert_encoding('&#x1F600;', 'UTF-8', 'HTML-ENTITIES');
    }


    /**
     * Return an emoji as a html entity
     *
     * @param $symbol
     * @return string
     */
    public static function html($symbol)
    {


        if (is_string($symbol) && EmojiDictionary::get($symbol))
            $symbol = EmojiDictionary::get($symbol);

        // In case that multiple unicode sequences are used
        if (is_array($symbol))
        {
            $output = '';

            foreach ($symbol as $sequence)
                $output .= self::html($sequence);

            return $output;
        }

        $symbol = dechex($symbol);

        return '&#x' . $symbol;

    }


    /**
     * Convert an unicode hex representation into an UTF-8 char
     * (Using bitwise operations instead of string operations)
     *
     * @param $hex
     * @return bool|string
     */
    protected static function uni2utf8($hex)
    {

        if($hex < 0x80)
            return chr($hex);
        else if($hex < 0x800)
            return chr(0xc0 | ($hex >>  6)).chr(0x80 | ( $hex & 0x3f));
        else if($hex < 0x10000)
            return chr(0xe0 | ($hex >> 12)).chr(0x80 | (($hex >> 6  ) & 0x3f)).chr(0x80 | ($hex & 0x3f));
        else if($hex < 0x200000)
            return chr(0xf0 | ($hex >> 18)).chr(0x80 | (($hex >> 12 ) & 0x3f)).chr(0x80 | (($hex >> 6) & 0x3f)).chr(0x80 | ($hex & 0x3f));

        return false;
    }


    /**
     * Test if current PHP/HHVM version supports native unicode conversion
     *
     * @return bool
     */
    public static function support_native_unicode()
    {
        $var = sprintf("%s", "\u{1F600}");
        return bin2hex($var) === 'f09f9880';
    }


}