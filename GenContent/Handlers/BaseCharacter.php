<?php
namespace App\Libraries\TEFakeContent\GenContent\Handlers;

abstract class BaseCharacter
{

    /**
     * Contains lower case alphbet [a-z]
     *
     * @var string
     */
    protected string $lowerAlpha = 'abcdefghijklmnopqrstuvwxyz';

    /**
     * Contains upper case alphbet [A-Z]
     *
     * @var string
     */
    protected string $upperAlpha = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * Contains base numbers [0-9]
     *
     * @var string
     */
    protected string $number = '0123456789';

    /**
     * Contains some sign
     *
     * @var string
     */
    protected string $sign = '!@#$%^&*=-+/';

}
