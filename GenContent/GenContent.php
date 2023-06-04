<?php
namespace App\Libraries\TEFakeContent\GenContent;

use App\Libraries\TEFakeContent\GenContent\Handlers\LoremIpsum\Character;
use App\Libraries\TEFakeContent\GenContent\Handlers\LoremIpsum\Word;
use App\Libraries\TEFakeContent\GenContent\Handlers\Accidental;
use App\Libraries\TEFakeContent\GenContent\Handlers\Ordinal;
use App\Libraries\TEFakeContent\GenContent\Handlers\Range;
use App\Libraries\TEFakeContent\GenContent\Handlers\DateTime;
use App\Libraries\TEFakeContent\GenContent\Handlers\Hashing;

class GenContent
{
    /* ----------------------------------------------------------------------
     * Accidental
     * ----------------------------------------------------------------------
     */

    /**
     * Return randomly a lower case alphabet
     *
     * @param int $count
     * @return string
     */
    public function accidental_lower_alpha (int $count): string {
        $accidental = new Accidental ();

        return $accidental->lower_alpha ($count);
    }

    /**
     * Return randomly a upper case alphabet
     *
     * @param int $count
     * @return string
     */
    public function accidental_upper_alpha (int $count): string {
        $accidental = new Accidental ();

        return $accidental->upper_alpha ($count);
    }

    /**
     * Return a randomly a number
     *
     * @param int $count
     * @return string
     */
    public function accidental_num (int $count): string {
        $accidental = new Accidental ();

        return $accidental->num ($count);
    }

    /**
     * Return randomly a sign
     *
     * @param int $count
     * @return string
     */
    public function accidental_sign (int $count): string {
        $accidental = new Accidental ();

        return $accidental->sign ($count);
    }

    /* ----------------------------------------------------------------------
     * Range
     * ----------------------------------------------------------------------
     */

    /**
     * Return a lower alphabet between $start to $end
     *
     * @param string $start
     * @param string $end
     * @return string
     */
    public function range_lower_alpha (string $start , string $end): string {
        $range = new Range ();

        return $range->lower_alpha ($start , $end);
    }

    /**
     * Return a upper alphabet between $start to $end
     *
     * @param string $start
     * @param string $end
     * @return string
     */
    public function range_upper_alpha (string $start , string $end): string {
        $range = new Range ();

        return $range->upper_alpha ($start , $end);
    }

    /* ----------------------------------------------------------------------
     * Ordinal
     * ----------------------------------------------------------------------
     */

    /**
     * Return ordinal a lower alphabet
     *
     * @param bool $reset
     * @return string
     */
    public function ordinal_lower_alpha (bool $reset = false): string {
        $ordinal = new Ordinal ();

        return $ordinal->lower_alpha ($reset);
    }

    /**
     * Return ordinal a upper alphabet
     *
     * @param bool $reset
     * @return string
     */
    public function ordinal_upper_alpha (bool $reset = false): string {
        $ordinal = new Ordinal ();

        return $ordinal->upper_alpha ($reset);
    }

    /**
     * Return a ordinal number
     *
     * @staticvar int $num
     * @param bool $reset
     * @param int $start
     * @return string
     */
    public function ordinal_num (bool $reset = false , int $start = 0): string {
        $ordinal = new Ordinal ();

        return $ordinal->num ($reset , $start);
    }

    /* ----------------------------------------------------------------------
     * DateTime
     * ----------------------------------------------------------------------
     */

    /**
     * Return only date string
     *
     * @return string
     */
    public function date (): ?string {
        return DateTime::date ();
    }

    /**
     * Return only time string
     *
     * @return string
     */
    public function time (): ?string {
        return DateTime::time ();
    }

    /**
     * Return date & time string
     *
     * @return string
     */
    public function date_time (): ?string {
        return DateTime::datetime ();
    }

    /**
     * Return current timestamp
     *
     * @return string
     */
    public function timestamp (): ?string {
        return DateTime::timestamp ();
    }

    /* ----------------------------------------------------------------------
     * Lorem Ipsum
     * ----------------------------------------------------------------------
     */

    /**
     * Make lorem ipsum with character count
     *
     * Note: Zero based
     *
     * @param int $min
     * @param int|null $max <p>pass null value to fix count</p>
     * @return string
     */
    public function lorem_char (int $min , ?int $max = null): string {
        $loremChar = new Character ();

        return $loremChar->make ($min , $max);
    }

    /**
     * Return lorem ipsum string with word count
     *
     * @param int $min
     * @param int|null $max <p>pass null value to fix count</p>
     * @return string
     */
    public function lorem_word (int $min , ?int $max = null): string {
        $word = new Word();

        return $word->make ($min , $max);
    }

    /* ----------------------------------------------------------------------
     * Hashing
     * ----------------------------------------------------------------------
     */

    /**
     * Hashing the $content parameter
     *
     * @param string $content
     * @param string $method <p>allowed: "md5" , "sha1" , "password_hash"</p>
     * @return string
     */
    public function hash (string $content , string $method): ?string {
        $hashing = new Hashing();

        return $hashing->make ($content , $method);
    }

}
