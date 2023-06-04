<?php
namespace App\Libraries\TEFakeContent\GenContent\Handlers;

class DateTime
{

    /**
     * Return only date string
     *
     * @return string
     */
    public static function date (): string {
        return date ('Y/m/d');
    }

    /**
     * Return only time string
     *
     * @return string
     */
    public static function time (): string {
        return date ('H:i:s');
    }

    /**
     * Return date & time string
     *
     * @return string
     */
    public static function datetime (): string {
        return date ('Y/m/d H:i:s');
    }

    /**
     * Return current timestamp
     *
     * @return string
     */
    public static function timestamp (): string {
        return time ();
    }

}
